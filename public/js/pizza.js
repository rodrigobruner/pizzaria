
// Function to add the fields for the pizzas
function addPizzaForm(qt) {
    for(let i = 1; i <= qt; i++) {
        addPizzaFields();
    }
}

// Function to populate the form with the data from the database
function populatePizzaForm(data) {
    // console.log(data);
    data.forEach((pizza, i) => { // For each pizza in the data, populate the form
        document.querySelector(`select[name="size${i + 1}"]`).value = pizza.size;
        document.querySelector(`input[name="dough${i + 1}"][value="${pizza.doughType}"]`).checked = true;
        document.querySelector(`input[name="sauce${i + 1}"][value="${pizza.sauceType}"]`).checked = true;

        pizza.cheesesType.forEach(cheese => {
            document.querySelector(`input[name="cheese${i + 1}[]"][value="${cheese.trim()}"]`).checked = true;
        });

        pizza.toppingsType.forEach(topping => {
            document.querySelector(`input[name="toppings${i + 1}[]"][value="${topping.trim()}"]`).checked = true;
        });
    });
}

function addPizzaFields() {
    /* Define the options for each field */
    const sizes = ['Small', 'Medium', 'Large', 'X-Large'];

    const doughTypes = [
        'whole grain crust', 
        'whole grain thin crust', 
        'whole grain thick crust',
        'regular',
        'regular thin crust', 
        'regular thick crust'];

    const sauceTypes = [
        'home-style Italian tomato', 
        'buffalo blue cheese', 
        'creamy garlic', 
        'chipotle', 
        'pesto', 
        'spicy', 
        'sweet chilli Thai', 
        'tandoori', 
        'Texas', 
        'no sauce'];
    
    const cheeseTypes = [
        'mozzarella', 
        'dairy-free', 
        'four cheese blend'];

    const toppingsTypes = [
        'anchovies', 
        'artichokes', 
        'bacon strips', 
        'broccoli', 
        'bruschetta', 
        'buffalo chicken',
        'caramelized onions', 
        'cilantro', 
        'chipotle chicken', 
        'chipotle steak', 
        'chorizo sausage',
        'fire-roasted red peppers', 
        'green olives', 
        'green peppers', 
        'grilled chicken', 
        'grilled zucchini',
        'ground beef', 
        'hot banana peppers', 
        'Italian ham', 
        'jalapeno peppers', 
        'kalamata olives',
        'mushrooms', 
        'New York style pepperoni', 
        'pepperoni', 
        'pineapple',
        'plant-based chorizo crumble', 
        'plant-based pepperoni', 
        'red onions', 
        'roasted garlic',
        'Roma tomatoes', 
        'salami', 
        'spicy Italian sausage', 
        'steak strips', 
        'spinach',
        'sun-dried tomatoes'
    ];

    // Preparing the div to receive the fields
    const pizzasDiv = document.getElementById('pizzas');
    pizzasDiv.innerHTML = '';

    // Taking the number of pizzas and converting to integer
    var numberOfPizzas = (document.getElementById('number').value*1);

    if(numberOfPizzas < 1) {
        numberOfPizzas = 1;
        document.getElementById('number').value = 1;
    }

    // check if the number of pizzas is greater than 10
    if(numberOfPizzas > 10) {
        alert('For orders of more than 10 pizzas, please call (222) 222-2222.');
        numberOfPizzas = 10;
        document.getElementById('number').value = 10;
    }

    // If the number of pizzas is less than 1, a message is displayed
    if (numberOfPizzas < 1) {
        pizzasDiv.innerHTML = '<h3>Enter the number of pizzas you want.<h3>';
    }

    // For each pizza, the fields are created
    for (let i = 1; i < numberOfPizzas+1; i++) {

        console.log('Creating pizza fields for pizza number', i);

        // For each pizza, a div is created that will receive the fields
        const pizzaContainer = document.createElement('div');
        pizzaContainer.className = 'pizzaContainer';

        // Creating a element h3 to show the title of the pizza

        const title = document.createElement('h3');
        // adding the title to the pizza
        title.textContent = `Pizza ${i}`;

        // adding the title to the pizza container
        pizzaContainer.appendChild(title);

        // Creating the label for size and a select field
        const sizeLabel = document.createElement('label');
        sizeLabel.textContent = '* Size for Pizza';
        pizzaContainer.appendChild(sizeLabel);

        // Creating the selecte field
        const sizeSelect = document.createElement('select');
        sizeSelect.name = `size${i}`;

        // for each size, in array sizes, a option is created
        sizes.forEach(size => {
            // create the element
            const option = document.createElement('option');
            // set attributes
            option.value = size;
            option.textContent = size;
            if (size === 'large') { //set default value
                option.selected = true;
            }
            // adding the option to the select field
            sizeSelect.appendChild(option);
        });
        pizzaContainer.appendChild(sizeSelect);

        //Creating the label for dough and the options
        const doughLabel = document.createElement('label');
        doughLabel.textContent = '* Dough type for Pizza';
        pizzaContainer.appendChild(doughLabel);

        // to apply css I created a div to receive the radio buttons
        const doughContainer = document.createElement('div');
        doughContainer.className = 'doughContainer';
        // foreach dough type, in array doughTypes, add a option
        doughTypes.forEach(dough => {
            // create a label
            const doughOptionLabel = document.createElement('label');
            //set the text
            doughOptionLabel.textContent = dough;
            //add the label to the div
            doughContainer.appendChild(doughOptionLabel);

            // create a element
            const doughOptionInput = document.createElement('input');
            // set the attributes
            doughOptionInput.type = 'radio';
            doughOptionInput.name = `dough${i}`;
            doughOptionInput.value = dough;
            // add the input to the label
            doughOptionLabel.appendChild(doughOptionInput);
        });
        pizzaContainer.appendChild(doughContainer);

        // The sauce follows the same logic as the dough
        const sauceLabel = document.createElement('label');
        sauceLabel.textContent = '* Sauce for Pizza';
        pizzaContainer.appendChild(sauceLabel);

        const sauceContainer = document.createElement('div');
        sauceContainer.className = 'sauceContainer';

        sauceTypes.forEach(sauce => {
            const sauceOptionLabel = document.createElement('label');
            sauceOptionLabel.textContent = sauce;
            sauceContainer.appendChild(sauceOptionLabel);

            const sauceOptionInput = document.createElement('input');
            sauceOptionInput.type = 'radio';
            sauceOptionInput.name = `sauce${i}`;
            sauceOptionInput.value = sauce;
            sauceOptionLabel.appendChild(sauceOptionInput);
        });
        pizzaContainer.appendChild(sauceContainer);

        // Exactly the same logic as the sauce and dough but with checkboxes
        const cheeseLabel = document.createElement('label');
        cheeseLabel.textContent = 'Base cheese for Pizz';
        pizzaContainer.appendChild(cheeseLabel);
        const cheeseContainer = document.createElement('div');
        cheeseContainer.className = 'cheeseContainer';

        cheeseTypes.forEach(cheese => {
            const cheeseOptionLabel = document.createElement('label');
            cheeseOptionLabel.textContent = cheese;
            cheeseContainer.appendChild(cheeseOptionLabel);

            const cheeseOptionInput = document.createElement('input');
            cheeseOptionInput.type = 'checkbox';
            cheeseOptionInput.name = `cheese${i}[]`;
            cheeseOptionInput.value = cheese;
            cheeseOptionLabel.appendChild(cheeseOptionInput);
        });

        pizzaContainer.appendChild(cheeseContainer);

        // Same logic as the cheese
        const toppingsLabel = document.createElement('label');
        toppingsLabel.textContent = '* Toppings for Pizza';
        pizzaContainer.appendChild(toppingsLabel);
        const toppingsContainer = document.createElement('div');
        toppingsContainer.className = 'toppingsContainer';

        toppingsTypes.forEach(topping => {
            const toppingOptionLabel = document.createElement('label');
            toppingOptionLabel.textContent = topping;
            toppingsContainer.appendChild(toppingOptionLabel);

            const toppingOptionInput = document.createElement('input');
            toppingOptionInput.type = 'checkbox';
            toppingOptionInput.value = topping;
            toppingOptionInput.name = `toppings${i}[]`;
            toppingOptionLabel.appendChild(toppingOptionInput);
        });
        pizzaContainer.appendChild(toppingsContainer);

        pizzasDiv.appendChild(pizzaContainer);
    }
}

