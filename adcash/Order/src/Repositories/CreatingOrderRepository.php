<?php
namespace adcash\order\repositories;

use adcash\discount\services\DiscountCalculator;
use adcash\order\data_contracts\CreateOrderDTO;
use adcash\order\exceptions\CreatingOrderException;
use app\models\Order;
use app\models\Product;

class CreatingOrderRepository
{
    private $createOrderDTO;

    private $discountService;

    public function __construct(CreateOrderDTO $DTO)
    {
        $this->createOrderDTO = $DTO;
        $this->discountService = new DiscountCalculator($this->createOrderDTO);
    }

    /**
     * @throws \adcash\order\exceptions\CreatingOrderException
     *
     * @return void
     */
    public function create(){
        $order = new Order();
        $order->user_id = $this->createOrderDTO->userId;
        $order->product_id = $this->createOrderDTO->productId;
        $order->quantity = $this->createOrderDTO->quantity;
        $order->item_price = $this->createOrderDTO->getProduct()->price;
        $order->total_price = $this->discountService->totalPriceAfterDiscount();
        $order->cloned_product_name = $this->createOrderDTO->getProduct()->name;
        $order->cloned_user_fullname = $this->createOrderDTO->getUser()->fullname;
        if (!$order->save()) {
            $this->decreaseAvailableQuantitiesOfProduct($order->product,$order->quantity);
            throw new CreatingOrderException("There is a problem in saving the order",422);
        }
    }

    /**
     * @param Product $product
     * @param $orderQuantity
     */
    private function decreaseAvailableQuantitiesOfProduct($product,$orderQuantity)
    {
        $product->update(false,['available_quantity'=>$product->available_quantity - $orderQuantity]);
    }
}