<?php

//make it as a function in the closing...
session_start();
if(isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];
    $cart = $_SESSION['cart'];
    for($i = 0; $i < count($cart); $i++) {
        if($cart[$i]['book_id'] == $book_id) {
            unset($cart[$i]);
            break;
        }
    }
    $_SESSION['cart'] = array_values($cart);
    //after deleting the selected item recheck the cart if its empty redirect the user to add some books
    if (empty($_SESSION['cart'])) {
        header("Location: products.php");
        exit;
    }
}
header("Location: cart.php");
exit;
?>