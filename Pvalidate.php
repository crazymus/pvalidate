<?php

class Pvalidate
{
    const ERROR_CODE_DEFAULT = 1001;
    public static function run($params, $rules)
    {
        if (!is_array($rules) || empty($rules)) throw new \RuntimeException('校验规则不能为空', self::ERROR_CODE_DEFAULT);
        if (!is_array($params) || empty($params)) throw new \RuntimeException('请传递正确的参数', self::ERROR_CODE_DEFAULT);

        $result = [];
        foreach ($rules as $key => $rule) {
            $value = trim($params[$key] ?? '');
            if ($rule['required'] && $value === '') {
                throw new \RuntimeException($rule['title'] . '不能为空', 501);
            }

            if ($rule['type'] == 'int') {
                $value = (int) $value;
            } elseif ($rule['type'] == 'float') {
                $value = (float) $value;
            } else {
				$value = htmlspecialchars(trim($value), ENT_QUOTES);
			}

            if (isset($rule['enum'])) {
                if (!in_array($value, $rule['enum'])) {
                    $errorMsg = $rule['error_msg'] ?? '请传递正确的' . $rule['title'];
                    throw new \RuntimeException($errorMsg, 501);
                }
            }

            if (in_array($rule['type'], ['int', 'float'])) {
                self::validateIntAndFloat($value, $rule);
            }
            if ($rule['type'] == 'string') {
                self::validateString($value, $rule);
            }

            $result[$key] = $value;
        }

        return $result;
    }

    protected static function validateIntAndFloat($value, $rule)
    {
        if (isset($rule['min_range']) && $value < $rule['min_range']) {
            $errorMsg = $rule['error_msg'] ?? $rule['title'] . '不能小于' . $rule['min_range'];
            throw new \RuntimeException($errorMsg, 501);
        }
        if (isset($rule['max_range']) && $value > $rule['max_range']) {
            $errorMsg = $rule['error_msg'] ?? $rule['title'] . '不能大于' . $rule['max_range'];
            throw new \RuntimeException($errorMsg, 501);
        }
    }

    protected static function validateString($value, $rule)
    {
        if (isset($rule['min_length']) && mb_strlen($value) < $rule['min_length']) {
            $errorMsg = $rule['error_msg'] ?? $rule['title'] . '长度不能小于' . $rule['min_length'];
            throw new \RuntimeException($errorMsg, 501);
        }

        if (isset($rule['max_length']) && mb_strlen($value) > $rule['max_length']) {
            $errorMsg = $rule['error_msg'] ?? $rule['title'] . '长度不能大于' . $rule['max_length'];
            throw new \RuntimeException($errorMsg, 501);
        }
    }
}