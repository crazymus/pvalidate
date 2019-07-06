<?php namespace Crazymus\Utils;

use Crazymus\PvalidateException;

class OperatorValidator
{
    public function validate($rules)
    {
        if (!is_array($rules) || count($rules) == 0) {
            throw new PvalidateException('运算符错误');
        }
    }
}
