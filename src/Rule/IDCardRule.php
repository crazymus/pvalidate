<?php namespace Crazymus\Rule;

use Crazymus\PvalidateException;

class IDCardRule extends StringRule
{
    public function validate($param)
    {
        $length = strlen($param);
        if ($length == 15) {
            $this->validateFirstGeneration($param);
        } elseif ($length == 18) {
            $this->validateSecondGeneration($param);
        } else {
            throw new PvalidateException($this->renderErrorMsg('长度必须为15位或18位'));
        }
    }

    protected function validateFirstGeneration($param)
    {
        $pattern = '/^[1-9]\\d{7}((0\\d)|(1[0-2]))(([0|1|2]\\d)|3[0-1])\\d{3}$/';
        if (!preg_match($pattern, $param)) {
            throw new PvalidateException($this->renderErrorMsg('格式错误'));
        }
    }

    protected function validateSecondGeneration($param)
    {
        $pattern = '/^[1-9]\\d{5}[1-9]\\d{3}((0\\d)|(1[0-2]))(([0|1|2]\\d)|3[0-1])((\\d{4})|\\d{3}[A-Z])$/';
        if (!preg_match($pattern, $param)) {
            throw new PvalidateException($this->renderErrorMsg('格式错误'));
        }
    }
}
