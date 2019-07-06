<?php namespace Crazymus\Rule;

use Crazymus\PvalidateException;

class FloatRule extends NumberRule
{
    // 小数点位数
    protected $precision = null;

    public function validate($param)
    {
        parent::validate($param);

        if (floatval($param) != $param) throw new PvalidateException($this->renderErrorMsg('不是浮点数'));

        if (isset($this->precision)) {
            $precision = $this->getPrecision($param);
            if ($precision > $this->precision) {
                throw new PvalidateException($this->renderErrorMsg('小数点位数不得超过' . $this->precision));
            }
        }
    }
}
