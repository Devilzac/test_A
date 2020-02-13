<?php

namespace Checkout\Promotion;

use Checkout\Promotion;

class BasicPromotion implements Promotion
{
    private $promotions = [];
    /**
     * @return BasicPromotion
     */
    public static function create()
    {
        return new self();
    }

    public function getAvailablePromotions():array{
        return $this->promotions;
    }

    public function setPromotion($promotion){
        $this->promotions=$promotion;
    }
    
}