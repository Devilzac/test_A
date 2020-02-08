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


}
