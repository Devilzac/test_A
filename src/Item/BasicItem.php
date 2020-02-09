<?php

namespace Checkout\Item;

use Checkout\Item;
use phpDocumentor\Reflection\Types\Boolean;
use Checkout\Promotion\BasicPromotion;

class BasicItem implements Item
{

    /**
     * @var string
     */
    private $sku;
    private $price;
    private $discount;

    /**
     * BasicItem constructor.
     * @param string $sku
     */
    public function __construct($sku)
    {
        $this->sku = $sku;
        $this->setPrice();
        $this->setPromotion();
    }

    /**
     * @param Item $item
     * @return boolean
     */
    public function equals(Item $item)

    {
        // TODO: Implement equals() method.
        if($item->sku == $this->sku){
            return true;
        }
        return false;
    }

    /**
     * @return string
     */
    public function getName()
    {
        // TODO: Implement getName() method.
        return $this->sku;
    }
    public function setPrice(){    

        $LowerCaseSkuName = strtolower($this->getName());   

        switch ($LowerCaseSkuName) {
            case "aaa":
                $this->price=100;
                break;
            case "bbb":
                $this->price=55;
                break;
            case "ccc":
                $this->price=25;
            break;
            case "ddd":
                $this->price=25;
            break;
        }
    }
    
    public function getPrice(){    
        return $this->price;
    }

    
    public function setPromotion(){    

        $LowerCaseSkuName = strtolower($this->getName());   
        $basicPromotion = BasicPromotion::create();

        switch ($LowerCaseSkuName) {
            case "aaa":
                $basicPromotion->setPromotion(["Unit", "percentage"=>10, "promotion3x2"]);
                break;
            case "bbb":
                $basicPromotion->setPromotion(["Unit","percentage"=>5]);
                break;
            case "ccc":
                $basicPromotion->setPromotion(["Unit"]);
            break;
            case "ddd":
                $basicPromotion->setPromotion(["Unit", "percentage"=>10, "promotion3x2"]);
            break;
        }
        
        $this->discount = $basicPromotion;
    }

    public function getPromotion(){
        return $this->discount->getAvailablePromotions();
    }
}