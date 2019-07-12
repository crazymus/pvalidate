<?php

define("APP_PATH", dirname(__FILE__));

spl_autoload_register(function ($className) {
    $className = str_replace("Crazymus\\", "src\\", $className);
    $filePath = APP_PATH  . '/' . $className . '.php';
    // mac, linux, window 路径分隔符统一
    $filePath = str_replace("\\", DIRECTORY_SEPARATOR, $filePath);
    if (file_exists($filePath)) {
        require_once $filePath;
    }
});


$params = array(
    'name' => '用户名用户名',
    'age' => 19,
    'sex' => 2,
    'ratio' => "0.9",
    'money' => 100.23,
    'job' => 'Engineer',
    'email' => 'crazymus@foxmail.com',
    'phone' => 18507105403,
    'site' => 'https://www.baidu.com/user/index?id=3&name=crazymus',
    'hobby' => 'music'
);

$rules = array(
    'name' => array(
        'title' => '姓名',
        'required' => true,
        'minLenght' => 1,
        'maxLength' => 6,
        'charset' => 'utf-8'
    ),
    'age' => array(
        'type' => 'integer',
        'title' => '年龄',
        'required' => true,
        'value' => array('>=', 18)
    ),
    'sex' => array(
        'type' => 'number',
        'title' => '性别',
        'required' => true,
        'enum' => array(1, 2),
        'errorMsg' => '性别格式错误'
    ),
    'money' => array(
        'type' => 'money',
        'title' => '金额',
        'required' => true,
    ),
    'job' => array(
        'title' => '职业',
        'required' => false,
    ),
    'email' => array(
        'type' => 'email',
        'title' => '邮箱',
        'required' => true
    ),
    'phone' => array(
        'type' => 'phone',
        'title' => '手机号',
        'required' => true
    ),
    'site' => array(
        'type' => 'url',
        'title' => '网址',
        'required' => true
    ),
    'ratio' => array(
        'type' => 'float',
        'title' => '比率',
        'required' => true,
        'precision' => 2
    ),
    'hobby' => array(
        'type' => 'myRule',
        'title' => '爱好',
        'required' => true,
    )
);

// 添加自定义规则
//\Crazymus\Pvalidate::addRules('myRule', 'MyRule');
\Crazymus\Pvalidate::addRules(array(
    'myRule' => '\Crazymus\customRule\MyRule'
));


try {
    $validateParams = \Crazymus\Pvalidate::validate($params, $rules);
    pp($validateParams);
} catch (\Exception $e) {
    echo $e->getMessage();
}


function pp($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
    exit;
}

