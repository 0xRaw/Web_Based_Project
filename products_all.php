<?php
session_start(); 
include("connection.php");
include("functions.php");
//Check if the session variable "username" exists
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
  <title>Products Table</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?
      family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    #unique-navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #333;
      color: #fff;
      padding: 0 20px;
    }

    #unique-navbar a {
      color: #fff;
      text-decoration: none;
      font-size: 18px;
      display: flex;
      align-items: center;
    }

    #unique-navbar a .fa {
      margin-right: 10px;
    }

    /* Responsive layout */
    .upload-form {
      width: 80%;
      margin: 0 auto;
    }

    .form-field {
      display: flex;
      align-items: center;
      margin: 20px 0;
    }

    .form-field i {
      margin-right: 10px;
    }

    .form-field label {
      font-weight: bold;
    }

    .form-field input[type="text"],
    .form-field input[type="date"],
    .form-field select {
      width: 60%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    .form-field input[type="file"] {
      width: 60%;
      height: 38px;
      border: 2px solid #4CAF50;
      border-radius: 4px;
      background-color: white;
      font-size: 16px;
      color: #4CAF50;
      cursor: pointer;
    }

    .form-field input[type="file"]:hover {
      background-color: #eee;
    }

    .form-field input[type="file"]:active {
      background-color: #ddd;
    }

    .form-field input[type="submit"] {
      width: 20%;
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .form-field input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>

<body>
  <!------------------ Header ------------------>
  <div class="container">
    <div class="navbar">
      <div class="logo">
        <a href="index.php">
          <img src="images/EbookStore-Logo.png" alt="EbookStore-Logo" />
        </a>
      </div>
      <!----------  Nav Bar ------------------>
      <nav>
        <ul id="MenuItems">
          <li><a href="index.php">Home</a></li>
          <li><a href="products.php">Products</a></li>
          <li><a href="contact_us.php">Contact</a></li>
          <li><a href="account.php">Account</a></li>
        </ul>
      </nav>
      <a href="cart.php">
        <img src="images/cart.png" alt="Shoping Cart" width="28px" height="28px" style="margin-left: 10px; margin-top: 15px" />
      </a>
      <img src="images/menu.png" class="menu-icon" onclick="menutoggle()" />
    </div>
  </div>
  <hr>
  <br>

  <nav id="unique-navbar">
    <a href="orders.php"><i class="fa fa-shopping-cart"></i> Orders</a>
    <a href="feedback.php"><i class="fa fa-comments"></i> Feedback</a>
    <a href="products_all.php"><i class="fa fa-plus-square"></i> Products</a>
    <a href="account.php" id="logout-button"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </nav>
  <center><h2>
    Insert New Product
  </h2></center>
  <div class="row">
  <form name="book-form" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
    <div class="form-field">
      <i class="fa fa-book"></i>
      <label for="book-name">Book Name:</label>
      <input type="text" id="book-name" name="book-name" required>
    </div>
    <div class="form-field">
      <i class="fa fa-info-circle"></i>
      <label for="book-description">Book Description:</label>
      <input type="text" id="book-description" name="book-description" required>
    </div>
    <div class="form-field">
      <i class="fa fa-building"></i>
      <label for="book-publisher">Book Publisher:</label>
      <input type="text" id="book-publisher" name="book-publisher" required>
    </div>
    <div class="form-field">
      <i class="fa fa-list"></i>
      <label for="book-category">Book Category:</label>
      <select id="book-category" name="book-category" required="true">
        <option value="" disabled selected>-- Select a Category --</option>
        <option value="politics">Politics</option>
        <option value="Sports">Sports</option>
        <option value="novelties">Novelties</option>
        <option value="Fictions">Fictions</option>
      </select>
    </div>
    <div class="form-field">
      <i class="fa fa-calendar"></i>
      <label for="book-publish-date">Book Publish Date:</label>
      <input type="date" id="book-publish-date" name="book-publish-date" required>
    </div>
    <div class="form-field">
      <i class="fa fa-money"></i>
      <label for="book-price">Book Price:</label>
      <input type="text" id="book-price" name="book-price" required>
    </div>
    <div class="form-field">
      <i class="fa fa-shopping-cart"></i>
      <label for="book-stock">Book Stock:</label>
      <input type="text" id="book-stock" name="book-stock" required>
    </div>
    <div class="form-field">
      <i class="fa fa-file-image-o"></i>
      <label for="book-image">Book Image (only png and jpg):</label>
      <input type="file" id="book-image" name="book-image" accept=".png,.jpg" required>
    </div>
    <div class="form-field">
      <input type="submit" value="Upload" onclick="<?php UploadProduct($conn);?>">
    </div>
  </form>
  </div>

  <br>
  <br>
  <center><h2> Products </h2></center>
  <center>
  <form action="products_all.php" method="POST">
      <input type="text" name="searchq" placeholder="Search...">
    <button type="submit"><i class="fas fa-search"></i></button>
    </form>
    </center>
    <center>
  <div class=row>
  <?php
$query="SELECT * FROM Books";
if(isset($_POST['searchq']) && !empty($_POST['searchq'])){
  $search = mysqli_real_escape_string($conn, strtolower($_POST['searchq']));
  $query .= " WHERE LOWER(BookName) LIKE '%$search%' OR LOWER(BookAuthor) LIKE '%$search%' OR LOWER(BookCategory) LIKE '%$search%'";
}
$result = mysqli_query($conn, $query);
echo '<div class="row">';
$counter = 0;
while($row = mysqli_fetch_assoc($result)) {
  $bookName = $row['BookName'];
  $bookAuthor = $row['BookAuthor'];
  $bookID= $row['BookID'];
  $bookPrice = $row['BookPrice'];
  $bookImage =  str_replace(' ', '', $row['BookImage']); //to remove spaces in picture names
  $bookCategory = $row['BookCategory'];
  echo '<div class="col-4">';
  echo "<a href='book-detail.php?id=$bookID'><img src='bookimages/$bookImage' alt='test' /></a>";
  echo '<h4>'.$bookName.'</h4>';
  echo '<form action="remove-book.php" method="post">';
  echo '<input type="hidden" name="book_id" value="'.$bookID.'">';
  echo '<input type="submit" name="delete" value="Delete">';
  echo '</form>';
  echo '<form action="edit_book.php" method="GET">';
  echo '<input type="hidden" name="book_id" value="'.$bookID.'">';
  echo '<input type="submit" name="edit" value="Edit">';
  echo '</form>';
  echo '<p>'.$bookPrice.' SAR </p>';
  echo '</div>';
  $counter++;
  if($counter % 4 == 0){
    echo '</div><div class="row">';
  }
};
?>
  </div>
  </center>
  <br>
  <br>
  <br>
  <br>
  <div class="footer">
    <div class="container">
      <div class="row">
        <div class="footer-col-1">
          <h3>Download Our App</h3>
          <p>Download App for Android and ios mobile phone.</p>
          <div class="app-logo">
            <img src="images/Playstore.png" />
            <img src="images/Applestore.png" />
          </div>
        </div>
        <div class="footer-col-2">
          <img src="images/EbookStore-Logo-footer.png" />
          <p>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit.
            Reiciendis, Lorem ipsum dolor sit amet.
          </p>
        </div>
        <div class="footer-col-3">
          <h3>Useful Links</h3>
          <ul>
            <li>Coupons</li>
            <li>Blog Post</li>
            <li>Return Policy</li>
            <li>Join Affiliate</li>
          </ul>
        </div>
        <div class="footer-col-4">
          <h3>Follow us</h3>
          <ul>
            <li>Facebook</li>
            <li>Youtube</li>
            <li>Instagram</li>
            <li>Twitterr</li>
          </ul>
        </div>
      </div>
      <hr />
      <p class="copyright">Copyright 2022 - EbookStore</p>
    </div>
  </div>
  <!-- ---------Javascript for toggle menu------------- -->
  <script>
    var MenuItems = document.getElementById("MenuItems");
    MenuItems.style.maxHeight = "0px";

    function menutoggle() {
      if (MenuItems.style.maxHeight == "0px") {
        MenuItems.style.maxHeight = "200px";
      } else {
        MenuItems.style.maxHeight = "0px";
      }
    }
    function validateForm() {
    var bookName = document.forms["book-form"]["book-name"].value;
    var bookDescription = document.forms["book-form"]["book-description"].value;
    var bookPublisher = document.forms["book-form"]["book-publisher"].value;
    var bookCategory = document.forms["book-form"]["book-category"].value;
    var bookPublishDate = document.forms["book-form"]["book-publish-date"].value;
    var bookPrice = document.forms["book-form"]["book-price"].value;
    var bookStock = document.forms["book-form"]["book-stock"].value;

    // Check if fields are empty
    if (!bookName || !bookDescription || !bookPublisher || !bookCategory || !bookPublishDate || !bookPrice || !bookStock) {
      alert("All fields are required.");
      return false;
    }

    // Check if book name contains only characters, numbers and spaces
    var regex = /^[a-zA-Z0-9\s]+$/;
    if (!regex.test(bookName)) {
      alert("Book name should only contain characters, numbers and spaces.");
      return false;
    }
    return true;
  }
  </script>
</body>

</html>