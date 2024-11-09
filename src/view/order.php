<?php
    require_once 'components/header.php';
?>
<main>
    <h1>Pizza day!</h1>
    <div id="messages"></div>
    <!-- I stop sending the form to validate the data -->
    <form submit="/" method="POST" onsubmit=""> <!--event.preventDefault();validateForm();-->
        <div id="makePizza">
            <div id="pizzas">
                <h3>Enter the number of pizzas you want.</h3>
            </div>
        </div>
        <div class="formGrid">
            <label for="number">Enter the number of pizzas you want</label>
            <!--Every time this value changes, I update the pizza form-->
            <input type="number" name="qtPizzas" id="number" onchange="addPizzaFields()">

            <label for="firstName">First name</label>
            <input type="text" name="firstName" id="firstName">
        
            <label for="lastName">Last name</label>
            <input type="text" name="lastName" id="lastName">
        
            <label for="email">E-mail</label>
            <input type="text" name="email" id="email">
        
            <label for="phone">Phone number</label>
            <input type="text" name="phone" id="phone">
        
            <label for="street">Street</label>
            <input type="text" name="street" id="street">
        
            <label for="stNumber">Number</label>
            <input type="text" name="number" id="stNumber">
            
            <button type="submit">Place order</button>
        </div>
    </form>
</main>
<script>
    addPizzaFields();
</script>
<?php
    require_once 'components/footer.php';
?>