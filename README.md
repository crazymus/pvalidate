# Pvalidate
一款简单易用的php数据验证器。数据校验是web开发中重要的环节，也是一项很繁琐的工作。为了提升效率，我想到开发一款通过简单的配置就能完成数据校验的工具，于是，Pvalidate诞生了~~
## 使用要求
-  \>= PHP5.2

## 安装 
直接拷贝Pvalidate.php到项目中。使用require引入，或使用Composer自动加载。
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
    $validateParams = Pvalidate::run($params, $rules);
    print_r($validateParams);  // 校验后得到的数据
} catch (\RuntimeException $e) {
    $e->getMessage();
}
```

## 范围校验 
```
<?php 

$params = [
    'name' => 'crazymus',
    'age' => 20
];

$rules = [
    'age' => [
        'type' => 'int',
        'required' => true,
        'title' => '年龄',
        'min-range' => 1, // 最小值为1
        'max-range' => 100, // 最大值为100
    ],
];

try {
    $validateParams = Pvalidate::run($params, $rules);
    print_r($validateParams);  // 校验后得到的数据
} catch (\RuntimeException $e) {
    $e->getMessage();
}

?>
```

## 枚举值校验 
```
<?php 

$params = [
    'name' => 'crazymus',
    'age' => 20,
    'sex' => 3,
];

$rules = [
    'sex' => [
        'type' => 'int',
        'required' => true,
        'title' => '性别',
        'enum' => [1,2], // 只能是列出的值 
    ],
];

try {
    $validateParams = Pvalidate::run($params, $rules);
    print_r($validateParams);  // 校验后得到的数据
} catch (\RuntimeException $e) {
    $e->getMessage();
}

?>
```

## 浮点数类型 
```
<?php 

$params = [
    'name' => 'crazymus',
    'age' => 20,
    'sex' => 3,
    'money' => 20.56,
];

$rules = [
    'money' => [
        'type' => 'float',  // 浮点数类型 
        'required' => true,
        'title' => '充值金额',
        'min-range' => 1.5,  // 最小值
        'max-range' => 100.25  // 最大值
    ]
];

try {
    $validateParams = Pvalidate::run($params, $rules);
    print_r($validateParams);  // 校验后得到的数据
} catch (\RuntimeException $e) {
    $e->getMessage();
}

?>
```

## 关于我 

crazymus，web开发者，目前定居湖北武汉，主要使用PHP和Java，也喜欢前端技术，曾经深入学习过ExtJS，欢迎与我交流~~
- 个人博客：https://my.oschina.net/crazymus
- 邮箱：crazymus@foxmail.com


