# Pvalidate
一款简单易用的php数据验证器。数据校验是web开发中重要的环节，也是一项很繁琐的工作。为了提升效率，我想到开发一款通过简单的配置就能完成数据校验的工具，于是，Pvalidate诞生了~~
## 使用要求
-  \>= PHP5.3
-  mbstring扩展

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
    )),
    'age' => new \Crazymus\Rule\NumberRule(array(
        'title' => '年龄',
        'required' => true,
        'minRange' => 0,  // 最小值
        'maxRange' => 100, // 最大值 
    )), 
);

try {
    $validateParams = \Crazymus\Pvalidate::run($params, $rules);
    print_r($validateParams);  // 校验后得到的数据
} catch (\RuntimeException $e) {
    $e->getMessage();
}
```


## 枚举值校验 
```
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

## 自定义错误信息 
```
<?php 

// 自定义错误提示会覆盖默认错误提示
$rules = array(
    'name' => new \Crazymus\Rule\StringRule(array(
        'title' => '姓名',
        'required' => true,
        'errorMsg' => '姓名格式错误', // 会覆盖默认错误提示
    )),
)

?>
```

## 其他问题
若无法正常安装，推荐使用composer中国全量镜像
- https://pkg.phpcomposer.com

## 关于我 

crazymus，web开发者，目前定居湖北武汉。
- 个人博客：https://my.oschina.net/crazymus
- 邮箱：crazymus@foxmail.com


