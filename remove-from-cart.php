<?php
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
}
header("Location: cart.php");
exit;
?>