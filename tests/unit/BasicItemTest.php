<?php

use Checkout\Item\BasicItem;

class BasicItemTest extends \PHPUnit_Framework_TestCase
{    
    public function test_If_Price_Attribute_Exists()
    {
        $skuName = "AAA";
        $BasicItem=new BasicItem($skuName); 
        $this->assertObjectHasAttribute('price', $BasicItem); 
    }

    public function testGetName()
    {
        $skuName = "AAA";
        $BasicItem=new BasicItem($skuName);
        $result=$BasicItem->getName();
        $this->assertEquals($skuName,$result);
    }
    
    public function test_If_Set_expected_Price_To_Sku()
    {
        $skuName = "AAA";
        $expectedPrice=100;
        $BasicItem=new BasicItem($skuName); 
        $BasicItem->setPrice();
        $price=$BasicItem->getPrice();
        $this->assertEquals($expectedPrice, $price); 
    }
    
    public function test_If_Discount_Attribute_Exists()
    {
        $skuName = "AAA";
        $BasicItem=new BasicItem($skuName); 
        $this->assertObjectHasAttribute('discount', $BasicItem); 
    }


    public function test_Set_Promotions_Depending_On_SKU_Name()
    {
        $skuName = "AAA";
        $expected_Promotion=["Unit", "percentage"=>10, "promotion3x2"];

        $BasicItem=new BasicItem($skuName); 

        $promotion=$BasicItem->getPromotion();

        $this->assertEquals($expected_Promotion, $promotion); 
    }
}
