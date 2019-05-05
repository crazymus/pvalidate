<?php

class Pvalidate
{
    const ERROR_CODE_DEFAULT = 1001;
    public static function run($rules)
    {
        if (!is_array($rules) || empty($rules)) throw new \RuntimeException('规则不能为空', self::ERROR_CODE_DEFAULT);
        
        foreach ($rules as $rule) {
            
        }
    }
}