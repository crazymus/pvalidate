<?php namespace Crazymus\Rule;

use Crazymus\PvalidateException;

class EmailRule extends StringRule
{
    public function validate($value)
    {
        parent::validate($value);

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new PvalidateException($this->renderErrorMsg('格式错误'));
        }
    }
}