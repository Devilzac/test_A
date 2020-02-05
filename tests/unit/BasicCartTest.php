<?php

use Checkout\Cart\BasicCart;
use Checkout\Item\BasicItem;

class BasicCartTest extends \PHPUnit_Framework_TestCase
{
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
    
        $itemsInCart=reset($cart->cartItems);
       
        $this->assertContains($item,$itemsInCart);
    }

    public function test_If_Added_Item_Contains_Quantity(){

        $cart = BasicCart::create();
        $item = new BasicItem("AAA");
        $quantity = "quantity";

        $cart->addItem($item, $quantity);
    
        $itemsInCart=reset($cart->cartItems);
       
        $this->assertContains($quantity,$itemsInCart);
    }
    
}
