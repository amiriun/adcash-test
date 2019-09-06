<?php
namespace adcash\order\repositories;

use adcash\discount\services\DiscountCalculator;
use adcash\order\data_contracts\OrderDTO;
use adcash\order\exceptions\OrderException;
use app\models\Order;
use app\models\Product;

class UpdatingOrderRepository
{
    private $orderDTO;

    private $discountService;

    private $orderModel;

    public function __construct(OrderDTO $DTO,Order $order)
    {
        $this->orderDTO = $DTO;
        $this->orderModel = $order;
        $this->discountService = new DiscountCalculator($this->orderDTO);
    }

    /**
     * @throws \adcash\order\exceptions\OrderException
     *
     * @return void
     */
    public function update(){
        $this->changeAvailableQuantitiesOfProduct($this->orderModel->quantity,$this->orderDTO->quantity);
        $order = $this->orderModel;
        $order->user_id = $this->orderDTO->userId;
        $order->product_id = $this->orderDTO->productId;
        $order->quantity = $this->orderDTO->quantity;
        $order->item_price = $this->orderDTO->getProduct()->price;
        $order->total_price = $this->discountService->totalPriceAfterDiscount();
        $order->cloned_product_name = $this->orderDTO->getProduct()->name;
        $order->cloned_user_fullname = $this->orderDTO->getUser()->fullname;
        if (!$order->save()) {
            throw new OrderException("There is a problem in saving the order",422);
        }
    }

    /**
     * @param int $oldQuantity
     * @param int $newQuantity
     */
    private function changeAvailableQuantitiesOfProduct($oldQuantity,$newQuantity)
    {
        $changeAvailableQuantity = $oldQuantity-$newQuantity;
        $product = $this->orderModel->product;
        $product->updateAttributes(['available_quantity'=>$product->available_quantity + $changeAvailableQuantity]);
    }
}