<?php

class OrderController{

    private $pdo;
    private $orderDAO;

    public function __construct(){
        $this->pdo = Connection::getConnection();
        $this->orderDAO = new OrderDAO($this->pdo);
    }


    public function index(){
        include '../src/view/order.php';
    }


    public function createOrder(){

        try {
            $firstName = $_POST['firstName'] ?? null;
            $lastName = $_POST['lastName'] ?? null;
            $email = $_POST['email'] ?? null;
            $phone = $_POST['phone'] ?? null;
            $street = $_POST['street'] ?? null;
            $number = $_POST['number'] ?? null;

            if(!$firstName || !$lastName || !$email || !$phone || !$street || !$number){
                echo 'Please fill in all fields';
                return;
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                echo 'Invalid email';
                return;
            }

            if(!is_numeric($phone)){
                echo 'Invalid phone number';
                return;
            }

            if(!is_numeric($number)){
                echo 'Invalid number';
                return;
            }

            $order = new Order(
                $firstName,
                $lastName,
                $email,
                $phone,
                $street,
                $number
            );

            $orderId = $this->orderDAO->create($order);
            return $orderId;
            
        catch (Exception $e) {
            echo 'An error occurred';
        }
    }




}