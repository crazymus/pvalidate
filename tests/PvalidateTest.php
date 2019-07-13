<?php

final class PvalidateTest extends PHPUnit_Framework_TestCase
{
    public function testCannotBeValidateFromInvalidRules()
    {
        $params = array(
            'name' => 'crazymus'
        );
        $rules = null;
        $this->setExpectedException('\Crazymus\PvalidateException');
        \Crazymus\Pvalidate::validate($params, $rules);
    }

    public function testCannotBeValidateFromEmptyRules()
    {
        $params = array('name' => 'crazymus');
        $rules = array();
        $this->setExpectedException('\Crazymus\PvalidateException');
        \Crazymus\Pvalidate::validate($params, $rules);
    }

    public function testCannotUseInvalidRule()
    {
        $params = array('name' => 'crazymus');
        $rules = array(
            'name' => array(
                'type' => 'string2',
                'title' => '测试'
            )
        );
        $this->setExpectedException('\Crazymus\PvalidateException');
        \Crazymus\Pvalidate::validate($params, $rules);
    }
}