<?php 
require_once 'components/header.php';
require_once 'components/menu.php';

if(isset($_GET['error'])){
    echo '<div class="errorMsg">'.cleanInput($_GET['error']).'</div>';
}
if(isset($_GET['success'])){
    echo '<div class="successMsg">'.cleanInput($_GET['success']).'</div>';
}
$pizzaCount = isset($pizzas) && count($pizzas) > 0 ? count($pizzas) : 1;

$pizzaJson = '[]';
if(isset($pizzas) && is_array($pizzas) && $pizzaCount > 0){
    $pizzaData = array_map(function($pizza) {
        return $pizza->toArray();
    }, $pizzas);
    $pizzaJson = json_encode($pizzaData);
}
?>
<!-- I stop sending the form to validate the data -->
<form submit="/" method="POST" onsubmit=""> <!--event.preventDefault();validateForm();-->
    <input type="hidden" name="id" value="<?php echo cleanInput($order ? $order->getId() : ''); ?>">
    <div id="makePizza">
        <div id="pizzas">
            <h3>Enter the number of pizzas you want.</h3>
        </div>
    </div>
    <div class="formGrid">
        <label for="number">Enter the number of pizzas you want</label>

        <input type="number" name="qtPizzas" id="number" onchange="addPizzaFields()" value="<?php echo $pizzaCount; ?>">

        <label for="firstName">First name</label>
        <input type="text" name="firstName" id="firstName" value="<?php echo cleanInput($order ? $order->getFirstName() : ''); ?>">

        <label for="lastName">Last name</label>
        <input type="text" name="lastName" id="lastName" value="<?php echo cleanInput($order ? $order->getLastName() : ''); ?>">

        <label for="email">E-mail</label>
        <input type="text" name="email" id="email" value="<?php echo cleanInput($order ? $order->getEmail() : ''); ?>">

        <label for="phone">Phone number</label>
        <input type="text" name="phone" id="phone" value="<?php echo cleanInput($order ? $order->getPhone() : ''); ?>">

        <label for="street">Street</label>
        <input type="text" name="street" id="street" value="<?php echo cleanInput($order ? $order->getStreet() : ''); ?>">

        <label for="stNumber">Number</label>
        <input type="text" name="number" id="stNumber" value="<?php echo cleanInput($order ? $order->getNumber() : ''); ?>">

        <button type="submit"><?php echo $order && $order->getId() ? "Update order" : "Place order" ?> </button>
    </div>
</form>
<script>
    addPizzaForm(<?php echo $pizzaCount; ?>);
    <?php if($pizzaCount > 0) { ?>
        populatePizzaForm(<?php echo $pizzaJson; ?>);
    <?php } ?>
</script>
<?php
require_once 'components/footer.php';
?>