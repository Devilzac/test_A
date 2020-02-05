<?php

namespace Checkout\Cart;

use Checkout\Cart;
use Checkout\Item;

class BasicCart implements Cart
{
    public $cartItems = [];
    /**
     * @return BasicCart
     */
    public static function create()
    {
        return new self();
    }

    /**
     * @param Item $item
     * @param int $qty
     */
    public function addItem(Item $item, $qty)
    {
        array_push($this->cartItems,["item"=>$item, "quantity"=>$qty]);
        // TODO: Implement addItem() method.        
    }
}