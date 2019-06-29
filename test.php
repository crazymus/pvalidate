<?php

define("APP_PATH", dirname(__FILE__));

spl_autoload_register(function ($className) {
    $className = str_replace("Crazymus\\", "src\\", $className);
    $filePath = APP_PATH  . '/' . $className . '.php';
    if (file_exists($filePath)) {
        require_once $filePath;
    }
});

$params = array(
    'name' => 'crazymus',
    'age' => 20,
    'sex' => 2,
    'money' => 20.56,
    'job' => 'Engineer'
);

$rules = array(
    'name' => array(
        'type' => 'string',
        'required' => true,
        'title' => '姓名',
        'min_length' => 2,
        'max_length' => 15,
        'error_msg' => '姓名格式错误'
    ),
    'age' => array(
        'type' => 'int',
        'required' => true,
        'title' => '年龄',
        'min-range' => 1,
    ),
    'sex' => array(
        'type' => 'int',
        'required' => true,
        'title' => '性别',
        'enum' => array(1,2)
    ),
    'money' => array(
        'type' => 'float',
        'required' => true,
        'title' => '充值金额',
        'min-range' => 1.5,
        'max-range' => 100.25
    ),
    'job' => array(
        'type' => 'string',
        'required' => false,
        'title' => '职业',
        'max_length' => 10
    )
);


try {
    $validateParams = \Crazymus\Pvalidate::run($params, $rules);
    pp($validateParams);
} catch (\Exception $e) {
    echo $e->getMessage();
}


function pp($array)
{
    print_r($array);
    exit;
}
