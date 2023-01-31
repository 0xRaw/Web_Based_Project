<?php
session_start();
include 'connection.php';

$currentDate =  time(); // get current date
$timeoforder= date("Y-m-d H:i:s", $currentDate);

    // Check if user is logged in and has a valid cart
    if(isset($_SESSION['username']) && isset($_SESSION['userID']) && isset($_SESSION['cart'])){
        // User is logged in, proceed with order insertion
        $cart = $_SESSION['cart'];
        for($i = 0; $i < count($cart); $i++){
            $bookID = $cart[$i]['book_id'];
            $userID = $_SESSION["userID"];
            $bookName = $cart[$i]['book_title'];
            $quantity = $cart[$i]['book_quantity'];
            $fullPrice = $cart[$i]['book_price'] * $cart[$i]['book_quantity'];
            $bookType = $cart[$i]['book_type'];
            $address = $_POST['address'];
            $notes = $_POST['notes'];
            if ($bookType == 'hardcopy') {
                $checkStock = "SELECT BookStock FROM books WHERE BookID = '$bookID'";
                $result = $conn->query($checkStock);
                $stock = $result->fetch_assoc();
                //if the quantity provided by the user is over the avaliable stock..
                if ($quantity > $stock['BookStock']) {
                    echo "<br>";
                    echo "<center>";
                    echo "<h3>Stock is not available for this ".$cart[$i]['book_title'].", please reduce the quantity.</h3>";
                    echo '<br>';
                    echo "<span>The Avaliable Stock : </span>".$stock['BookStock'];
                    echo "<br>";
                    echo "<p>Go Back : <a href='javascript:onclick(window.history.back())'>click here</a> </p>";
                    echo "</center>";
                    echo "<br>";
                } else {
                    //update the stock
                    $newStock = $stock['BookStock'] - $quantity;
                    $updateStock = "UPDATE books SET BookStock = '$newStock' WHERE BookID = '$bookID'";
                    $conn->query($updateStock);
                    // Insert the order for hardcopy books
                    $sql = "INSERT INTO orders (BookID, UserID, BookName, Quantity, FullPrice ,BookType, Address, Notes , OrderTime) VALUES ('$bookID', '$userID', '$bookName', '$quantity', '$fullPrice', '$bookType', '$address', '$notes','$timeoforder')";
                    $conn->query($sql);
                    echo "<script>window.location.href='success.html';</script>";
                    }
            }elseif($bookType == 'pdf'){
                    $sql = "INSERT INTO orders (BookID, UserID, BookName, Quantity, FullPrice ,BookType, Address, Notes , OrderTime) VALUES ('$bookID', '$userID', '$bookName', '$quantity', '$fullPrice', '$bookType', '$address', '$notes','$timeoforder')";
                    $conn->query($sql);
                    unset($_SESSION['cart']);
                    echo "<script>window.location.href='success.html';</script>";
            }
        }
    }
                else{
                    echo "<script>alert('Error : User Not Authinticated.')</script>";
                    echo "<script>window.location.href='account.php';</script>";
                    }
                    
                    ?>