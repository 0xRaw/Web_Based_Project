<?php
session_start();
include 'connection.php';
include ('functions.php');

if(!isset($_SESSION["username"])){
    //redirect users that are not authenticated to the login page.
    echo "<script>alert('your not logged in')</script>";
    echo "<script>window.location.href='account.php';</script>";
}else{
//check if he is an REAL Admin or NOT
if($_SESSION["isAdmin"] !== 1){
  echo "<script>alert('your not authorized')</script>";
  echo "<script>window.location.href='account.php';</script>";
};
};



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>The Books Lover | Ebookstore</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?
      family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
  </head>

  <body>
    <!------------------ Header ------------------>
    <div class="header">
      <div class="container">
        <div class="navbar">
          <div class="logo">
            <a href="index.php">
              <img src="images/EbookStore-Logo.png" alt="EbookStore-Logo"
            /></a>
          </div>
          <!----------  Nav Bar ------------------>
          <nav>
            <ul id="MenuItems">
              <li><a href="index.php">Home</a></li>
              <li><a href="products.php">Products</a></li>
              <li><a href="contact_us.php">Contact</a></li>
              <li><a href="account.php">Account</a></li>
              <!----------  Welcoming and Logout ------------------>
              <?php welcome_logout();?>
            </ul>
          </nav>
          <a href="cart.php">
            <img
              src="images/cart.png"
              alt="Shoping Cart"
              width="28px"
              height="28px"
              style="margin-left: 10px; margin-top: 15px"
            />
          </a>
          <img src="images/menu.png" class="menu-icon" onclick="menutoggle()" />
        </div>
<?php
include("connection.php");

if (isset($_GET['book_id']) && ($_GET['edit'])) {
    $bookID = mysqli_real_escape_string($conn, $_GET['book_id']);
    $query = "SELECT * FROM Books WHERE BookID = '$bookID'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $bookName = $row['BookName'];
    $bookAuthor = $row['BookAuthor'];
    $bookPrice = $row['BookPrice'];
    $bookCategory = $row['BookCategory'];
    $bookPublished = $row['BookPublished'];
    $bookStock = $row['BookStock'];
    $bookImage = $row['BookImage']; //no modification since the data is already stored with out spaces
    $bookDescription = $row['BookDescription'];
}

if (isset($_POST['update'])) {
    $bookName = mysqli_real_escape_string($conn, $_POST['book-name']);
    $bookAuthor = mysqli_real_escape_string($conn, $_POST['book-publisher']);
    $bookPrice = mysqli_real_escape_string($conn, $_POST['book-price']);
    $bookCategory = mysqli_real_escape_string($conn, $_POST['book-category']);
    $bookPublished = mysqli_real_escape_string($conn,$_POST['book-publish-date']);
    $bookStock = mysqli_real_escape_string($conn,$_POST['book-stock']);
    $bookDescription = mysqli_real_escape_string($conn,$_POST['book-description']);
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
      $query = "UPDATE Books SET BookName='$bookName', BookAuthor='$bookAuthor', BookPrice='$bookPrice', BookCategory='$bookCategory' ,BookImage='$book_image', BookPublished='$bookPublished' , BookStock='$bookStock', BookDescription='$bookDescription' WHERE BookID='$bookID'";
      $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>alert('Updated Successfully')</script>";
        echo "<script>window.location.href='products_all.php';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}}

?>
<form action="" method="post" enctype="multipart/form-data" id="book-form">
<div class="form-field">
      <i class="fa fa-book"></i>
      <label for="book-name">Book Name:</label>
      <input type="text" id="book-name" name="book-name" required value="<?php echo $bookName;?>">
    </div>
    <div class="form-field">
      <i class="fa fa-info-circle"></i>
      <label for="book-description">Book Description:</label>
      <input type="text" id="book-description" name="book-description" required  value="<?php echo $bookDescription;?>">
    </div>
    <div class="form-field">
      <i class="fa fa-building"></i>
      <label for="book-publisher">Book Publisher:</label>
      <input type="text" id="book-publisher" name="book-publisher" required value="<?php echo $bookAuthor;?>">
    </div>
    <div class="form-field">
      <i class="fa fa-list"></i>
      <label for="book-category">Book Category:</label>
      <select id="book-category" name="book-category" required="true">
        <option value="" disabled selected><?php echo $bookCategory;?></option>
        <option value="politics">Politics</option>
        <option value="Sports">Sports</option>
        <option value="novelties">Novelties</option>
        <option value="Fictions">Fictions</option>
      </select>
    </div>
    <div class="form-field">
      <i class="fa fa-calendar"></i>
      <label for="book-publish-date">Book Publish Date:</label>
      <input type="date" id="book-publish-date" name="book-publish-date" required value="<?php echo $bookPublished; ?>">
    </div>
    <div class="form-field">
      <i class="fa fa-money"></i>
      <label for="book-price">Book Price:</label>
      <input type="text" id="book-price" name="book-price" required value="<?php echo $bookPrice?>">
    </div>
    <div class="form-field">
      <i class="fa fa-shopping-cart"></i>
      <label for="book-stock">Book Stock:</label>
      <input type="text" id="book-stock" name="book-stock" required value="<?php echo $bookStock;?>">
    </div>
    <div class="form-field">
      <i class="fa fa-file-image-o"></i>
      <label for="book-image">Book Image (only png and jpg):</label>
      <input name="book-image" type="file" id="book-image"  accept=".png,.jpg">
      <img src="bookimages/<?php echo $bookImage;?>" width="120">
    </div>
    <input type="submit" name="update" value="Update">
</form>

<script>
  const form = document.getElementById('book-form');

  form.addEventListener('submit', function(e) {
    const bookPrice = document.getElementById('book-price');
    const bookStock = document.getElementById('book-stock');

    if (!/^\d+$/.test(bookPrice.value)) {
      alert('Book price must be a number!');
      e.preventDefault();
    }

    if (!/^\d+$/.test(bookStock.value)) {
      alert('Book stock must be a number!');
      e.preventDefault();
    }
  });
</script>