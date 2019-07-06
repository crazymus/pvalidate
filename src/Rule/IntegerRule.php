<?php namespace Crazymus\Rule;

use Crazymus\PvalidateException;

class IntegerRule extends NumberRule
{
    public function validate($param)
    {
        parent::validate($param);

        if (floor($param) != $param) throw new PvalidateException($this->renderErrorMsg('不是整数'));
    }
}
