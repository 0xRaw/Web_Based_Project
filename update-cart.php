<?php
session_start();
$cart = $_SESSION['cart'];
$quantities = $_POST['quantity'];
$book_ids = $_POST['book_id'];

for ($i = 0; $i < count($cart); $i++) {
    if ($book_ids[$i] == $cart[$i]['book_id']) {
        $cart[$i]['book_quantity'] = $quantities[$i];
    }
}
$_SESSION['cart'] = $cart;
// redirect the user back to the cart page
header("Location: cart.php");
?>