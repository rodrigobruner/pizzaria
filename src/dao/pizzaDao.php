<?php

class PizzaDAO {

    // DB Connection
    private $pdo;

    public function __construct($pdo) {
        // Get the connection
        $this->pdo = Connection::getConnection();
    }

    public function create(Pizza $pizza) {
        try{
            // create sql
            $sql = "INSERT INTO pizzas (orders_id, size, dough_type, sauce_type, cheeses_type, toppings_type) VALUES (?, ?, ?, ?, ?, ?)";
            // prepare sql
            $stmt = $this->pdo->prepare($sql);
            // bind values and execute the sql
            $stmt->execute([
                $pizza->getOrderId(),
                $pizza->getSize(),
                $pizza->getDoughType(),
                $pizza->getSauceType(),
                $pizza->getCheesesTypeAsString(),
                $pizza->getToppingsTypeAsString()
            ]);
            // return the last inserted id
            return $this->pdo->lastInsertId();
        }catch(Exception $e){
            return $e;
        }
    }


    public function deletePizzasByOrderID($orderId) {
        try{
            // create sql
            $sql = "DELETE FROM pizzas WHERE orders_id = ?";
            // prepare sql
            $stmt = $this->pdo->prepare($sql);
            // bind values and execute the sql
            $stmt->execute([$orderId]);
            // return true if success
            return true;
        }catch(Exception $e){
            return $e;
        }
    }


    public function selectByOrderID($orderId) {
        try {
            // create sql
            $sql = "SELECT * FROM pizzas WHERE orders_id = ?";
            // prepare sql
            $stmt = $this->pdo->prepare($sql);
            // bind values and execute the sql
            $stmt->execute([$orderId]);
            // fetch all results
            $rows = $stmt->fetchAll();
            $pizzas = [];
            
            // foreach pizza, create a new pizza object in array
            foreach ($rows as $row) {
                $pizzas[] = new Pizza(
                    $row['order_id'],
                    new Size($row['size']),
                    $row['dough_type'],
                    $row['sauce_type'],
                    $row['cheeses_type'],
                    $row['toppings_type']
                );
            }
            // return the array of pizzas
            return $pizzas;
        } catch (Exception $e) {
            return $e;
        }
    }
}

?>