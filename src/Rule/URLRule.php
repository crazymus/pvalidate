<?php namespace Crazymus\Rule;

use Crazymus\PvalidateException;

class URLRule extends StringRule
{
    public function validate($param)
    {
        parent::validate($param);

        if (!filter_var($param, FILTER_VALIDATE_URL)) {
            throw new PvalidateException($this->renderErrorMsg('格式错误'));
        }
    }
}
