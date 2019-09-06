<?php
namespace adcash\discount\services;

use adcash\order\data_contracts\CreateOrderDTO;

class DiscountCalculator
{
    private $orderDTO;

    public function __construct(CreateOrderDTO $DTO)
    {
        $this->orderDTO = $DTO;
    }

    public function totalPriceAfterDiscount(){

        $getConfig = \Yii::$app->params['discount_on_quantity'];
        $totalPrice = $this->orderDTO->getProduct()->price * $this->orderDTO->quantity;
        $discountedPrice = 0;
        if ($getConfig['minimum_quantity'] <= $this->orderDTO->quantity) {
            $discountedPrice = $this->calculateDiscountPrice($totalPrice,$getConfig['percent_discount']);
        }

        return $totalPrice - $discountedPrice;
    }

    /**
     * @param $price
     * @param $percentDiscount
     * @return float|int
     */
    private function calculateDiscountPrice($price, $percentDiscount)
    {
        return $price * $percentDiscount / 100;
    }
}