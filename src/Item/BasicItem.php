<?php

namespace Checkout\Item;

use Checkout\Item;
use phpDocumentor\Reflection\Types\Boolean;

class BasicItem implements Item
{

    /**
     * @var string
     */
    private $sku;

    /**
     * BasicItem constructor.
     * @param string $sku
     */
    public function __construct($sku)
    {
        $this->sku = $sku;
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
}