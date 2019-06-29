<?php namespace Crazymus\Rule;

use Crazymus\PvalidateException;

class URLRule extends StringRule
{
    public function validate($value)
    {
        parent::validate($value);

        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            throw new PvalidateException($this->renderErrorMsg('格式错误'));
        }
    }
}
