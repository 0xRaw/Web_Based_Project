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
    <title>Feedback Table</title>
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

   /* Responsive layout */
   .feedback-summary {
     display: flex;
     justify-content: space-between;
     align-items: center;
     margin: 20px 0;
   }
   .feedback-summary p {
     margin: 0;
   }
   .feedback-summary i {
     margin-right: 10px;
   }
   
   /* Responsive table */
   @media (max-width: 600px) {
     .feedback-table {
       width: 100%;
       margin-bottom: 20px;
       overflow-x: auto;
       display: block;
       white-space: nowrap;
     }
     .feedback-table th,
     .feedback-table td {
       width: auto;
       display: inline-block;
       vertical-align: top;
       overflow-x: auto;
       white-space: normal;
     }
   }
   
   /* Table styling */
   .feedback-table {
     border-collapse: collapse;
     width: 80%;
     margin: 0 auto;
   }
   .feedback-table th,
   .feedback-table td {
     padding: 10px;
     text-align: left;
   }
   .feedback-table tr:nth-child(even) {
     background-color: #f2f2f2;
   }
   
   /* Unique ID's for styling */
   #table-header {
     background-color: #4CAF50;
     color: white;
   }
   #fullname-column {
     width: 20%;
   }
   #email-column {
     width: 30%;
   }
   #date-column {
     width: 15%;
   }
   #message-column {
     width: 35%;
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
    <?php

// Get the number of feedbacks
  $num_feedback_query = "SELECT COUNT(*) FROM feedback";
  $num_feedback_result = mysqli_query($conn, $num_feedback_query);
  $num_feedback = mysqli_fetch_row($num_feedback_result)[0];

?>
    <nav id="unique-navbar">
        <a href="orders.html"><i class="fa fa-shopping-cart"></i> Orders</a>
        <a href="feedback.html"><i class="fa fa-comments"></i> Feedback</a>
        <a href="products_all.html"><i class="fa fa-plus-square"></i> Products</a>
        <a href="account.html" id="logout-button"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </nav>
    <div class="feedback-summary">
        <p>
          <i class="fa fa-comments"></i>
          <strong>Number of feedback messages:</strong> <?php echo $num_feedback;?>
        </p>
      </div>
      <table class="feedback-table">
        <tr id="table-header">
          <th id="fullname-column">Full Name</th>
          <th id="email-column">Email Address</th>
          <th id="date-column">Date</th>
          <th id="message-column">Message</th>
        </tr>
      <?php
      $query = "SELECT * FROM feedback";
      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result) < 1) {
        echo "No Feedback Has Been Received From User.";
      } else {
        while ($row = mysqli_fetch_array($result)) {;
        echo "<tr>";
        echo "<td>".$row["FullName"]."</td>";
        echo "<td>".$row["Email"]."</td>";
        echo "<td>".$row["MessageDate"]."</td>";
        echo "<td>".$row["Messages"]."</td>";
        echo "</tr>";
        }}?>

      </table>
    </body>
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
  