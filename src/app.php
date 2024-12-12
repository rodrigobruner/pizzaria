<?php
include 'lib/router.php';
include 'lib/connection.php';
include 'lib/sysMessage.php';
include 'lib/filter_inputs.php';
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

// List orders
$app->get('/delete', function() use ($orderController) {
    if($orderController->delete()->getType() == SysMessage::ERROR){
        //Return to index page with error message
        header("Location: ./list?error=".urlencode($orderResult->getMessage()));
    } else {
        //Return to index page with success message
        header("Location: ./list?success=".urlencode("Order deleted successfully"));
    }
});

// Create order
$app->post( '/', function() use ($orderController) {
    $orderResult = $orderController->saveOrder(); 
    if($orderResult->getType() == SysMessage::ERROR){
        //Return to index page with error message
        header("Location: ./?error=".urlencode($orderResult->getMessage()));
    } else {
        //Return to index page with success message
        header("Location: ./?success=".urlencode("Order saved successfully"));
    } 
});

// Call the callback of the route
$app->start();

?>