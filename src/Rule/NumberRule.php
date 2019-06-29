<?php namespace Crazymus\Rule;

use Crazymus\PvalidateException;

class NumberRule extends BaseRule
{
    protected $minRange = null;
    protected $maxRange = null;

    public function validate($value)
    {
        parent::validate($value);

        if (!is_numeric($value)) throw new PvalidateException($this->renderErrorMsg('类型错误'));

        if (isset($this->minRange) && $value < $this->minRange) {
            throw new PvalidateException($this->renderErrorMsg('不能小于' . $this->minRange));
        }
        if (isset($this->maxRange) && $value > $this->maxRange) {
            throw new PvalidateException($this->renderErrorMsg('不能大于' . $this->maxRange));
        }
    }
}
