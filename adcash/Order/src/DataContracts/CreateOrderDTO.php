<?php
namespace adcash\order\data_contracts;

use app\models\Order;
use app\models\Product;
use app\models\User;

class CreateOrderDTO
{
    public $productId;
    public $userId;
    public $quantity;
    private $product;
    private $user;

    /**
     * @return null|Product
     */
    public function getProduct(){
        if($this->product){
            return $this->product;
        }

        return Product::findOne($this->productId);
    }

    /**
     * @return null|User
     */
    public function getUser(){
        if($this->user){
            return $this->user;
        }

        return User::findOne($this->userId);
    }
}