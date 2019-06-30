<?php namespace Crazymus\Rule;

use Crazymus\PvalidateException;

class MoneyRule extends NumberRule
{
    public function validate($value)
    {
        parent::validate($value);

        if ($value < 0) {
            throw new PvalidateException($this->renderErrorMsg('不能小于0'));
        }

        $precision = $this->getPrecision($value);
        if ($precision > 2) {
            throw new PvalidateException($this->renderErrorMsg('小数点不能超过2位'));
        }
    }
}