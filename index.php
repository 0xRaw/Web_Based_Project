<?php
session_start();
include 'connection.php'; 

// Check if the user is a returning customer by checking if their user ID is stored in a cookie
if (isset($_COOKIE['UserID']) && isset($_SESSION['userID'])) {
  header("refresh");
  $userID = $_COOKIE['UserID'];

  // Connect to the database

  // Fetch the user's past purchases from the database (JUST THE LAST ORDER)
  $sql = "SELECT * FROM orders WHERE UserID = '$userID' LIMIT 1";
  $result = $conn->query($sql);

  // If there are past purchases, display them on the page
  if ($result->num_rows > 0) {
    echo "<table class='table'>";
    echo "<center><h3>Lastest User Order</h3></center>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Book Name</th>";
    echo "<th>Order Date</th>";
    echo "<th>Order Total</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row["BookName"] . "</td>";
      echo "<td>" . $row["OrderTime"] . "</td>";
      echo "<td>" . $row["FullPrice"] . "</td>";
      echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
  } else {
    echo "No past purchases found.";
  }
}

// If the user is not a returning customer, store their user ID in a cookie
else {
  if(isset($_SESSION['userID'])){
  $userID = $_SESSION['userID'];
  setcookie("UserID", $userID, time() + (86400 * 30), "/");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>The Books Lover | Ebookstore</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?
      family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <style>
.table {
  width: 100%;
  border-collapse: collapse;
}

.table th,
.table td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

.table th {
  background-color: #ddd;
}
</style>
</head>

<body>
  <!------------------ Header ------------------>
  <div class="header">
    <div class="container">
      <div class="navbar">
        <div class="logo">
          <a href="index.php">
            <img src="images/EbookStore-Logo.png" alt="EbookStore-Logo" /></a>
        </div>
        <!----------  Nav Bar ------------------>
        <nav>
          <ul id="MenuItems">
            <li><a href="index.php">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="contact_us.php">Contact</a></li>
            <li><a href="account.php">Account</a></li>
            <!----------  Welcoming and Logout ------------------>
            <?php if (isset($_SESSION['username'])) {
              echo "<li> Welcome , $_SESSION[username] <li>";
              echo "<li><a href='logout.php'>Logout</a></li>";
            } ?>
          </ul>
        </nav>
        <a href="cart.php">
          <img src="images/cart.png" alt="Shoping Cart" width="28px" height="28px" style="margin-left: 10px; margin-top: 15px" />
        </a>
        <img src="images/menu.png" class="menu-icon" onclick="menutoggle()" />
      </div>
      <div class="row">
        <div class="col-2">
          <h1>
            The Books Lover<br />
            Read all About it!

          </h1>
          <p>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit.<br />
            Incidunt voluptas, porro nisi beatae inventore consequuntur?
          </p>
          <a href="products.php" class="btn">Explore Now &#x27F6;</a>
        </div>
        <div class="col-2">
          <img src="images/header-pic.png" alt="Header Pic" />
        </div>
      </div>
    </div>
  </div>
  <!----------------featured Books -------------------->

  <center>
    <h2>Discover Our Books Collection:</h2>
  </center>
  <div class="small-container">
    <div class="row">
      <?php
      //GET random books from the table
      $query = "SELECT * FROM Books ORDER BY rand() LIMIT 4";
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_assoc($result)) {
      ?>
        <div class="col-4">
          <a href="book-detail.php?id=<?php echo $row['BookID']; ?>">
            <img src="bookimages/<?php echo $bookImage =  str_replace(' ', '', $row['BookImage']); ?>" alt="<?php echo $row['BookName'] ?>" />
          </a>
          <h4><?php echo $row['BookName'] ?></h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <p><?php echo $row['BookPrice'] ?></p>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
  <!------------------offer ------------>
  <div class="offer">
    <div class="small-container">
      <div class="row">
        <div class="col-2">
          <img src="bookimages/TheLastGift.jpg" class="offer-img" />
        </div>
        <div class="col-2">
          <p>Available on EbookStore</p>
          <br />
          <h2>The Last Gift</h2>
          <br />
          <small>
            Takes on the themes of cultural identity and the weight of family secrets.
          </small>
          <a href="book-detail.php?id=3" class="btn">Buy Now &#8594;</a>
        </div>
      </div>
    </div>
  </div>
  <!-- ---------------testimonial-------------------->
  <?php
  $sql = "SELECT FullName, Messages FROM feedback ORDER BY RAND() LIMIT 3";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo '<div class="testimonial">
      <div class="small-container">
        <div div class="row">';
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      echo '<div class="col-3">
            <i class="fa fa-quote-left"></i>
            <p>' . $row["Messages"] . '</p>
            <div class="rating">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star-o"></i>
            </div>
            <img src="images/customer.png" alt="customer" />
            <h3>' . $row["FullName"] . '</h3>
          </div>';
    }
    echo '</div>
      </div>
    </div>';
  } ?>
  <!-- ---------------------publishers------------------- -->
  <div class="publishers">
    <div class="small-container">
      <div class="row">
        <div class="col-5">
          <img src="images/publisher1.jpg" />
        </div>
        <div class="col-5">
          <img src="images/publisher2.png" />
        </div>
        <div class="col-5">
          <img src="images/publisher3.jpeg" />
        </div>
        <div class="col-5">
          <img src="images/publisher4.jpg" />
        </div>
        <div class="col-5">
          <img src="images/publisher5.jpg" />
        </div>
      </div>
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
