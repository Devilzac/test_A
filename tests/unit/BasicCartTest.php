<?php

use Checkout\Cart\BasicCart;
use Checkout\Item\BasicItem;
use Checkout\Cart\Line;

class BasicCartTest extends \PHPUnit_Framework_TestCase
{
    
    public function test_If_cartItems_attribute_exists()
    {
        $basicCart = BasicCart::create();   
        $this->assertObjectHasAttribute('cartItems', $basicCart); 
    }

    public function test_If_Cart_Is_Empty(){

        $cart = BasicCart::create();

        $expected_amount=0;
    
        $itemsInCart=$cart->cartItems;
        $this->assertCount($expected_amount,$itemsInCart);
    }

    public function test_If_Item_Was_Added_On_Cart(){

        $cart = BasicCart::create();
        $item = new BasicItem("AAA");
        $quantity = 4;

        $cart->addItem($item, $quantity);    
        $expected_amount=1;

        $itemsInCart=$cart->cartItems;
        $this->assertCount($expected_amount,$itemsInCart);
    }

    public function test_If_Added_Item_Contains_Item(){

        $cart = BasicCart::create();
        $item = new BasicItem("AAA");
        $quantity = 4;

        $cart->addItem($item, $quantity);

        $itemsInCart=$cart->cartItems[0];
     
        $this->assertSame($item,$itemsInCart->item);
    }

    public function test_If_Added_Item_Contains_Quantity(){

        $cart = BasicCart::create();
        $item = new BasicItem("AAA");
        $quantity = 4;

        $cart->addItem($item, $quantity);
    
        $itemsInCart=$cart->cartItems[0];
       
        $this->assertSame($quantity,$itemsInCart->quantity);
    }

    public function test_If_Items_Are_the_Same(){

        $item = new BasicItem("AAA");
        $item2 = new BasicItem("AAA");
        $result=$item->equals($item2);
       
        $this->assertTrue($result);
    }
    
    public function test_if_Same_Items_Add_Up(){

        $cart = BasicCart::create();
        $item = new BasicItem("AAA");
        $item2 = new BasicItem("AAA");
        $quantity = 4;
        $expected = 8;

        $cart->addItem($item, $quantity);
        $cart->addItem($item2, $quantity);

        $AddedItems = $cart->cartItems[0];


        $this->assertEquals($expected,$AddedItems->quantity);
    }

    public function test_if_returns_3x2_Promotion_When_items_Quantity_minimum_3(){

        $cart = BasicCart::create();
        $item = new BasicItem("AAA");
        $quantity = 6;
        $expected = "3x2";

        $cart->addItem($item, $quantity);
        $AddedItems = $cart->cartItems[0];  
        $return=$cart->checkPromotion($AddedItems);
      
        $this->assertEquals($expected,$return);
    }
    public function test_if_returns_Percentage_When_Items_have_Percentage_Promotion_Added(){

        $cart = BasicCart::create();
        $item = new BasicItem("AAA");
        $expectedPercentage = 10;

        $newLine = new Line();
        $newLine->quantity = 2;
        $newLine->item = $item;
        
        $return=$cart->checkPromotion($newLine);

        $this->assertEquals($expectedPercentage,$return);
    }

    public function test_if_calculates_3x2(){

        $cart = BasicCart::create();
        $item = new BasicItem("AAA");
        $quantity = 6;
        $expectedPrice = 400;

        $cart->addItem($item, $quantity);
        $AddedItems = $cart->cartItems[0];  
        $return=$cart->calculate3x2($AddedItems);

        $this->assertEquals($expectedPrice,$return);
    }

    public function test_if_calculates_Percentage(){

        $cart = BasicCart::create();
        $item = new BasicItem("AAA");
        $quantity = 2;
        $expectedPrice = 180;

        $cart->addItem($item, $quantity);
        $AddedItems = $cart->cartItems[0];  
        $return=$cart->percentageDiscount($AddedItems);

        $this->assertEquals($expectedPrice,$return);
    }

    public function test_if_No_Promotion_Applied_Then_Calculates_Unit_Price_Item(){

        $cart = BasicCart::create();
        $item = new BasicItem("CCC");
        $quantity = 10;
        $expectedPrice = 250;

        $cart->addItem($item, $quantity);
        $AddedItems = $cart->cartItems[0];  
        $return=$cart->calculateUnitPrice($AddedItems);

        $this->assertEquals($expectedPrice,$return);
    }

}
