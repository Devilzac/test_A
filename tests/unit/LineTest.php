<?php

use Checkout\Item\BasicItem;
use Checkout\Cart\Line;

class LineTest extends \PHPUnit_Framework_TestCase
{    
    public function test_If_linePrice_Attribute_Exists()
    {
        $line=new line(); 
        $this->assertObjectHasAttribute('linePrice', $line); 
    }
}
