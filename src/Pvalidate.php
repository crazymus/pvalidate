<?php namespace Crazymus;

use Crazymus\Rule\BaseRule;

class Pvalidate
{
    /**
     * 验证规则与类的映射关系
     * @var array
     */
    protected static $ruleMap = array(
        'string' => '\Crazymus\Rule\StringRule',
        'integer' => '\Crazymus\Rule\IntegerRule',
        'number' => '\Crazymus\Rule\NumberRule',
        'money' => '\Crazymus\Rule\MoneyRule',
        'email' => '\Crazymus\Rule\EmailRule',
        'phone' => '\Crazymus\Rule\PhoneRule',
        'url' => '\Crazymus\Rule\URLRule',
        'float' => '\Crazymus\Rule\FloatRule',
        'idCard' => '\Crazymus\Rule\IDCardRule',
    );

    /**
     * 挂载自定义验证规则
     * @param $ruleName  array|string   规则名称
     * @param $ruleClass string   规则类名称
     * @throws PvalidateException
     */
    public static function addRules($ruleName, $ruleClass = '')
    {
        if (is_array($ruleName)) {
            foreach ($ruleName as $ruleN => $ruleC) {
                if (!isset(self::$ruleMap[$ruleN])) {
                    if (!empty($ruleC)) {
                        self::$ruleMap[$ruleN] = $ruleC;
                    } else {
                        throw new PvalidateException('规则不能为空');
                    }
                } else {
                    throw new PvalidateException($ruleN.'规则已经存在');
                }
            }
            return true;
        }

        if (!isset(self::$ruleMap[$ruleName])) {
            if (!empty($ruleClass)) {
                self::$ruleMap[$ruleName] = $ruleClass;
            } else {
                throw new PvalidateException('规则已经存在');
            }
        } else {
            throw new PvalidateException($ruleName.'规则已经存在');
        }
        return true;
    }

    /**
     * 获取验证规则类的实例
     * @param $type string  验证类型
     * @param $rules        验证内容
     * @return object
     * @throws PvalidateException
     * @throws \ReflectionException
     */
    protected static function getRuleClass($type = 'string', $rules)
    {
        if (isset(self::$ruleMap[$type]) && !empty(self::$ruleMap[$type])) {

            try {
                $ref = new \ReflectionClass(self::$ruleMap[$type]);
                $instance  = $ref->newInstance($rules);

                if ($instance instanceof BaseRule) {
                    return $instance;
                }
                throw new PvalidateException(self::$ruleMap[$type].'不合法');
            } catch (\ReflectionException $e) {
                throw new PvalidateException(self::$ruleMap[$type].'不存在');
            }

        }
        throw new PvalidateException('校验规则不存在');
    }


    public static function validate($params, $rules)
    {
        if (!is_array($rules) || empty($rules)) throw new PvalidateException('校验规则不能为空');
        if (!is_array($params) || empty($params)) throw new PvalidateException('请传递正确的参数');

        $result = array();
        /**
         * @var BaseRule $rule
         */
        foreach ($rules as $key => $rule) {
            $value = isset($params[$key]) ? trim($params[$key]) : '';

            $ruleName = isset($rule['type']) ? $rule['type'] : 'string';
            $ruleClass = self::getRuleClass($ruleName, $rule);

            if ($ruleClass->getRequired()) {
                $ruleClass->validate($value);
            }
            if (!$ruleClass->getRequired() && $value !== '') {
                $ruleClass->validate($value);
            }

            $result[$key] = $value;
        }

        return $result;
    }
}