<?php namespace Crazymus\Rule;

use Crazymus\PvalidateException;

class EmailRule extends StringRule
{
    public function validate($param)
    {
        parent::validate($param);

        if (!filter_var($param, FILTER_VALIDATE_EMAIL)) {
            throw new PvalidateException($this->renderErrorMsg('格式错误'));
        }
    }
}