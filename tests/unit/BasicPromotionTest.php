<?php

use Checkout\Cart\BasicCart;
use Checkout\Item\BasicItem;
use Checkout\Cart\Line;
use Checkout\Promotion\BasicPromotion;

class BasicPromotionTest extends \PHPUnit_Framework_TestCase
{   
    public function test_If_Promotions_attribute_exists()
    {
        $basicPromotion = BasicPromotion::create();   
        $this->assertObjectHasAttribute('promotions', $basicPromotion); 
    }
    
    public function test_Set_Promotions()
    {
        $expected = ["promotion3x2", "percentage"];

        $basicPromotion = BasicPromotion::create(); 

        $basicPromotion->setPromotion($expected);

        $result=$basicPromotion->getAvailablePromotions();

        $this->assertEquals($expected,$result,"Expected promotion to be the same");
    }

    public function test_Get_Same_Amount_Of_Promotions_Added()
    {
        $expectedPromotionAmount = 3;
        $promotion = ["promotion3x2", "percentage", "combo"];

        $basicPromotion = BasicPromotion::create();
        $basicPromotion->setPromotion($promotion);

        $result=count($basicPromotion->getAvailablePromotions());
        $this->assertEquals($expectedPromotionAmount,$result);
    }

    
    
}
