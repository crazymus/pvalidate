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
    'age' => 1,
    'sex' => 2,
    'money' => 20.56,
    'job' => 'Engineer'
);

$rules = array(
    'name' => new \Crazymus\Rule\StringRule(array(
        'title' => '姓名',
        'required' => true,
        'minLenght' => 1,
        'maxLength' => 10
    )),
    'age' => new \Crazymus\Rule\NumberRule(array(
        'title' => '年龄',
        'required' => true,
        'minRange' => 0,
        'maxRange' => 100,
    )),
    'sex' => new \Crazymus\Rule\NumberRule(array(
        'title' => '性别',
        'required' => true,
        'enum' => array(1, 2),
        'errorMsg' => '性别格式错误'
    )),
    'money' => new \Crazymus\Rule\NumberRule(array(
        'title' => '金额',
        'required' => true,
        'minRange' => 0
    )),
    'job' => new \Crazymus\Rule\StringRule(array(
        'title' => '职业',
        'required' => false,
    ))
);


try {
    $validateParams = \Crazymus\Pvalidate::validate($params, $rules);
    pp($validateParams);
} catch (\Exception $e) {
    echo $e->getMessage();
}


function pp($array)
{
    print_r($array);
    exit;
}
