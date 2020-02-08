<?php

namespace Checkout\Cart;

use Checkout\Cart;
use Checkout\Item;

use Checkout\Cart\Line;

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
        $newLine = new Line();
        $newLine->quantity = $qty;
        $newLine->item = $item;
        $result = $this->addUpSameItems($newLine);
        if(!$result){
            array_push($this->cartItems, $newLine);

        }
        // TODO: Implement addItem() method.
    }
    /**
     * @param Line $line
     */
    public function addUpSameItems(Line $line)
    {
        if(!empty($this->cartItems)){
             foreach($this->cartItems as $item){
                if($line->item->equals($item->item)){
                    $item->quantity += $line->quantity;
                    return true;
                }
            }
            return false;
        }
        return false;    
    }
    
}