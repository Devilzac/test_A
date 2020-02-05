<?php

use Checkout\Item\BasicItem;

class BasicItemTest extends \PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $skuName = "AAA";
        $BasicItem=new BasicItem($skuName);
        $result=$BasicItem->getName();
        $this->assertEquals($skuName,$result);
    }
}
