<?php namespace Crazymus\Rule;

use Crazymus\PvalidateException;

class PhoneRule extends StringRule
{
    public function validate($value)
    {
        parent::validate($value);

        if (!is_numeric($value) || strlen($value) != 11) {
            throw new PvalidateException($this->renderErrorMsg('必须为11位数字'));
        }

        if (substr($value, 0, 1) != 1) {
            throw new PvalidateException($this->renderErrorMsg('格式错误'));
        }
    }
}