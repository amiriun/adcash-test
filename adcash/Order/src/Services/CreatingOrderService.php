<?php
namespace adcash\order\services;

use adcash\order\data_contracts\OrderDTO;
use adcash\order\exceptions\OrderException;
use adcash\order\repositories\CreatingOrderRepository;

class CreatingOrderService
{
    private $createOrderDTO;

    private $creatingRepository;

    public function __construct(OrderDTO $DTO)
    {
        $this->createOrderDTO = $DTO;
        $this->creatingRepository = new CreatingOrderRepository($DTO);
    }

    /**
     * @throws \Exception
     * @throws OrderException
     */
    public function create(){
        if($this->createOrderDTO->getProduct()->available_quantity < $this->createOrderDTO->quantity){
            throw new \Exception("The quantity of order is greater than the available quantities",422);
        }

        $this->creatingRepository->create();
    }
}