<?php namespace Crazymus;

use Crazymus\Rule\BaseRule;

class Pvalidate
{
    public static function validate($params, $rules)
    {
        if (!is_array($rules) || empty($rules)) throw new PvalidateException('校验规则不能为空');
        if (!is_array($params) || empty($params)) throw new PvalidateException('请传递正确的参数');

        $result = array();
        /**
         * @var BaseRule $rule
         */
        foreach ($rules as $key => $rule) {
            $value = isset($params[$key]) ? $params[$key] : '';
            $value = trim($value);
            $rule->validate($value);
            $result[$key] = $value;
        }

        return $result;
    }
}