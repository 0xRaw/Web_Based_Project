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
    <title>Orders Table</title>
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
          .orders-summary {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 20px 0;
      }
      .orders-summary p {
        margin: 0;
      }
      .orders-summary i {
        margin-right: 10px;
      }
      
      /* Responsive table */
      @media (max-width: 600px) {
        .order-table {
          width: 100%;
          margin-bottom: 20px;
          overflow-x: auto;
          display: block;
          white-space: nowrap;
        }
        .order-table th,
        .order-table td {
          width: auto;
          display: inline-block;
          vertical-align: top;
          overflow-x: auto;
          white-space: normal;
        }
      }
      
      /* Table styling */
      .order-table {
        border-collapse: collapse;
        width: 80%;
        margin: 0 auto;
      }
      .order-table th,
      .order-table td {
        padding: 10px;
        text-align: left;
      }
      .order-table tr:nth-child(even) {
        background-color: #f2f2f2;
      }
      
      /* Unique ID's for styling */
      #table-header {
        background-color: #4CAF50;
        color: white;
      }
      #username-column {
        width: 20%;
      }
      #items-column {
        width: 50%;
      }
      #price-column {
        width: 15%;
      }
      #actions-column {
        width: 15%;
      }
      .edit-button {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 5px 10px;
        cursor: pointer;
      }
      .delete-button {
        background-color: red;
        border: none;
        color: white;
        padding: 5px 10px;
        cursor: pointer;
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
        <a href="products_all.html"><i class="fa fa-plus-square"></i> Products</a>
        <a href="account.html" id="logout-button"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </nav>
<?php

// Get the number of orders
  $num_orders_query = "SELECT COUNT(*) FROM orders";
  $num_orders_result = mysqli_query($conn, $num_orders_query);
  $num_orders = mysqli_fetch_row($num_orders_result)[0];

  // Get the total price of the orders
  $total_price_query = "SELECT SUM(FullPrice) FROM orders";
  $total_price_result = mysqli_query($conn, $total_price_query);
  $total_price = mysqli_fetch_row($total_price_result)[0];

?>

<div class="orders-summary">
  <p>
    <i class="fa fa-shopping-cart"></i>
    <strong>Number of orders:</strong> <?php echo $num_orders; ?>
  </p>
  <p>
    <i class="fa fa-money"></i>
    <strong>Total price:</strong> $<?php echo $total_price; ?>
  </p>
</div>
   <?php
   $query = "SELECT users.UserName, orders.BookName, orders.OrderID , orders.FullPrice 
   FROM users 
   LEFT JOIN orders 
   ON users.UserID = orders.UserID 
   WHERE orders.BookName IS NOT NULL";
   $result = mysqli_query($conn, $query);
   
   // Calculate the total of all users' orders
   $total = 0;
   while ($row = mysqli_fetch_array($result)) {
     $total += $row['FullPrice'];
   }
   
   // Display the table
   echo '<table class="order-table">';
   echo '<tr id="table-header">';
   echo '<th id="username-column">Username</th>';
   echo '<th id="items-column">Items</th>';
   echo '<th id="price-column">Price</th>';
   echo '<th id="actions-column">Actions</th>';
   echo '</tr>';
   
   // Display the orders for each user
   mysqli_data_seek($result, 0);
   while ($row = mysqli_fetch_array($result)) {
     echo "<form method='POST' id='del'>";
     echo '<tr>';
     echo '<td>' . $row['UserName'] . '</td>';
     echo '<td><ul>';
     $items = explode(',', $row['BookName']);
     foreach ($items as $item) {
       echo '<li>' . $item . '</li>';
     }
     echo '</ul></td>';
     echo '<td>$' . $row['FullPrice'] . '</td>';
     echo "<input type='hidden' name='order_id' value=" . $row["OrderID"] . ">";
     echo "<td class='actions'>
     <button type='submit' onclick='return confirm(\"Are you sure you want to delete this order?\")'>Delete</button>
     </td>";
     echo "</form>";
     echo '</tr>';
   }
   echo '</table>';

   if (isset($_POST["order_id"])) {
    $delete_query = "DELETE FROM orders WHERE OrderID='{$_POST['order_id']}'";
    mysqli_query($conn, $delete_query);
    echo "<script>window.location.href='orders.php';</script>";
  }
   ?>

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
  