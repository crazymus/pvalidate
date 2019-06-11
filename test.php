<?php

define("APP_PATH", dirname(__FILE__));
require(APP_PATH . '/Pvalidate.php');

$params = [
    'name' => 'crazymus222222222222222',
    'age' => 20,
    'sex' => 2,
    'money' => 20.56,
    'job' => 'Engineer'
];

$rules = [
    'name' => [
        'type' => 'string',
        'required' => true,
        'title' => '姓名',
        'min-length' => 10,
        'max-length' => 20,
        'error_msg' => '姓名格式错误'
    ],
    'age' => [
        'type' => 'int',
        'required' => true,
        'title' => '年龄',
        'min-range' => 1,
    ],
    'sex' => [
        'type' => 'int',
        'required' => true,
        'title' => '性别',
        'enum' => [1,2]
    ],
    'money' => [
        'type' => 'float',
        'required' => true,
        'title' => '充值金额',
        'min-range' => 1.5,
        'max-range' => 100.25
    ]
];


try {
    $validateParams = Pvalidate::run($params, $rules);
    pp($validateParams);
} catch (\RuntimeException $e) {
    echo $e->getMessage();
}


function showInConsole($message)
{
    echo iconv('utf-8', 'gbk', $message);
}
function pp($array)
{
    print_r($array);
    exit;
}
