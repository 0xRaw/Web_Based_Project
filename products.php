<?php include('connection.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Products</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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

    <style>
    form {
  display: flex;
  align-items: center;
  justify-content: center; 
}

    input[type="text"] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      box-sizing: border-box;
      border: 2px solid #ff523b;
      border-radius: 4px;
      font-size: 16px;
    }

    button[type="submit"] {
        width: 20%;
        background-color: #ff523b;
        color: white;
        padding: 8px 2px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #45a049;
    }


    </style>
  </head>

  <body>
    <!------------------ Header ------------------>
    <div class="container">
      <div class="navbar">
        <div class="logo">
          <a href="index.html">
            <img src="images/EbookStore-Logo.png" alt="EbookStore-Logo" />
          </a>
        </div>
        <!----------  Nav Bar ------------------>
        <nav>
            <ul id="MenuItems">
              <li><a href="index.html">Home</a></li>
              <li><a href="products.html">Products</a></li>
              <li><a href="contact_us.html">Contact</a></li>
              <li><a href="account.html">Account</a></li>
              <!----------  Welcoming and Logout ------------------>
              <?php if(isset($_SESSION['username'])){
              echo "<li> Welcome , $_SESSION[username] <li>";
              echo "<li><a href='logout.php'>Logout</a></li>";
              }?>
            </ul>
          </ul>
        </nav>
        <a href="cart.html">
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
    </div>

    <div class="small-container">
  <div class="row row-2">
    <h2>All Books</h2>
    <form action="products.php" method="POST">
      <input type="text" name="searchq" placeholder="Search...">
    <select name="sort_by">
      <option disabled selected>Default sorting</option>
      <option value="price_high">Sort by highest price</option>
      <option value="price_low">Sort by lowest price</option>
      <option value="newest">Sort by newest</option>
      <option value="oldest">Sort by oldest</option>
    </select>
    <button type="submit"><i class="fas fa-search"></i></button>
    </form>
  </div>
  <?php
  //get every thing from Books Table
$query = "SELECT * FROM Books";
if(isset($_POST['sort_by'])){
$sort_by = $_POST['sort_by'];
if ($sort_by == "price_high") {
  $query .= " ORDER BY BookPrice DESC";
} elseif ($sort_by == "price_low") {
  $query .= " ORDER BY BookPrice ASC";
} elseif ($sort_by == "newest") {
  $query .= " ORDER BY BookId DESC";
} elseif ($sort_by == "oldest") {
  $query .= " ORDER BY BookId ASC";
}}
//check if the search is empty or not, and if its presesnt in the request or not.
if(isset($_POST['searchq']) && !empty($_POST['searchq'])){
  $search = mysqli_real_escape_string($conn, strtolower($_POST['searchq']));
  $query .= " WHERE LOWER(BookName) LIKE '%$search%' OR LOWER(BookAuthor) LIKE '%$search%' OR LOWER(BookCategory) LIKE '%$search%'";
}
$result = mysqli_query($conn, $query);?>
<div class="row">
    <?php 
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
        echo '<div class="rating">
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star-o"></i>
      </div>';
      echo '<p>'.$bookPrice.' SAR </p>';
      echo '</div>';
      $counter++;
      if($counter % 4 == 0){
            echo '</div><div class="row">';
        }
    };
    ?>
</div><!-- THIS IS THE ORIGINAL CODE (IF YOU NEED IT AS REFERCNE)
      <div class="row">
        <div class="col-4">
          <a href="book-detail.html">
            <img src="images/Book 4.jpg" alt="Book 4" />
          </a>
          <a href="book-detail.html"> <h4>Anna Karenina</h4> </a>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <p>Rs.500</p>
        </div>
         -->
	  <!-- ---------------------Youtube Video------------------- -->
    <div class="youtube-container">
      <div class="youtube-row">
        <div class="col-2">
          <h2>5 Books You Must Read If You're Serious About Success</h2>
        </div>
        <div class="col-2">
          <iframe
            id="youtubevideo"
            width="560"
            height="315"
            src="https://www.youtube.com/embed/LqJBXtG9xxk"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
          ></iframe>
        </div>
      </div>
    </div>

	  <!-- -->
      <div class="page-btn">
      </div>
    </div>
        <!-- ---------------------footer------------------- -->
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
    </script>
  </body>
</html>
