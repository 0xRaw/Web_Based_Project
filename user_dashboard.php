<?php
session_start(); 
include("connection.php");
    //Check if the session variable "username" exists
    if(!isset($_SESSION["username"])){
      //redirect users that are not authenticated to the login page.
      echo "<script>alert('your not logged in')</script>";
      echo "<script>window.location.href='account.php';</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Dashboard</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
    <hr>
    <br>

    <div class="dashboard">
        <div class="welcome">
          <h1>Welcome to the Dashboard!</h1>
        </div>
        <table class="orders">
          <tr>
            <th>Book Name</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Actions</th>
          </tr>
          <tr>
            <td>The Great Gatsby</td>
            <td>2</td>
            <td>$30</td>
            <td class="actions">
              <button onclick="showDialog()">Delete</button>
            </td>
          </tr>
          <tr>
            <td>Pride and Prejudice</td>
            <td>1</td>
            <td>$15</td>
            <td class="actions">
              <button onclick="showDialog()">Delete</button>
            </td>
          </tr>
        </table>
        <!-- Dialog box -->
        <div class="dialog-overlay">
          <div class="dialog-box">
            <h2>Order Cancellation</h2>
            <p>To cancel your order, please provide a reason for the cancellation and we will contact you via your email:</p>
            <form>
              <label for="reason">Reason:</label>
              <input type="text" id="reason" name="reason" required>
              <button type="submit">Send</button>
            </form>
            <button onclick="hideDialog()">Close</button>
          </div>
        </div>
        <!-- Dialog box script -->
        <script>
          function showDialog() {
            document.querySelector('.dialog-overlay').style.display = 'block';
          }
          function hideDialog() {
            document.querySelector('.dialog-overlay').style.display = 'none';
          }
        </script>
      </div>

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
            <!-- Message script -->
      <script>
        function showMessage() {
          document.querySelectorAll('.message').forEach(function(el) {
            el.style.display = 'block';
          });
        }
      </script>
    </body>
  </html>
  