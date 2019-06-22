# Pvalidate
一款简单易用的php数据验证器。数据校验是web开发中重要的环节，也是一项很繁琐的工作。为了提升效率，我想到开发一款通过简单的配置就能完成数据校验的工具，于是，Pvalidate诞生了~~
## 使用要求
-  \>= PHP5.2

## 安装 
项目目录下执行
```
composer require "crazymus/pvalidate"
```
若没有全局安装composer，可执行
```
php composer.phar require "crazymus/pvalidate"
```
## 快速上手
```
<?php 

$params = [
    'name' => 'crazymus',
    'age' => 20
];

$rules = [
    'name' => [
        'type' => 'string',  // 字符串类型
        'required' => true,  // 这是必填项
        'title' => '姓名',  // 字段名称 
    ],
    'age' => [
        'type' => 'int', // 整数类型 
        'required' => true,
        'title' => '年龄',
    ],
];

try {
    $validateParams = \Crazymus\Pvalidate::run($params, $rules);
    print_r($validateParams);  // 校验后得到的数据
} catch (\RuntimeException $e) {
    $e->getMessage();
}
```

## 长度校验
```
<?php

// 注意，长度校验仅支持string类型
$rules = [
    'name' => [
        'type' => 'string',
        'required' => true,
        'title' => '姓名',
        'min_length' => 10, // 最小长度
        'max_length' => 20, // 最大长度 
    ],
];

?>
```

## 范围校验 
```
<?php 

$rules = [
    'age' => [
        'type' => 'int',
        'required' => true,
        'title' => '年龄',
        'min_range' => 1, // 最小值为1
        'max_range' => 100, // 最大值为100
    ],
];

?>
```

## 枚举值校验 
```
<?php 

$rules = [
    'sex' => [
        'type' => 'int',
        'required' => true,
        'title' => '性别',
        'enum' => [1,2], // 只能是列出的值 
    ],
];

?>
```

## 浮点数类型 
```
<?php 

$rules = [
    'money' => [
        'type' => 'float',  // 浮点数类型 
        'required' => true,
        'title' => '充值金额',
        'min_range' => 1.5,  // 最小值
        'max_range' => 100.25  // 最大值
    ]
];

?>
```

## 自定义错误信息 
```
<?php 

// 自定义错误提示会覆盖默认错误提示
$rules = [
    'name' => [
        'type' => 'string',
        'required' => true,
        'title' => '姓名',
        'error_msg' => '姓名格式错误',
    ],
];

?>
```

## 其他问题
若无法正常安装，推荐使用composer中国全量镜像
- https://pkg.phpcomposer.com

## 关于我 

crazymus，web开发者，目前定居湖北武汉。
- 个人博客：https://my.oschina.net/crazymus
- 邮箱：crazymus@foxmail.com


