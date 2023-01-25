<?php include('connection.php');
session_start();
if(isset($_POST['book-id']) && isset($_POST['book-title']) && isset($_POST['book-price']) && isset($_POST['book-quantity']) && isset($_POST['book-type']) && isset($_POST['book-category']))
{
    $book_id = $_POST['book-id'];
    $book_title = $_POST['book-title'];
    $book_price = $_POST['book-price'];
    $book_type = $_POST['book-type'];
    $book_quantity=$_POST['book-quantity'];
    $book_category=$_POST['book-category'];
    $cart = array();
    if(isset($_SESSION['cart'])){
      $cart = $_SESSION['cart'];
      $cart[] = array( 'book_id' => $book_id, 'book_title' => $book_title, 'book_price' => $book_price, 'book_type' => $book_type, 'book_quantity' => $book_quantity , 'book_category' => $book_category);
      $_SESSION['cart'] = $cart;
    }
    else
    {
      $cart[] = array( 'book_id' => $book_id, 'book_title' => $book_title, 'book_price' => $book_price, 'book_type' => $book_type, 'book_quantity' => $book_quantity , 'book_category' => $book_category);
      $_SESSION['cart'] = $cart;
      
    }
}else{
  echo "<script>alert('Cart is empty, please add items to your cart.');</script>";
  echo "<script>window.location.href='products.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <style>

    </style>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cart</title>
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
        /></a>
        <img src="images/menu.png" class="menu-icon" onclick="menutoggle()" />
      </div>
    </div>

    <!-- ---------- cart items details------------- -->
    <form action="update-cart.php" method="post">
    <div class="small-container cart-page">
      <table>
        <tr>
          <th>Ebook</th>
          <th>Quantity</th>
          <th>Subtotal</th>
        </tr>
        <?php
          $cart = $_SESSION['cart'];
          $subtotal = 0;
          for ($i = 0; $i < count($cart); $i++) {
            $subtotal += (int)$cart[$i]['book_price'] * (int)$cart[$i]['book_quantity'];
            echo "
              <tr>
                <td>
                  <div class='cart-info'>
                    <img src='images/Book 16.jpg' alt='Book 16' />
                    <div>
                      <p>" . $cart[$i]['book_title'] . "</p>
                      <small> Per Piece : " . $cart[$i]['book_price'] . " SAR</small> <br />
                      <a href=''>Remove</a>
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
          ?>
          <tr>
            <td colspan="2">Full Total</td>
            <td id="full-total"><?php echo $subtotal; ?> SAR</td>
          </tr>
        </table>
        <div class="my-btn-container">
    <input type="submit" value="Update Cart" class="btn btn-primary my-btn-update">
    <input type="submit" Value="Check Out" class="btn btn-primary my-btn-update">
      </div>
      </div>
      </form>
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
