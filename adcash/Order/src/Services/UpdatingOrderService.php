<?php
namespace adcash\order\services;

use adcash\order\data_contracts\OrderDTO;
use adcash\order\exceptions\OrderException;
use adcash\order\repositories\CreatingOrderRepository;

class UpdatingOrderService
{
    private $orderDTO;

    private $creatingRepository;

    public function __construct(OrderDTO $DTO)
    {
        $this->orderDTO = $DTO;
        $this->creatingRepository = new CreatingOrderRepository($DTO);
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