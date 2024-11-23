<?php
include 'lib/router.php';
include 'lib/connection.php';
include 'lib/sysMessage.php';
include 'model/order.php';
include 'dao/orderDao.php';
include 'model/pizza.php';
include 'dao/pizzaDao.php';
include 'controller/orderController.php';

$app = new Router();

$orderController = new OrderController();

/**
 * Routes
 * 
 */

 // Index, order page
$app->get(  '/', function() use ($orderController) {
    $orderController->index();
});

// List orders
$app->get('/list', function() use ($orderController) {
    $orderController->listOrders();
});

// Create order
$app->post( '/', function() use ($orderController) {
    $orderResult = $orderController->createOrder(); 
    if($orderResult->getType() == SysMessage::ERROR){
        //Return to index page with error message
        header("Location: http://localhost/?error=".urlencode($orderResult->getMessage()));
    } else {
        //Return to index page with success message
        header("Location: http://localhost/?success=".urlencode("Order created successfully"));
    } 
});

// Call the callback of the route
$app->start();

?>