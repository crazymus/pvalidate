<?php namespace Crazymus\Rule;

use Crazymus\PvalidateException;

class StringRule extends BaseRule
{
    protected $minLength = null;
    protected $maxLength = null;

    public function validate($value)
    {
        parent::validate($value);

        if (isset($this->minLength) && mb_strlen($value) < $this->minLength) {
            throw new PvalidateException($this->renderErrorMsg('长度不能小于' . $this->minLength));
        }
        if (isset($this->maxLength) && mb_strlen($value) > $this->maxLength) {
            throw new PvalidateException($this->renderErrorMsg('长度不能大于' . $this->maxLength));
        }
    }

}
