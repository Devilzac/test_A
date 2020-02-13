<?php

use Checkout\Cart\BasicCart;
use Checkout\Item\BasicItem;
use Checkout\Cart\Line;

class BasicCartTest extends \PHPUnit_Framework_TestCase
{
    
    public function test_If_cartItems_attribute_exists()
    {
        $basicCart = BasicCart::create();   
        $this->assertObjectHasAttribute('cartItems', $basicCart, "Expected object to contain attribute 'cartItems'"); 
    }

    public function test_If_Cart_Is_Empty(){

        $cart = BasicCart::create();

        $expected_amount=0;
    
        $itemsInCart=$cart->cartItems;
        $this->assertCount($expected_amount,$itemsInCart, "Expected cart to be empty (receive 0 lines)");
    }

    public function test_If_Item_Was_Added_On_Cart(){

        $cart = BasicCart::create();
        $item = new BasicItem("AAA");
        $quantity = 4;

        $cart->addItem($item, $quantity);    
        $expected_amount=1;

        $itemsInCart=$cart->cartItems;
        $this->assertCount($expected_amount,$itemsInCart, "Expected to receive 1 line");
    }

    public function test_If_Line_In_Cart_Contains_Same_Added_Item(){

        $cart = BasicCart::create();
        $item = new BasicItem("AAA");
        $quantity = 4;

        $cart->addItem($item, $quantity);

        $itemsInCart=$cart->cartItems[0];
     
        $this->assertSame($item,$itemsInCart->item,"Expected to receive same item");
    }

    public function test_If_Added_Item_Contains_Same_Quantity(){

        $cart = BasicCart::create();
        $item = new BasicItem("AAA");
        $quantity = 4;

        $cart->addItem($item, $quantity);
    
        $itemsInCart=$cart->cartItems[0];
       
        $this->assertSame($quantity,$itemsInCart->quantity,"Expected quantity to be the same");
    }

    public function test_If_Items_Are_the_Same(){

        $item = new BasicItem("AAA");
        $item2 = new BasicItem("AAA");
        $result=$item->equals($item2);
       
        $this->assertTrue($result, "Expected to receive 'true' if added items are the same");
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


        $this->assertEquals($expected,$AddedItems->quantity, "Expected to receive the quantity sum of the items that are equal");
    }

    public function test_if_returns_3x2_When_Items_Quantity_Are_Minimum_3(){

        $cart = BasicCart::create();
        $item = new BasicItem("AAA");
        $quantity = 6;
        $expected = "3x2";

        $newLine = new Line();
        $newLine->quantity = $quantity;
        $newLine->item = $item;
        
        $result=$cart->checkPromotion($newLine);
      
        $this->assertEquals($expected,$result,"Expected to receive '3x2' when items with '3x2 promotion' quantity are minimum 3");
    }
    public function test_if_returns_Percentage_When_Items_have_Percentage_Promotion_Added(){

        $cart = BasicCart::create();
        $item = new BasicItem("AAA");
        $quantity = 2;
        $expectedPercentage = 10;

        $newLine = new Line();
        $newLine->quantity = $quantity;
        $newLine->item = $item;
        
        $result=$cart->checkPromotion($newLine);

        $this->assertEquals($expectedPercentage,$result, "Expected discount percentage to be $expectedPercentage");
    }

    public function test_if_calculates_3x2(){

        $cart = BasicCart::create();
        $item = new BasicItem("AAA");
        $quantity = 6;
        $expectedPrice = 400;

        $newLine = new Line();
        $newLine->quantity = $quantity;
        $newLine->item = $item;
        
        $result=$cart->calculate3x2($newLine);

        $this->assertEquals($expectedPrice,$result, "Expected calculate 3x2 new price and the result to be equals $expectedPrice");
    }

    public function test_if_calculates_Percentage(){

        $cart = BasicCart::create();
        $item = new BasicItem("AAA");
        $quantity = 2;
        $expectedPrice = 180;

        $newLine = new Line();
        $newLine->quantity = $quantity;
        $newLine->item = $item; 
        $result=$cart->percentageDiscount($newLine);

        $this->assertEquals($expectedPrice,$result, "Expected to calculate % discout an result to be equals $expectedPrice");
    }

    public function test_if_No_Promotion_Applied_Then_Calculates_Unit_Price_Item(){

        $cart = BasicCart::create();
        $item = new BasicItem("CCC");
        $quantity = 10;
        $expectedPrice = 250;

        $newLine = new Line();
        $newLine->quantity = $quantity;
        $newLine->item = $item; 
        $result=$cart->calculateUnitPrice($newLine);

        $this->assertEquals($expectedPrice,$result, "Expected to receive the sum of price items when no promotion applied");
    }

}
