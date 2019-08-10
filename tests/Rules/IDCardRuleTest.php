<?php

final class IDCardRuleTest extends PHPUnit_Framework_TestCase
{
    public function testRightRule()
    {
        $rules = array(
            'idcard' => array(
                'type' => 'idCard'
            )
        );

        $array = array(
            "513436200008108196",
            '513436200008107054',
            '513436200008109818',
            '513436200008106190',
            '51343620000810649X',
            '513436200008109199',
            '513436200008109295',
            '513436200008109439',
            '513436200008107433',
            '513436200008108014',
            '513436200008108698',
            '513436200008107695',
            '513436200008107572',
            '513436200008109615',
            '513436200008109279'
        );

        foreach ($array as $idcard) {
            $params = array(
                'idcard' => $idcard
            );
            $vParams = \Crazymus\Pvalidate::validate($params, $rules);
            $this->assertEquals($vParams['idcard'], $params['idcard']);
        }
    }

    public function testWrongLength()
    {
        $params = array(
            'idcard' => '51343620000810819'
        );

        $rules = array(
            'idcard' => array(
                'type' => 'idCard'
            )
        );

        $this->setExpectedException('\Crazymus\PvalidateException');
        \Crazymus\Pvalidate::validate($params, $rules);
    }

    public function testWrongValue()
    {
        $params = array(
            'idcard' => '5134362000081081x6'
        );

        $rules = array(
            'idcard' => array(
                'type' => 'idCard'
            )
        );

        $this->setExpectedException('\Crazymus\PvalidateException');
        \Crazymus\Pvalidate::validate($params, $rules);
    }
}