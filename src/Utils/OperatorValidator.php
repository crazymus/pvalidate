<?php namespace Crazymus\Utils;

use Crazymus\PvalidateException;

class OperatorValidator
{
    protected static $operators = array(
        '==',
        '>',
        '>=',
        '<',
        '<='
    );

    public static function validate($param, $rules)
    {
        if (is_numeric($rules)) {
            $value = $rules;
            if ($param != $value) {
                throw new PvalidateException(sprintf('必须等于%s', $value));
            }
        } elseif (is_array($rules)) {
            if (is_array($rules[0])) {
                foreach ($rules as $rule) {
                    self::validateSimpleRule($param, $rule);
                }
            } else {
                $rule = $rules;
                self::validateSimpleRule($param, $rule);
            }
        }
    }

    public static function validateSimpleRule($param, $rule)
    {
        if (count($rule) != 2) {
            throw new PvalidateException(':value校验规则错误');
        }

        $operator = $rule[0];
        $value = $rule[1];

        if (!is_numeric($value)) throw new PvalidateException(':范围校验仅支持数字!');
        if (!in_array($operator, self::$operators)) {
            throw new PvalidateException(sprintf(':%s为不支持的运算符', $operator));
        }

        $executeString = " return ($param $operator $value);";
        $result = eval($executeString);
        if (!$result) {
            throw new PvalidateException('范围校验不通过');
        }
    }
}
