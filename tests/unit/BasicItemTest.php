<?php

use Checkout\Item\BasicItem;

class BasicItemTest extends \PHPUnit_Framework_TestCase
{    
    public function test_If_Price_Attribute_Exists()
    {
        $skuName = "AAA";
        $BasicItem=new BasicItem($skuName); 
        $this->assertObjectHasAttribute('price', $BasicItem, "Expected object to contain attribute 'price'");
    }

    public function testGetName()
    {
        $skuName = "AAA";
        $BasicItem=new BasicItem($skuName);
        $result=$BasicItem->getName();
        $this->assertEquals($skuName,$result, "Expected to receive item name");
    }
    
    public function test_If_Set_Expected_Price_To_Sku()
    {
        $skuName = "AAA";
        $expectedPrice=100;
        $BasicItem=new BasicItem($skuName); 
        $BasicItem->setPrice();
        $price=$BasicItem->getPrice();
        $this->assertEquals($expectedPrice, $price, "Expected to receive expected price $expectedPrice"); 
    }
    
    public function test_If_Discount_Attribute_Exists()
    {
        $skuName = "AAA";
        $BasicItem=new BasicItem($skuName); 
        $this->assertObjectHasAttribute('discount', $BasicItem, "Expected object to contain attribute 'discount'"); 
    }


    public function test_Set_Promotions_Depending_On_SKU_Name()
    {
        $skuName = "AAA";
        $expected_Promotion=["percentage"=>10, "promotion3x2"=>"3x2"];

        $BasicItem=new BasicItem($skuName); 

        $promotion=$BasicItem->getPromotion();

        $this->assertEquals($expected_Promotion, $promotion, "Expected to receive same promotion"); 
    }
}
