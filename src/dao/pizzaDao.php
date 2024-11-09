<?php

class PizzaDAO {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = Connection::getConnection();
    }

    public function create(Pizza $pizza) {
        try{
            $sql = "INSERT INTO pizzas (order_id, size, dough_type, sauce_type, cheeses_type, toppings_type) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                NULL,
                $pizza->getSize(),
                $pizza->getDoughType(),
                $pizza->getSauceType(),
                json_encode($pizza->getCheesesType()),
                json_encode($pizza->getToppingsType())
            ]);
            return $this->pdo->insert_id;
        }catch(Exception $e){
            return $e;
        }
    }

    public function read($orderId) {
        try{
            $sql = "SELECT * FROM pizzas WHERE order_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$orderId]);
            $row = $stmt->fetch();
            if ($row) {
                return new Pizza(
                    $row['order_id'],
                    new Size($row['size']),
                    $row['dough_type'],
                    $row['sauce_type'],
                    json_decode($row['cheeses_type'], true),
                    json_decode($row['toppings_type'], true)
                );
            }
            return null;
        }catch(Exception $e){
            return $e;
        }
    }

    public function update(Pizza $pizza) {
        try{
            $sql = "UPDATE pizzas SET size = ?, dough_type = ?, sauce_type = ?, cheeses_type = ?, toppings_type = ? WHERE order_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $pizza->getSize(),
                $pizza->getDoughType(),
                $pizza->getSauceType(),
                json_encode($pizza->getCheesesType()),
                json_encode($pizza->getToppingsType()),
                $pizza->getOrderId()
            ]);
            return true;
        }catch(Exception $e){
            return $e;
        }
    }

    public function delete($orderId) {
        try{
            $sql = "DELETE FROM pizzas WHERE order_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$orderId]);
            return true;
        }catch(Exception $e){
            return $e;
        }
    }

}

?>