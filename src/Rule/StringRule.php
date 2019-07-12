<?php namespace Crazymus\Rule;

use Crazymus\PvalidateException;
use Crazymus\Utils\OperatorValidator;

class StringRule extends BaseRule
{
    protected $length = null;
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

        $length = mb_strlen($param);
        if (isset($this->minLength) && $length < $this->minLength) {
            throw new PvalidateException($this->renderErrorMsg('长度不能小于' . $this->minLength));
        }
        if (isset($this->maxLength) && $length > $this->maxLength) {
            throw new PvalidateException($this->renderErrorMsg('长度不能大于' . $this->maxLength));
        }

        if (isset($this->length)) {
            try {
                OperatorValidator::validate($length, $this->length);
            } catch (PvalidateException $e) {
                throw new PvalidateException($this->renderErrorMsg(sprintf("长度%s", $e->getMessage())));
            }
        }
    }

}
