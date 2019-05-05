<?php

class Pvalidate
{
    const ERROR_CODE_DEFAULT = 1001;
    public static function run($params, $rules)
    {
        if (!is_array($rules) || empty($rules)) throw new \RuntimeException('规则不能为空', self::ERROR_CODE_DEFAULT);
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
                    throw new \RuntimeException($rule['title'] . '参数错误', 501);
                }
            }

            if (in_array($rule['type'], ['int', 'float'])) {
                if (isset($rule['min_range']) && $value < $rule['min_range']) {
                    throw new \RuntimeException($rule['title'] . '不能小于' . $rule['min_range'], 501);
                }
                if (isset($rule['max_range']) && $value > $rule['max_range']) {
                    throw new \RuntimeException($rule['title'] . '不能大于' . $rule['max_range'], 501);
                }
            }

            $result[$key] = $value;
        }

        return $result;
    }
}