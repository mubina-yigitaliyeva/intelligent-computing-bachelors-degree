<?php 
declare(strict_types = 1);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'includes/functions.php'; 
require_once 'includes/header.php'; 

$candies = [
    ['name' => 'Mints', 'price' => 2, 'quantity' => 5],
    ['name' => 'Toffee', 'price' => 3, 'quantity' => 5],
    ['name' => 'Fudge', 'price' => 5, 'quantity' => 4]
];
?>

<h2>Welcome to the Candy Store</h2>

<h3>Prices including 20% tax</h3>

<table border="1">
    <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total with tax</th>
    </tr>
    
    <?php 
        foreach ($candies as $candy) { ?>
        <tr>
            <td><?= htmlspecialchars($candy['name']) ?></td>
            <td>$<?= number_format($candy['price'], 2) ?></td>
            <td><?= $candy['quantity'] ?></td>
            <td>$<?= 
                number_format(calculate_total($candy['price'], $candy['quantity']), 2) 
                ?>
            </td>
        </tr>
        <?php } ?>

</table>

<h2>Advanced Functions</h2>

<?= student_greeting("Mubina") ?>
<p>Visit Count</p>
<p>First call: <?= visit_count() ?></p>
<p>Second call: <?= visit_count() ?></p>
<p>Third call: <?= visit_count() ?></p>

<p>Cart Summary</p>
<?php $result = cart_summary([100, 200, 400]); ?>

<p>Items: <?= $result['count'] ?></p>
<p>Total: <?= $result['total'] ?></p>

<h2>Check Grade</h2>
<p>Score 95: <?= check_grade(95) ?></p>
<p>Score 75: <?= check_grade(75) ?></p>
<p>Score 55: <?= check_grade(55) ?></p>

<h2>Product Labels</h2>
<p><?= product_label("Chocolate")?></p>
<p><?= product_label(
    name : "Mints",
    quantity : 5
)?></p>

<h2>Candy Store — Product Report</h2>

<?php
$products = [
    ['name' => '  chocolate  ', 'price' => 2.50],
    ['name' => 'mints ', 'price' => 1.50],
    ['name' => ' fudge', 'price' => 5.00]
    ];

$prices = array_column($products, 'price');
?>

<table border="2">
    <tr>
        <th>Product</th>
        <th>Price</th>
    </tr>

    <?php foreach($products as $product) { ?>
    <tr>
        <td><?= htmlspecialchars(clean_product_name($product['name'])) ?></td>
        <td>$<?= number_format($product['price'], 2) ?></td>
    </tr>

    <?php } ?>
</table>

<p>
    <strong>Total products: </strong>
    <?= count($products) ?>
</p>
<p>
    <strong>Average price: </strong>
    $<?= number_format(calculate_average($prices), 2) ?>
</p>

<br><br>

<?php require_once 'includes/footer.php' ?>