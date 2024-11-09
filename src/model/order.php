<?php
class Order{
    private int $id = 0;
    private string $first_name = "";
    private string $last_name = "";
    private string $email = "";
    private string $phone = "";
    private string $street = "";
    private string $number = "";
    private array $pizzas = [];

    // Constructor
    public function __construct(string $first_name, string $last_name, string $email, string $phone, string $street, string $number){
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->phone = $phone;
        $this->street = $street;
        $this->number = $number;
    }

    //Getters and Setters
    public function getId(): int{
        return $this->id;
    }

    public function getFirstName(): string{
        return $this->first_name;
    }
    
    public function getLastName(): string{
        return $this->last_name;
    }

    public function getEmail(): string{
        return $this->email;
    }

    public function getPhone(): string{
        return $this->phone;
    }

    public function getStreet(): string{
        return $this->street;
    }

    public function getNumber(): string{
        return $this->number;
    }

    public function getPizzas(): array{
        return $this->pizzas;
    }

    public function setId(int $id){
        $this->id = $id;
    }

    public function setFirstName(string $first_name){
        $this->first_name = $first_name;
    }

    public function setLastName(string $last_name){
        $this->last_name = $last_name;
    }

    public function setEmail(string $email){
        $this->email = $email;
    }

    public function setPhone(string $phone){
        $this->phone = $phone;
    }

    public function setStreet(string $street){
        $this->street = $street;
    }

    public function setNumber(string $number){
        $this->number = $number;
    }

    public function setPizzas(array $pizzas){
        $this->pizzas = $pizzas;
    }

    public function addPizza(Pizza $pizza){
        $this->pizzas[] = $pizza;
    }
}

?>