<?php
class OrderController{

    private $pdo; // Database connection
    private $orderDAO; // Order DAO
    private $pizzaDAO; // Pizza DAO

    // Initialize db and DAOs
    public function __construct(){
        $this->pdo = Connection::getConnection();
        $this->orderDAO = new OrderDAO($this->pdo);
        $this->pizzaDAO = new PizzaDAO($this->pdo);
    }

    //Home page, with form to create an order
    public function index(){
        include '../src/view/order.php';
    }

    public function createOrder(){
        // Get the data from the form
        $firstName = $_POST['firstName'] ?? null;
        $lastName = $_POST['lastName'] ?? null;
        $email = $_POST['email'] ?? null;
        $phone = $_POST['phone'] ?? null;
        $street = $_POST['street'] ?? null;
        $number = $_POST['number'] ?? null;

        // Validate the data
        if(!$firstName || !$lastName || !$email || !$phone || !$street || !$number){
            return new SysMessage(SysMessage::ERROR, 'Please fill in all fields');
        }
        // Validate email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return new SysMessage(SysMessage::ERROR, 'Invalid email');
        }
        // Validate phone
        if(!is_numeric($phone)){
            return new SysMessage(SysMessage::ERROR, 'Invalid phone number');
        }
        // Validate number
        if(!is_numeric($number)){
            return new SysMessage(SysMessage::ERROR, 'Invalid number');
        }
        // Create new order
        $order = new Order(
            0,
            $firstName,
            $lastName,
            $email,
            $phone,
            $street,
            $number
        );

        try {
            //Create the order and get the order id
            $orderId = $this->orderDAO->create($order);

            // If the order not created, return an error message
            if(!$orderId){
                return new SysMessage(SysMessage::ERROR, 'An error occurred while creating the order');
            }

            // Add pizzas to the order
            $addPizzasResult = $this->addPizzas($orderId);
            
            // If the pizzas not created
            if ($addPizzasResult->getType() === SysMessage::ERROR) {
                //delete the order
                $this->orderDAO->delete($orderId);
                //return an error message
                return new SysMessage(SysMessage::ERROR, 'An error occurred while creating the order', $addPizzasResult->getMessage());
            }
            // Set the order id
            $order->setId($orderId);
            // Set the pizzas
            $order->setPizzas($addPizzasResult->getExtraData());
            // Return a success message
            return new SysMessage(SysMessage::SUCCESS, 'Order '.$orderId.' created successfully', $order);
        
        //If some exception occurs
        } catch (Exception $e) {
            // Return an error message
            return new SysMessage(SysMessage::ERROR, 'An error occurred while creating the order', $e);
        }
    }


    // Add pizzas to the order
    public function addPizzas(int $orderId){
        
        // Get the number of pizzas
        $numberOfPizzas = $_POST['qtPizzas'] ?? 0;

        // If the number of pizzas = 0 return an error message
        if ($numberOfPizzas < 1) {
            return new SysMessage(SysMessage::ERROR, 'Please specify the number of pizzas');
        }

        // for each pizza
        for ($i = 1; $i <= $numberOfPizzas; $i++) {
            // Get the data from the form
            $size = $_POST["size{$i}"] ?? null;
            $dough = $_POST["dough{$i}"] ?? null;
            $sauce = $_POST["sauce{$i}"] ?? null;
            $cheese = $_POST["cheese{$i}"] ?? [];
            $toppings = $_POST["toppings{$i}"] ?? [];

            // Validate if some data is not set
            if (!$size || !$dough || !$sauce || !$cheese || !$toppings) {
                return new SysMessage(SysMessage::ERROR, 'Please fill in all required fields for pizza ' . $i);
                return;
            }


            // Create a new pizza and save it in an array
            $pizzas[] = new Pizza(
                $orderId,
                $size,
                $dough,
                $sauce,
                $cheese,
                $toppings
            );
        }
        //If some error occurs return an error and stop the process

        try { 
            // For each pizza in the array
            foreach ($pizzas as $pizza) {
                // Save the pizza in the database
                $pizzasId[] = $this->pizzaDAO->create($pizza);
            }
            // Return a success message
            return new SysMessage(SysMessage::SUCCESS, 'Pizzas created successfully', $pizzas);
        } catch (Exception $e) {
            $this->deletePizzasByOrderID($orderId);
            return new SysMessage(SysMessage::ERROR, 'An error occurred while creating the pizzas', $e);
        }
    }


    public function listOrders(){
        // Get all orders
        $orders = $this->orderDAO->list();
        // For each order, get the pizzas
        foreach ($orders as $key => $order) {
            // Set the pizzas in the order
            $orders[$key]->setPizzas($this->pizzaDAO->selectByOrderID($order->getId()));
        }
        include '../src/view/list.php';
    }
}

?>