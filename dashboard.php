<?php
session_start(); 
include("connection.php");
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
    <title>Admin Dashboard</title>
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
    #dashboard {
      display: flex;
      align-items: center;
      margin: 20px;
    }
    #dashboard .statistics {
      width: calc(50% - 20px);
      margin-right: 20px;
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-around;
    }
    #dashboard .statistics .statistic {
      display: flex;
      align-items: center;
      margin: 20px;
      background-color: #f1f1f1;
      border-radius: 5px;
      padding: 10px;
    }
    #dashboard .statistics .statistic .icon {
      flex: 0 0 64px;
      width: 64px;
      height: 64px;
      background-color: #ffffff;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 10px;
    }
    #dashboard .statistics .statistic .icon i {
      font-size: 32px;
    }
    #dashboard .statistics .statistic .content {
      flex: 1;
    }
    #dashboard .statistics .statistic .content .value {
      font-size: 22px;
      font-weight: bold;
      text-align: right;
    }
    #dashboard .statistics .statistic .content .label {
      font-size: 18px;
      text-align: left;
      color: #999999;
    }
    #total-orders-chart {
      width: calc(50% - 20px);
      height: 10px;
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
    
    <nav id="unique-navbar">
        <a href="orders.html"><i class="fa fa-shopping-cart"></i> Orders</a>
        <a href="feedback.html"><i class="fa fa-comments"></i> Feedback</a>
        <a href="products_all.html"><i class="fa fa-plus-square"></i> Upload New Product</a>
        <a href="account.html" id="logout-button"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </nav>

    <div id="dashboard">
        <div class="statistics">
          <div class="statistic">
            <div class="icon"><i class="fas fa-book"></i></div>
            <div class="content">
              <div class="value">123</div>
              <div class="label">Number of Books</div>
            </div>
          </div>
          <div class="statistic">
            <div class="icon"><i class="fas fa-shopping-cart"></i></div>
            <div class="content">
              <div class="value">456</div>
              <div class="label">Number of Orders</div>
            </div>
          </div>
          <div class="statistic">
            <div class="icon"><i class="fas fa-money-bill-wave"></i></div>
         <div class="content">
        <div class="value">$72</div>
        <div class="label">Total Income</div>
      </div>
    </div>
    <div class="statistic">
      <div class="icon"><i class="fas fa-comments"></i></div>
      <div class="content">
        <div class="value">789</div>
        <div class="label">Total Feedback</div>
      </div>
    </div>
  </div>
  <canvas id="total-orders-chart" height="200px"></canvas>
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
            <!-- Include Chart.js library -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
            <script>
              // Define chart data
              const data = {
                labels: ['Orders', 'Income'],
                datasets: [{
                  data: [456, 27],
                  backgroundColor: ['#ff0000', '#00ff00']
                }]
              };
            
              // Get reference to canvas element
              const ctx = document.getElementById('total-orders-chart').getContext('2d');
            
              // Create new chart using data
              const chart = new Chart(ctx, {
                type: 'pie',
                data: data,
                options: {
                  responsive: true,
                  title: {
                 display: true,
                 text: 'Statistical Pie Chart for Orders & Income'
                }
                }
                
              });
            </script>
    </body>
  </html>
  
  