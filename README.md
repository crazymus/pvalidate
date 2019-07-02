# Pvalidate #  

[![GitHub](https://img.shields.io/github/license/crazymus/pvalidate.svg)](LICENSE)
![GitHub repo size](https://img.shields.io/github/repo-size/crazymus/pvalidate.svg)

数据校验是web开发中重要的环节，也是一项很繁琐的工作。为了提升效率，我想到开发一款通过简单的配置就能完成数据校验的工具，于是，Pvalidate诞生了.

## 使用要求 ##
-  \>= PHP5.3
-  mbstring扩展

## 安装 ##
项目目录下执行
```
composer require "crazymus/pvalidate"
```
若没有全局安装composer，可执行
```
php composer.phar require "crazymus/pvalidate"
```
若无法正常安装，推荐使用composer中国全量镜像
- https://pkg.phpcomposer.com

## 目录 ##
- [字符串校验](#字符串校验)
- [数字校验](#数字校验)
- [整数校验](#整数校验)
- [浮点数校验](#浮点数校验)
- [手机号校验](#手机号校验)
- [金额校验](#金额校验)
- [邮箱校验](#邮箱校验)
- [URL校验](#URL校验)
- [枚举值校验](#枚举值校验)
- [自定义校验规则](#自定义校验规则)
- [自定义错误信息](#自定义错误信息)

## 字符串校验 ##  
```php
<?php 

$params = array(
    'name' => 'crazymus',
    'age' => 20
);

$rules = array(
    'name' => new \Crazymus\Rule\StringRule(array(
        'title' => '姓名', // 字段名称
        'required' => true, // 必填 
        'minLenght' => 1,  // 最小长度
        'maxLength' => 10 // 最大长度
    ))
);

try {
    $validateParams = \Crazymus\Pvalidate::validate($params, $rules);
    print_r($validateParams);  // 校验后得到的数据
} catch (\Exception $e) {
    $e->getMessage();
}
```
[返回目录](#目录)
 
## 数字校验 ## 
```php
<?php

$rules = array(
    'age' => new \Crazymus\Rule\NumberRule(array(
        'title' => '年龄',
        'required' => true,
        'minRange' => 0,  // 最小值
        'maxRange' => 100, // 最大值 
    )), 
);

?>
```
[返回目录](#目录)

## 整数校验  ##
```php
<?php

$rules = array(
    'age' => new \Crazymus\Rule\IntegerRule(array(
        'title' => '年龄',
        'required' => true,
        'minRange' => 0,  // 最小值
        'maxRange' => 100, // 最大值 
    )), 
);

?>
```
[返回目录](#目录)

## 浮点数校验 ##
```php
<?php

$rules = array(
    'ratio' => new \Crazymus\Rule\FloatRule(array(
        'title' => '比率',
        'required' => true,
        'minRange' => 0, // 最小值为0
        'precision' => 2, // 小数点位数最大为2 
    )), 
);

?>
```
[返回目录](#目录)

## 手机号校验 ##
```php
<?php

$rules = array(
    'phone' => new \Crazymus\Rule\PhoneRule(array(
        'title' => '手机号',
        'required' => true,
    )),
);

?>
```
[返回目录](#目录)

## 金额校验 ##
```php
<?php

$rules = array(
    'money' => new \Crazymus\Rule\MoneyRule(array(
        'title' => '金额',
        'required' => true,
    )),
);

?>
```
[返回目录](#目录)

## 邮箱校验 ##
```php
<?php

$rules = array(
    'email' => new \Crazymus\Rule\EmailRule(array(
        'title' => '邮箱',
        'required' => true,
    )),
);

?>
```
[返回目录](#目录)

## URL校验 ##
```php
<?php

$rules = array(
    'site' => new \Crazymus\Rule\URLRule(array(
        'title' => '网址',
        'required' => true,
    )),
);

?>
```
[返回目录](#目录)

## 身份证校验 ##
```php
<?php

$rules = array(
    'idcard' => new \Crazymus\Rule\IDCardRule(array(
        'title' => '身份证',
        'required' => true,
    )),
);

?>
```
[返回目录](#目录)

## 枚举值校验 ##
```php
<?php 

$rules = array(
    'sex' => new \Crazymus\Rule\NumberRule(array(
        'title' => '性别',
        'required' => true,
        'enum' => array(1, 2),  // 必须是数组中的值
    )),
)

?>
```
[返回目录](#目录)

## 自定义校验规则 ##
我们可以编写自己的校验规则，来应对特殊的校验场景。可以根据参数的含义，选择继承StringRule
或者NumberRule，并重载validate方法即可。
```php
<?php

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

$rules = array(
    'hobby' => new MyRule(array(
        'title' => '爱好',
        'required' => true,
    ))
);

?>
```
[返回目录](#目录)

## 自定义错误信息 ##
```php
<?php 

$rules = array(
    'name' => new \Crazymus\Rule\StringRule(array(
        'title' => '姓名',
        'required' => true,
        'errorMsg' => '姓名格式错误', // 会覆盖默认错误提示
    )),
)

?>
```
[返回目录](#目录)


