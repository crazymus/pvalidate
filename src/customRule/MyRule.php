<?php
/**
 *
 * Created by WangYuan on 2019/7/9 下午12:32
 */

namespace Crazymus\customRule;


use Crazymus\Rule\BaseRule;

class MyRule extends BaseRule
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