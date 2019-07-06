<?php namespace Crazymus\Rule;

use Crazymus\PvalidateException;

class PhoneRule extends StringRule
{
    public function validate($param)
    {
        parent::validate($param);

        if (!is_numeric($param) || strlen($param) != 11) {
            throw new PvalidateException($this->renderErrorMsg('必须为11位数字'));
        }

        if (substr($param, 0, 1) != 1) {
            throw new PvalidateException($this->renderErrorMsg('格式错误'));
        }
    }
}