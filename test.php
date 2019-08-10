<?php

define("APP_PATH", dirname(__FILE__));

spl_autoload_register(function ($className) {
    $className = str_replace("Crazymus\\", "src\\", $className);
    $filePath = APP_PATH  . '/' . $className . '.php';
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
    'age' => 20,
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
    'name' => new \Crazymus\Rule\StringRule(array(
        'title' => '姓名',
        'required' => true,
        'minLenght' => 1,
        'maxLength' => 6,
        'charset' => 'utf-8'
    )),
    'age' => new \Crazymus\Rule\IntegerRule(array(
        'title' => '年龄',
        'required' => true,
        'minRange' => 0,
        'maxRange' => 100,
        'value' => array('>', 18)
    )),
    'sex' => new \Crazymus\Rule\NumberRule(array(
        'title' => '性别',
        'required' => true,
        'enum' => array(1, 2),
        'errorMsg' => '性别格式错误'
    )),
    'money' => new \Crazymus\Rule\MoneyRule(array(
        'title' => '金额',
        'required' => true,
    )),
    'job' => new \Crazymus\Rule\StringRule(array(
        'title' => '职业',
        'required' => false,
    )),
    'email' => new \Crazymus\Rule\EmailRule(array(
        'title' => '邮箱',
        'required' => true
    )),
    'phone' => new \Crazymus\Rule\PhoneRule(array(
        'title' => '手机号',
        'required' => true
    )),
    'site' => new \Crazymus\Rule\URLRule(array(
        'title' => '网址',
        'required' => true
    )),
    'ratio' => new \Crazymus\Rule\FloatRule(array(
        'title' => '比率',
        'required' => true,
        'precision' => 2
    )),
    'hobby' => new MyRule(array(
        'title' => '爱好',
        'required' => true,
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


