<?php include('connection.php');
session_start();
session_unset();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book Details</title>
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

    <!-- ----------single product details------------- -->
    <?php 
    //protect against SQL Injections attacks.
    $id = htmlspecialchars($_GET["id"], ENT_QUOTES, 'UTF-8');
    $id = strip_tags($id);
    $query = "SELECT * FROM Books WHERE BookId='$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result)
    ?>
   <form action="cart.php" method="post">
    <div class="small-container single-product">
      <div class="row">
        <div class="col-2">
        <img src="bookimages/<?php echo $bookImage =  str_replace(' ', '', $row['BookImage']); ?>" alt="<?php echo $row['BookName'] ?>" width="90%" />
        </div>
        <div class="col-2">
          <p>Home / Books</p>
          <h1><?php echo $row['BookName'] ;?></h1>
          <h2>Written by : <?php echo $row['BookAuthor']; ?></h2>
          <h3>Book Category : <?php echo $row['BookCategory'];?>
          <h4><?php echo $row['BookPrice']?> SAR</h4>
          <input name="book-quantity" type="number" value="1" />
          <span>Book Type : </span><select id="book-type" name="book-type">
                <option value="pdf">PDF</option>
                <option value="hardcopy">Hardcopy</option>
            </select>
            <input type="hidden" name="book-category" value="<?php echo $row['BookCategory'] ?>">
            <input type="hidden" name="book-id" value="<?php echo $row['BookID'] ?>">
            <input type="hidden" name="book-title" value="<?php echo $row['BookName'] ?>">
            <input type="hidden" name="book-price" value="<?php echo $row['BookPrice'] ?>">
            <input type="submit" value="Add To Cart" class="btn">
          <h3>Book Deatails <i class="fa fa-indent"></i></h3>
          <br />
          <p>
            <?php echo $row['BookDescription'];?>
          </p>
        </div>
      </div>
    </div>
</form>
    <!-- -------------title----------------- -->
    <div class="small-container">
      <div class="row row-2">
        <h2>More Books?</h2>
        <p><a href="products.php">View More</a></p>
      </div>
    </div>
    <!-- --------------Product-------------- -->
    <div class="small-container">
      <div class="row">
      <?php 
      //GET random books from the table
    $query = "SELECT * FROM Books ORDER BY rand() LIMIT 4";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="col-4">
          <a href="book-detail.php?id=<?php echo $row['BookID'];?>">
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
