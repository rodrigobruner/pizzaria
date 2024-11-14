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

    public function select($orderId) {
        try {
            
            $sql = "SELECT * FROM orders WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$orderId]);
            $row = $stmt->fetch();
            if ($row) {
                return new Order(
                    $row['first_name'],
                    $row['last_name'],
                    $row['email'],
                    $row['phone'],
                    $row['street'],
                    $row['number']
                );
            }
            return null;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function update(Order $order) {
        try {
            $sql = "UPDATE orders SET first_name = ?, last_name = ?, email = ?, phone = ?, street = ?, number = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $order->getFirstName(),
                $order->getLastName(),
                $order->getEmail(),
                $order->getPhone(),
                $order->getStreet(),
                $order->getNumber(),
                $order->getId()
            ]);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function delete($orderId) {
        try {
            $sql = "DELETE FROM orders WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$orderId]);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }
}