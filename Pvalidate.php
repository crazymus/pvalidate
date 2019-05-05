<?php

class Pvalidate
{
    public static function run($rules)
    {
        if (empty($rules)) throw new \RuntimeException('规则不能为空', 501);
    }
}