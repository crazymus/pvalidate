<?php namespace Crazymus\Rule;

use Crazymus\PvalidateException;

class IDCardRule extends StringRule
{
    public function validate($value)
    {
        $length = strlen($value);
        if ($length == 15) {
            $this->validateFirstGeneration($value);
        } elseif ($length == 18) {
            $this->validateSecondGeneration($value);
        } else {
            throw new PvalidateException($this->renderErrorMsg('长度必须为15位或18位'));
        }
    }

    protected function validateFirstGeneration($value)
    {
        $pattern = '/^[1-9]\\d{7}((0\\d)|(1[0-2]))(([0|1|2]\\d)|3[0-1])\\d{3}$/';
        if (!preg_match($pattern, $value)) {
            throw new PvalidateException($this->renderErrorMsg('格式错误'));
        }
    }

    protected function validateSecondGeneration($value)
    {
        $pattern = '/^[1-9]\\d{5}[1-9]\\d{3}((0\\d)|(1[0-2]))(([0|1|2]\\d)|3[0-1])((\\d{4})|\\d{3}[A-Z])$/';
        if (!preg_match($pattern, $value)) {
            throw new PvalidateException($this->renderErrorMsg('格式错误'));
        }
    }
}
