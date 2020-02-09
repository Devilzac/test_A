<?php

namespace Checkout;

interface Promotion
{
      /**
     * @return array
     */
    public function getAvailablePromotions(): array;

      /**
     * @param array $promotion
     */
    public function setPromotion($promotion);
}