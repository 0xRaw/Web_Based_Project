<?php
session_start(); 
include("connection.php");
    //Check if the session variable "username" exists
    if(!isset($_SESSION["username"])){
      //redirect users that are not authenticated to the login page.
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
    <style>
    /* Responsive layout */
    .dashboard {
        width: 80%;
        margin: 0 auto;
      }
      .welcome {
        text-align: center;
        margin: 20px 0;
      }
      .welcome h1 {
        font-size: 36px;
        color: #4CAF50;
      }
      .orders {
        border-collapse: collapse;
        width: 100%;
      }
      .orders td,
      .orders th {
        border: 1px solid #ddd;
        padding: 8px;
      }
      .orders tr:nth-child(even) {
        background-color: #f2f2f2;
      }
      .orders th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
      }
      .orders td {
        text-align: right;
      }
      .orders td.actions {
        text-align: center;
      }
      .orders td.actions button {
        background-color: #f44336;
        border: none;
        color: white;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
      }
      .orders td.actions button:hover {
        background-color: #e57373;
      }
      /* Dialog box */
      .dialog-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
      }
      .dialog-box {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        background-color: white;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        padding: 16px;
      }
      .dialog-box h2 {
        margin: 0;
        font-size: 18px;
      }
      .dialog-box p {
        margin: 16px 0;
        font-size: 14px;
      }
      .dialog-box form {
        display: flex;
        align-items: center;
      }
      .dialog-box form label {
        flex: 1;
      }
      .dialog-box form input[type="text"] {
        flex: 2;
        height: 38px;
        padding: 0 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
      }
      .dialog-box form button {
        margin-left: 16px;
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
      }
      .dialog-box form button:hover {
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
            <li><a href="account.html"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
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
  