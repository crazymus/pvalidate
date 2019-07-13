<center>
    <img src="https://crazymus.oss-cn-beijing.aliyuncs.com/1111.png" style="width:500px;"/>
</center>

[![Travis (.org)](https://img.shields.io/travis/crazymus/pvalidate.svg)](https://www.travis-ci.org/crazymus/pvalidate)
[![GitHub](https://img.shields.io/github/license/crazymus/pvalidate.svg)](LICENSE)
![GitHub repo size](https://img.shields.io/github/repo-size/crazymus/pvalidate.svg)
![PHP from Packagist (specify version)](https://img.shields.io/packagist/php-v/crazymus/pvalidate/v2.0.svg)

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
- [身份证校验](#身份证校验)
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
    'name' => array(
        'type' => 'string', // 字符串类型
        'title' => '姓名', // 字段名称
        'required' => true, // 必填 
        'length' => 10, // 长度必须等于10
        'charset' => 'GBK', // 字符串编码，所不指定则默认使用文档的编码
    )
);

// 长度支持运算符 
$rules = array(
    'name' => array(
        'type' => 'string',  
        'length' => array('>', 10), // 长度必须大于10  
    )
);

$rules = array(
    'name' => array(
        'type' => 'string',  
        'length' => array( // 长度必须大于10，且小于等于50
            array('>', 10),
            array('<=', 50)
        ), 
    )
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
    'age' => array(
        'type' => 'number', 
        'title' => '年龄',
        'required' => true,
        'value' => 10, // 值必须等于10
    ), 
);

// 支持运算符校验
$rules = array(
    'age' => array(
        'type' => 'number', 
        'value' => array('>', 18) // 大于18
    )
);

$rules = array(
    'age' => array(
        'type' => 'number', 
        'value' => array(  // 大于等于18，且小于60 
            array('>=', 18),
            array('<', 60)
        )
    )
);

?>
```
[返回目录](#目录)

## 整数校验  ##
```php
<?php

$rules = array(
    'age' => array(
        'type' => 'integer', 
        'title' => '年龄',
        'required' => true,
        'value' => array('>', 18)
    ), 
);

?>
```
[返回目录](#目录)

## 浮点数校验 ##
```php
<?php

$rules = array(
    'ratio' => array(
        'type' => 'float', 
        'title' => '比率',
        'required' => true,
        'precision' => 2, // 小数点位数最大为2 
        'value' => array('>', 1.25)
    ), 
);

?>
```
[返回目录](#目录)

## 手机号校验 ##
```php
<?php

$rules = array(
    'phone' => array(
        'type' => 'phone', 
        'title' => '手机号',
        'required' => true,
    ),
);

?>
```
[返回目录](#目录)

## 金额校验 ##
```php
<?php

$rules = array(
    'money' => array(
        'type' => 'money', 
        'title' => '金额',
        'required' => true,
    ),
);

?>
```
[返回目录](#目录)

## 邮箱校验 ##
```php
<?php

$rules = array(
    'email' => array(
        'type' => 'email', 
        'title' => '邮箱',
        'required' => true,
    ),
);

?>
```
[返回目录](#目录)

## URL校验 ##
```php
<?php

$rules = array(
    'site' => array(
        'type' => 'url', 
        'title' => '网址',
        'required' => true,
    ),
);

?>
```
[返回目录](#目录)

## 身份证校验 ##
```php
<?php

$rules = array(
    'idcard' => array(
        'type' => 'idCard', 
        'title' => '身份证',
        'required' => true,
    ),
);

?>
```
[返回目录](#目录)

## 枚举值校验 ##
```php
<?php 

$rules = array(
    'sex' => array(
        'type' => 'number', 
        'title' => '性别',
        'required' => true,
        'enum' => array(1, 2),  // 必须是数组中的值
    ),
)

?>
```
[返回目录](#目录)

## 自定义校验规则 ##
我们可以编写自己的校验规则，来应对特殊的校验场景。可以根据参数的含义，选择继承StringRule
或者NumberRule，并重载validate方法即可。
```php
<?php namespace MyApp\Rules;

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

// 添加自定义规则 
\Crazymus\Pvalidate::addRules(array(
    'myRule' => '\MyApp\Rules\MyRule'
));

// 使用自定义规则 
$rules = array(
    'hobby' => array(
        'type' => 'myRule', 
        'title' => '爱好',
        'required' => true,
    )
);

?>
```
[返回目录](#目录)

## 自定义错误信息 ##
```php
<?php 

$rules = array(
    'name' => array(
        'type' => 'string',
        'title' => '姓名',
        'required' => true,
        'errorMsg' => '姓名格式错误', // 会覆盖默认错误提示
    ),
)

?>
```
[返回目录](#目录)


