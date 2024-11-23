<?php
class Order{
    private int $id = 0;
    private string $firstName = "";
    private string $lastName = "";
    private string $email = "";
    private string $phone = "";
    private string $street = "";
    private string $number = "";
    private array $pizzas = [];

    // Constructor
    public function __construct(int $id, string $firstName, string $lastName, string $email, string $phone, string $street, string $number){
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
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
        return $this->firstName;
    }
    
    public function getLastName(): string{
        return $this->lastName;
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

    public function setFirstName(string $firstName){
        $this->firstName = $firstName;
    }

    public function setLastName(string $lastName){
        $this->lastName = $lastName;
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