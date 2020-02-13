<?php

use Checkout\Cart\Line;

class LineTest extends \PHPUnit_Framework_TestCase
{    
    public function test_If_linePrice_Attribute_Exists()
    {
        $line=new line(); 
        $this->assertObjectHasAttribute('linePrice', $line, "Expected object to contain attribute 'linePrice'"); 
    }

    public function test_If_primaryPromotionApplied_Attribute_Exists()
    {
        $line=new line(); 
        $this->assertObjectHasAttribute('primaryPromotionApplied', $line, "Expected object to contain attribute 'primaryPromotionApplied'"); 
    }
    
    public function test_If_pimaryPromotionUsed_Attribute_Default_Value_False()
    {
        $line=new line(); 
        $this->assertFalse($line->primaryPromotionApplied, "Expected primaryPromotionApplied attribute to be false as default value");
    }
    
}
