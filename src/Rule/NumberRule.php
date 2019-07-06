<?php namespace Crazymus\Rule;

use Crazymus\PvalidateException;

class NumberRule extends BaseRule
{
    protected $minRange = null;
    protected $maxRange = null;

    public function validate($param)
    {
        parent::validate($param);

        if (!is_numeric($param)) throw new PvalidateException($this->renderErrorMsg('类型错误'));

        if (isset($this->minRange) && $param < $this->minRange) {
            throw new PvalidateException($this->renderErrorMsg('不能小于' . $this->minRange));
        }
        if (isset($this->maxRange) && $param > $this->maxRange) {
            throw new PvalidateException($this->renderErrorMsg('不能大于' . $this->maxRange));
        }
    }

    /**
     * 获取小数点位数
     * @param $value
     * @return int
     */
    public function getPrecision($param)
    {
        if (strpos($param, '.') === false) {
            return 0;
        }

        $precision = strlen(substr($param, strpos($param, '.') + 1));
        return $precision;
    }
}
