<?php

enum Size {
    case Small;
    case Medium;
    case Large;
    case ExtraLarge;
}

class Pizza{

    private int $orderId = 0;
    private Size $size  = Size::Medium;
    private string $doughType = "";
    private string $sauceType = "";
    private $cheesesType = [];
    private $toppingsType = [];

    // Constructor
    public function __construct(
        int $orderId, 
        Size $size, 
        string $doughType, 
        string $sauceType, 
        array $cheesesType, 
        array $toppingsType
    ) {
        $this->orderId = $orderId;
        $this->size = $size;
        $this->doughType = $doughType;
        $this->sauceType = $sauceType;
        $this->cheesesType = $cheesesType;
        $this->toppingsType = $toppingsType;
    }

    //Getters and Setters
    public function getOrderId(): int{
        return $this->orderId;
    }
    
    public function getSize(): Size{
        return $this->size;
    }

    public function getDoughType(): string{
        return $this->doughType;
    }

    public function getSauceType(): string{
        return $this->sauceType;
    }

    public function getCheesesType(): array{
        return $this->cheesesType;
    }

    public function getToppingsType(): array{
        return $this->toppingsType;
    }

    public function setOrderId(int $orderId){
        $this->orderId = $orderId;
    }

    public function setSize(Size $size){
        $this->size = $size;
    }

    public function setDoughType(string $doughType){
        $this->doughType = $doughType;
    }

    public function setSauceType(string $sauceType){
        $this->sauceType = $sauceType;
    }

    public function setCheesesType(array $cheesesType){
        $this->cheesesType = $cheesesType;
    }

    public function setToppingsType(array $toppingsType){
        $this->toppingsType = $toppingsType;
    }
}