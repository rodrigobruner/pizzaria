<?php

class OrderDAO {
    // PDO instance
    private $pdo;

    public function __construct($pdo) {
        // Set the connection to the database
        $this->pdo = $pdo;
    }

    public function create(Order $order) {
        try {
            // Create the sql
            $sql = "INSERT INTO orders (first_name, last_name, email, phone, street, number) VALUES (?, ?, ?, ?, ?, ?)";
            // Prepare the sql
            $stmt = $this->pdo->prepare($sql);
            // Bind the values and execute the sql
            $stmt->execute([
                $order->getFirstName(),
                $order->getLastName(),
                $order->getEmail(),
                $order->getPhone(),
                $order->getStreet(),
                $order->getNumber()
            ]);
            // Return the last inserted id
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            throw new Exception("Error create new order", 1);
        }
    }

    public function list(){
        try {
            // Create the sql
            $sql = "SELECT * FROM orders";
            // Prepare the sql
            $stmt = $this->pdo->prepare($sql);
            // Execute the sql
            $stmt->execute();
            $orders = [];
            while ($row = $stmt->fetch()) {
                $orders[] = new Order(
                    $row['id'],
                    $row['first_name'],
                    $row['last_name'],
                    $row['email'],
                    $row['phone'],
                    $row['street'],
                    $row['number'],
                );
            }
            return $orders;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function update(Order $order) {
        try {
            // Create the sql
            $sql = "UPDATE orders SET first_name = ?, last_name = ?, email = ?, phone = ?, street = ?, number = ? WHERE id = ?";
            // Prepare the sql
            $stmt = $this->pdo->prepare($sql);
            // Bind the values and execute the sql
            $stmt->execute([
                $order->getFirstName(),
                $order->getLastName(),
                $order->getEmail(),
                $order->getPhone(),
                $order->getStreet(),
                $order->getNumber(),
                $order->getId(),
            ]);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function delete($orderId) {
        try {
            // Create the sql
            $sql = "DELETE FROM orders WHERE id = ?";
            // Prepare the sql
            $stmt = $this->pdo->prepare($sql);
            // Bind the values and execute the sql
            $stmt->execute([$orderId]);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }


    function getById($orderId) {
        try {
            // Create the sql
            $sql = "SELECT * FROM orders WHERE id = ?";
            // Prepare the sql
            $stmt = $this->pdo->prepare($sql);
            // Bind the values and execute the sql
            $stmt->execute([$orderId]);
            // Fetch the result
            $row = $stmt->fetch();
            return new Order(
                $row['id'],
                $row['first_name'],
                $row['last_name'],
                $row['email'],
                $row['phone'],
                $row['street'],
                $row['number'],
            );
        } catch (Exception $e) {
            return $e;
        }
    }
}
?>