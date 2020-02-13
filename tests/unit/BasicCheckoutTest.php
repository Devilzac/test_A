<?php

use Checkout\Checkout\BasicCheckout;

class BasicCheckoutTest extends \PHPUnit_Framework_TestCase
{   
    public function test_If_finalPrice_attribute_exists()
    {
        $basicPromotion = BasicCheckout::createBasicCheckout();   
        $this->assertObjectHasAttribute('finalPrice', $basicPromotion); 
    }

    public function test_Set_finalPrice()
    {
        $expectedfinalPrice= 10;
        $basicPromotion = BasicCheckout::createBasicCheckout();   
        $basicPromotion->setFinalPrice($expectedfinalPrice);
        $result=$basicPromotion->getFinalPrice();
        $this->assertEquals($expectedfinalPrice, $result); 
    }
    
}
