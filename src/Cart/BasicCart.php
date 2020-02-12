<?php

namespace Checkout\Cart;

use Checkout\Cart;
use Checkout\Item;

use Checkout\Cart\Line;
use Checkout\Promotion\BasicPromotion;

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

        $this->checkPromotion($newLine);
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

        /**
     * @param Line $line
     */
    public function checkPromotion(Line $line){
        $actualPromo= $line->item->getPromotion();

        if($line->quantity >= 3 and array_key_exists("promotion3x2", $actualPromo)){ 
            $this->calculate3x2($line);           
            $line->primaryPromotionApplied=true;
            return $actualPromo["promotion3x2"];   
           }

        if($line->quantity == 2 and array_key_exists("percentage", $actualPromo)){
            $this->percentageDiscount($line);
            $line->primaryPromotionApplied=true;
            return $actualPromo["percentage"];   
           }
        

        if(!$line->primaryPromotionApplied){ 
            $this->calculateUnitPrice($line);
           }
    }

    public function calculate3x2(Line $line){
        $ammount_of_promos=0;
        $Items_out_of_promotion=0;
        $itemPrice = $line->item->getPrice();

        if($line->quantity % 3 != 0){          
            $Items_out_of_promotion=$line->quantity % 3;
        }

        $price_of_Items_out_of_promotion = $itemPrice * $Items_out_of_promotion;

        $ammount_of_promos = ($line->quantity - $Items_out_of_promotion) / 3;

        $price_of_free_items = $itemPrice * $ammount_of_promos;
        
        $price_of_Items_with_promotion = ($itemPrice * ($line->quantity - $Items_out_of_promotion)) - $price_of_free_items;

        $total_Price = $price_of_Items_with_promotion + $price_of_Items_out_of_promotion;

        $line->linePrice = $total_Price;

        return $line->linePrice;

    }
    public function percentageDiscount(Line $line){
    
        $itemPrice = $line->item->getPrice();
        $quantity = $line->quantity;

        $promotion = $line->item->getPromotion();
        $discount = ($itemPrice * $quantity) * $promotion["percentage"] / 100;
        $line->linePrice = ($itemPrice * $quantity) - $discount;
      
        return $line->linePrice;

    }

    public function calculateUnitPrice($line){
        $line->linePrice = $line->quantity * $line->item->getPrice();
        return $line->linePrice;
    }
    
}