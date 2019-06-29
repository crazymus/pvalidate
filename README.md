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
若无法正常安装，推荐使用composer中国全量镜像
- https://pkg.phpcomposer.com

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
    $validateParams = \Crazymus\Pvalidate::validate($params, $rules);
    print_r($validateParams);  // 校验后得到的数据
} catch (\Exception $e) {
    $e->getMessage();
}
```

## 手机号校验 
```
<?php

$rules = array(
    'phone' => new \Crazymus\Rule\PhoneRule(array(
        'title' => '手机号',
        'required' => true,
    )),
);

?>
```

## 金额校验 
```
<?php

$rules = array(
    'money' => new \Crazymus\Rule\MoneyRule(array(
        'title' => '金额',
        'required' => true,
    )),
);

?>
```

## 邮箱校验 
```
<?php

$rules = array(
    'email' => new \Crazymus\Rule\EmailRule(array(
        'title' => '邮箱',
        'required' => true,
    )),
);

?>
```

## URL校验 
```
<?php

$rules = array(
    'site' => new \Crazymus\Rule\URLRule(array(
        'title' => '网址',
        'required' => true,
    )),
);

?>
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

$rules = array(
    'name' => new \Crazymus\Rule\StringRule(array(
        'title' => '姓名',
        'required' => true,
        'errorMsg' => '姓名格式错误', // 会覆盖默认错误提示
    )),
)

?>
```

## 关于我 

crazymus，web开发者，目前定居湖北武汉。
- 博客：https://my.oschina.net/crazymus
- 邮箱：crazymus@foxmail.com

若有使用上的问题或建议，欢迎和我联系！


