<?php namespace Crazymus\Rule;

use Crazymus\PvalidateException;

class IntegerRule extends NumberRule
{
    public function validate($value)
    {
        parent::validate($value);

        if (floor($value) != $value) throw new PvalidateException($this->renderErrorMsg('不是整数'));
    }
}
