<?php 
require_once 'components/header.php';
require_once 'components/menu.php';


if(isset($_GET['error'])){
    echo '<div class="errorMsg">'.cleanInput($_GET['error']).'</div>';
}
if(isset($_GET['success'])){
    echo '<div class="successMsg">'.cleanInput($_GET['success']).'</div>';
}
?>
<main>
    <h1>Orders</h1>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>First name</th>
                <th>Last name</th>
                <th>E-mail</th>
                <th>Phone</th>
                <th>Street</th>
                <th>Number</th>
                <th>Qt pizzas</th>
                <th>Show detatil</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($orders as $order){ ?>
                <tr>
                    <td><?php echo $order->getId() ?></td>
                    <td><?php echo $order->getFirstName() ?></td>
                    <td><?php echo $order->getLastName() ?></td>
                    <td><?php echo $order->getEmail() ?></td>
                    <td><?php echo $order->getPhone() ?></td>
                    <td><?php echo $order->getStreet() ?></td>
                    <td><?php echo $order->getNumber() ?></td>
                    <td><?php echo count($order->getPizzas()) ?></td>
                    <td>
                        <button onclick="toggleVisibility('order<?php echo $order->getId() ?>', this)">
                            <i class="fa fa-eye"></i> Show Details
                        </button>
                        <button onclick="window.location.replace('/?id=<?php echo $order->getId() ?>');"">
                            <i class="fa fa fa-edit"></i> Edit
                        </button>
                        <button onclick="confirm('Do you want delete the order #<?php echo $order->getId() ?>') && window.location.replace('/delete?id=<?php echo $order->getId() ?>');">
                            <i class="fa fa fa-trash-o"></i> Delete
                        </button>
                    </td>
                </tr>
                <tr id='order<?php echo $order->getId() ?>' style="display: none;"">
                    <td colspan="8">
                        <table>
                            <thead>
                                <tr>
                                    <th>Size</th>
                                    <th>Dough</th>
                                    <th>Souce</th>
                                    <th>Cheeses</th>
                                    <th>Toppings</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($order->getPizzas() as $pizza){ ?>
                                    <tr>
                                        <td><?php echo $pizza->getSize() ?></td>
                                        <td><?php echo $pizza->getDoughType() ?></td>
                                        <td><?php echo $pizza->getSauceType() ?></td>
                                        <td><?php echo $pizza->getCheesesTypeAsString() ?></td>
                                        <td><?php echo $pizza->getToppingsTypeAsString() ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>
<?php
require_once 'components/footer.php';
?>