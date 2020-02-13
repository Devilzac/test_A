<?php

namespace Checkout\Checkout;

use Checkout\Cart;
use Checkout\Checkout;

class BasicCheckout implements Checkout
{
    private $finalPrice;
    /**
     * @return BasicCheckout
     */
    public static function createBasicCheckout()
    {
        return new self();
    }

    /**
     * @param Cart $cart
     * @return float
     */
    public function calculate(Cart $cart)
    {
        $price = 0;
        foreach ($cart->cartItems as $line) {
            $cart->checkPromotion($line);
            $price += $line->linePrice;
        }
        $this->setFinalPrice($price);
        return $this->getFinalPrice();
    }

   /**
     * @param int $price
     */
    public function setFinalPrice($price)
    {
        $this->finalPrice=$price;
    }

    public function getFinalPrice()
    {
        return $this->finalPrice;
    }
}