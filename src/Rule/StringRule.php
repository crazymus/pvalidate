<?php namespace Crazymus\Rule;

use Crazymus\PvalidateException;

class StringRule extends BaseRule
{
    protected $minLength = null;
    protected $maxLength = null;
    protected $charset = null;

    public function validate($param)
    {
        parent::validate($param);

        // 设置内部编码
        if ($this->charset) {
            mb_internal_encoding($this->charset);
        }

        if (isset($this->minLength) && mb_strlen($param) < $this->minLength) {
            throw new PvalidateException($this->renderErrorMsg('长度不能小于' . $this->minLength));
        }
        if (isset($this->maxLength) && mb_strlen($param) > $this->maxLength) {
            throw new PvalidateException($this->renderErrorMsg('长度不能大于' . $this->maxLength));
        }
    }

}
