<?php
namespace Crazymus\Rule;

use Crazymus\PvalidateException;

class IDCardRule extends StringRule
{
    protected $idLength;     //身份证长度
    protected $areasCode;    //区县编码
    protected $cityCode;     //市编码
    protected $provinceCode; //省编码
    protected $idCard;       //身份证号

    /**
     * @var array 加权因子
     */
    protected $salt = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
    /**
     * @var array 校验码
     */
    protected $checksum = array(1, 0, 'X', 9, 8, 7, 6, 5, 4, 3, 2);

    public function validate($param)
    {
        $this->idCard       = trim($param);
        $this->idLength     = strlen($param);
        $this->provinceCode = substr($this->idCard, 0, 2);
        $this->cityCode     = substr($this->idCard, 0, 4);
        $this->areasCode    = substr($this->idCard, 0, 6);
        if (!$this->checkFormat() || !$this->checkBirthday() || !$this->checkLastCode() || !$this->checkProvince()) {
            throw new PvalidateException($this->renderErrorMsg('格式错误'));
        }
    }

    /**
     * 检查号码格式
     *
     * @return bool
     */
    protected function checkFormat()
    {
        if (! preg_match('/^([\d]{17}[xX\d]|[\d]{15})$/', $this->idCard)) {
            return false;
        }
        return true;
    }

    /**
     * 检查出生年月1900年以后
     *
     * @return boolean
     */
    protected function checkBirthday()
    {
        if ($this->idLength == 18) {
            $birthday = substr($this->idCard, 6, 4) .'-'. substr($this->idCard, 10, 2)
                .'-'. substr($this->idCard, 12, 2);
        } else {
            $birthday = '19'. substr($this->idCard, 6, 2) .'-'. substr($this->idCard, 8, 2)
                .'-'. substr($this->idCard, 10, 2);
        }
        $rPattern = <<<'TAG'
/^(([0-9]{2})|(19[0-9]{2})|(20[0-9]{2}))-((0[1-9]{1})|(1[012]{1}))-((0[1-9]{1})|(1[0-9]{1})|(2[0-9]{1})|3[01]{1})$/
TAG;
        if (preg_match($rPattern, $birthday, $arr)) {
            return true;
        }
        return false;
    }

    /**
     * 校验最后一位校验码
     *
     * @return boolean
     */
    protected function checkLastCode()
    {
        if ($this->idLength == 15) {
            return true;
        }
        $sum = 0;
        $number = (string) $this->idCard;
        for ($i = 0; $i < 17; $i ++) {
            $sum += $number{$i} * $this->salt{$i};
        }
        $seek = $sum % 11;
        if ((string) $this->checksum[$seek] !== strtoupper($number{17})) {
            return false;
        }
        return true;
    }

    /**
     * 校验地区是否合法
     *
     * @return boolean
     */
    protected function checkProvince()
    {
        $path = dirname(dirname(__FILE__));
        $provinceJson = file_get_contents($path.'/Data/IdCard_province.json');
        $provinceList = json_decode($provinceJson, true);
        if (!isset($provinceList[$this->provinceCode])) {
            return false;
        }
        return true;
    }

}
