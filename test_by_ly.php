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


class MyRule extends \Crazymus\Rule\StringRule
{
    public function validate($value)
    {
        parent::validate($value);

        //TODO 实现你的校验逻辑
        if (!in_array($value, array('music', 'movie', 'book'))) {
            throw new \Crazymus\PvalidateException($this->renderErrorMsg('参数校验失败'));
        }
    }
}

$params = array(
    'name' => '用户名用户名',
    'idCard' => '131127198907280525'
);

$rules = array(
    'name' => array(
        'type' => 'string',
        'title' => '姓名',
        'required' => true,
        'minLenght' => 1,
        'maxLength' => 6,
        'charset' => 'utf-8'
    ),
    'idCard' => array(
        'type' => 'idCard',
        'title' => '身份证',
        'required' => true,
    )

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
