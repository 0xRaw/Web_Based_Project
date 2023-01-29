<?php include('connection.php');
session_start();
if(isset($_POST['book-id']) && isset($_POST['book-title']) && isset($_POST['book-price']) && isset($_POST['book-quantity']) && isset($_POST['book-type']) && isset($_POST['book-category']) && isset($_POST['book-image']))
{
    $book_id = $_POST['book-id'];
    $book_title = $_POST['book-title'];
    $book_price = $_POST['book-price'];
    $book_type = $_POST['book-type'];
    $book_quantity=$_POST['book-quantity'];
    $book_category=$_POST['book-category'];
    $book_image=$_POST['book-image'];
    $cart = array();
    if(isset($_SESSION['cart'])){
      //SECOND ITEM ADDED (NOT THE FIRST.)
      $cart = $_SESSION['cart'];
      $cart[] = array( 'book_id' => $book_id, 'book_title' => $book_title, 'book_price' => $book_price, 'book_type' => $book_type, 'book_quantity' => $book_quantity , 'book_category' => $book_category , 'book_image' => $book_image);
      $_SESSION['cart'] = $cart;
    }
    else
    {
      //FIRST ITEM ADDED
      $cart[] = array( 'book_id' => $book_id, 'book_title' => $book_title, 'book_price' => $book_price, 'book_type' => $book_type, 'book_quantity' => $book_quantity , 'book_category' => $book_category, 'book_image' => $book_image);
      $_SESSION['cart'] = $cart;
      
    }
}
elseif(!isset($_SESSION['cart'])){
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
    <!-- ---------- UPDATE Processs------------- -->
    <form action="update-cart.php" method="post" id="Update">
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
          ?>
          <tr>
            <td colspan="2">Full Total</td>
            <td id="full-total"><?php echo $subtotal; ?> SAR</td>
          </tr>
        </table>
        <div class="my-btn-container">
        <input name="update_button" type="submit" value="Update Cart" class="btn btn-primary my-btn-update">
      </div>
      </div>
      </form>
              <!-- CHECK OUT PROCCESS -->
      <div class="small-container cart-page">
      
      <form action="checkout.php" method="post" id="Checkout">
        <div class="form-group">
          <label for="address" style="font-weight: bold;">Address</label>
          <input name="address" type="text" class="form-control" id="address" style="border-radius: 5px; padding: 10px; border: 1px solid gray;">
        </div>
        <div class="form-group">
          <label for="notes" style="font-weight: bold;">Notes</label>
          <input name="notes" class="form-control" id="notes" style="appearance: textfield; border-radius: 5px; padding: 10px; border: 1px solid gray; height: 100px;">
        </div>
        <div class="my-btn-container">
        <input name="checkout" type="submit" class="btn btn-primary my-btn-checkout" style="border-radius: 5px; padding: 10px; border: 1px solid gray;">
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
