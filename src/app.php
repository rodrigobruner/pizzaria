<?php

include 'lib/router.php';
include 'lib/connection.php';
include 'model/order.php';
include 'dao/orderDao.php';
include 'model/pizza.php';
include 'dao/pizzaDao.php';
include 'controller/orderController.php';

$app = new Router();

$orderController = new OrderController();
$pizzaController = new PizzaController();

/**
 * Routes
 * 
 */

 // Index, order page
$app->get(  '/', function() use ($orderController) {
    $orderController->index();
});

// Create order
$app->post( '/', function() use ($orderController, $pizzaController) {
    $orderId = $orderController->createOrder();
    if($orderId){
        $pizzaController->createPizza($orderId);
    }
    
});



// Call the callback of the route
$app->start();

?>