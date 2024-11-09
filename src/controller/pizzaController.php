<?php
class pizzaController {
    private $pdo;
    private $pizzaDAO;

    public function __construct(){
        $this->pdo = Connection::getConnection();
        $this->pizzaDAO = new PizzaDAO($this->pdo);
    }

    public function index(){
        include '../src/view/pizza.php';
    }

    public function createPizza(int $orderId){
        try{  
            $name = $_POST['name'] ?? null;
            $price = $_POST['price'] ?? null;

            if(!$name || !$price){
                echo 'Please fill in all fields';
                return;
            }

            if(!is_numeric($price)){
                echo 'Invalid price';
                return;
            }

            $pizza = new Pizza(
                $name,
                $price
            );

            $pizzaId = $this->pizzaDAO->create($pizza);
            return $pizzaId;
        } catch (\Throwable $th) {
            echo 'An error occurred';
        }
    }
}

?>