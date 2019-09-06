<?php
namespace adcash\order\services;

use adcash\order\data_contracts\OrderDTO;
use adcash\order\exceptions\OrderException;
use adcash\order\repositories\CreatingOrderRepository;
use adcash\order\repositories\UpdatingOrderRepository;
use app\models\Order;

class UpdatingOrderService
{
    private $orderDTO;

    private $creatingRepository;

    public function __construct(OrderDTO $DTO,Order $order)
    {
        $this->orderDTO = $DTO;
        $this->creatingRepository = new UpdatingOrderRepository($DTO,$order);
    }

    /**
     * @throws \Exception
     * @throws OrderException
     */
    public function update(){

        if($this->orderDTO->getProduct()->available_quantity < $this->orderDTO->quantity){
            throw new \Exception("The quantity of order is greater than the available quantities",422);
        }

        $this->creatingRepository->update();
    }
}