function validateForm() {

    errorMessages = "";
    

    // Check if the number of pizzas is filled out
    const numberOfPizzas = document.getElementById('number').value;
    if (!numberOfPizzas || isNaN(numberOfPizzas)) {
        errorMessages += '<li>Please fill out the number of pizzas field.</li>';
    }

    if (numberOfPizzas > 10) {
        errorMessages += '<li>For orders of more than 10 pizzas, please call (222) 222-2222.</li>';
    }

    const firstName = document.getElementById('firstName').value;
    if (firstName.length < 2) {
        errorMessages += '<li>First name must be at least 2 characters long.</li>';
    }

    const lastName = document.getElementById('lastName').value;
    if (lastName.length < 2) {
        errorMessages += '<li>Last name must be at least 2 characters long.</li>';
    }

    const email = document.getElementById('email').value;
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        errorMessages += '<li>Please enter a valid email address.</li>';
    }

    const phone = document.getElementById('phone').value;
    const phonePattern = /^\d{3}-\d{3}-\d{4}$/;
    if (!phonePattern.test(phone)) {
        errorMessages += '<li>Please enter a valid phone number.</li>';
    }

    const street = document.getElementById('street').value;
    if (street.length < 2) {
        errorMessages += '<li>Street must be at least 2 characters long.</li>';
    }

    const stNumber =  document.getElementById('stNumber').value;
    if (isNaN(stNumber) || stNumber < 1 || stNumber === "") {
        errorMessages += '<li>Number must be a number.</li>';
    }

    console.log(stNumber); 

    for (let i = 0; i < numberOfPizzas; i++) {
        const size = document.querySelector(`select[name="size${i + 1}"]`).value;
        const dough = document.querySelector(`input[name="dough${i + 1}"]:checked`);
        const sauce = document.querySelector(`input[name="sauce${i + 1}"]:checked`);
        const toppings = document.querySelectorAll(`input[name="toppings${i + 1}"]:checked`);

        if (!size || !dough || !sauce || toppings.length === 0) {
            errorMessages += `<li>Please fill out all fields for Pizza ${i + 1}.</li>`;
        }
    }

    const messageDiv = document.getElementById('messages');
    if(errorMessages) {
        messageDiv.classList.add('errorMsg');
        messageDiv.innerHTML = '<h4>Error(s)</h4><ul>' + errorMessages + '</ul>';
        return false;
    } else {
        messageDiv.classList.add('successMsg');
        messageDiv.innerHTML = '<img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fvectorified.com%2Fimages%2Fdelivery-icon-1.png&f=1&nofb=1&ipt=0b8b146fc9e0d44d2ecbee5dd2ef09840d9201c3ad97ecf97801a396c206597b&ipo=images"><h4>Your order was successful! Thank you very much.</h4>';
        return true;
    }
    

    return true;
}

function toggleVisibility(id, element) {
    var row = document.getElementById(id);
    if (row.style.display === "none") {
        row.style.display = "table-row";
        element.innerHTML = '<i class="fa fa-eye-slash"></i> Hide Details';
    } else {
        row.style.display = "none";
        element.innerHTML = '<i class="fa fa-eye"></i> Show Details';
    }
}