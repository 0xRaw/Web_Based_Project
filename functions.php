<?php
include("connection.php");



//this is used in : products_all.php , to make auth admin to upload products
function UploadProduct($conn){

  $book_name = $_POST["book-name"];
  $book_description = $_POST["book-description"];
  $book_publisher = $_POST["book-publisher"];
  $book_category = $_POST["book-category"];
  $book_publish_date = $_POST["book-publish-date"];
  $book_price = $_POST["book-price"];
  $BookStock=$_POST["book-stock"];
  $file_name = $_FILES["book-image"]["name"];
  $file_tmp = $_FILES["book-image"]["tmp_name"];
  $file_type = $_FILES["book-image"]["type"];
  $file_ext = pathinfo($_FILES["book-image"]["name"], PATHINFO_EXTENSION);
  $file_ext = strtolower($file_ext);

  $expensions= array("jpeg","jpg","png");

  if(in_array($file_ext,$expensions)=== false){
     echo "extension not allowed, please choose a JPEG or PNG file.";
  } else {
    $book_image = str_replace(' ', '', $book_name).'.'.$file_ext;
    move_uploaded_file($file_tmp,"bookimages/".$book_image);
  
    // Insert book data into the books table
    $sql = "INSERT INTO books (BookName, BookDescription, BookAuthor , BookCategory, BookPublished, BookPrice, BookImage , BookStock)
            VALUES ('$book_name', '$book_description', '$book_publisher', '$book_category', '$book_publish_date', '$book_price', '$book_image' , '$BookStock')";

    if (mysqli_query($conn, $sql)) {
      echo "Book added successfully.";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }
};



//this is used in : account.php , to register and login the users

function welcome_logout(){
    if(isset($_SESSION['username'])){
        echo "<li> Welcome , $_SESSION[username] <li>";
        echo "<li><a href='logout.php'>Logout</a></li>";
        }
}


function show_cart(){
  $cart = $_SESSION['cart'];
  $subtotal = 0;
  for ($i = 0; $i < count($cart); $i++) {
    $subtotal += (int)$cart[$i]['book_price'] * (int)$cart[$i]['book_quantity'];
    echo "
      <tr>
        <td>
          <div class='cart-info'>
            <img src='bookimages/".$cart[$i]['book_image']."' />
            <div>
              <p>" . $cart[$i]['book_title'] . "</p>
              <small> Per Piece : " . $cart[$i]['book_price'] . " SAR</small> <br />
              <small> Book Category : " . $cart[$i]['book_category'] . "</small> <br />
              <small> Book Type : " . $cart[$i]['book_type'] . "</small> <br />
              <a href='remove-from-cart.php?book_id=".$cart[$i]['book_id']."'>Remove</a>
            </div>
          </div>
        </td>
        <td>
          <input type='number' min='1' name='quantity[".$i."]' value='" . $cart[$i]['book_quantity'] . "'>
          <input type='hidden' name='book_id[".$i."]' value='" . $cart[$i]['book_id'] . "'>
        </td>
        <td> <span id='subtotal" . $i . "'>" . $cart[$i]['book_price'] * $cart[$i]['book_quantity'] . "</span> SAR</td>
        </tr>
      ";
    }
}
?>



