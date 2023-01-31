<?php include('connection.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?
      family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
  <!------------------ Header ------------------>
  <div class="container">
    <div class="navbar">
      <div class="logo">
        <a href="index.php">
          <img src="images/EbookStore-Logo.png" alt="EbookStore-Logo" />
        </a>
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
  </div>
  <div id="contact-us-container">
    <h1 id="contact-us-heading">Provide Your Feedback ,</h1>
    <h3 id="contact-us-heading">You will be contacted via email.</h3>
    <form id="contactusForm" method="POST" action="contact_us.php">
      <input name="name" type="text" placeholder="Username" />
      <input name="email" type="text" placeholder="email" />
      <input name="message" type="text" placeholder="Message" />
      <button name="create-btn" type="submit" class="btn">Submit</button>
    </form>

    <?php
    if (isset($_POST['create-btn'])) {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $message = $_POST['message'];
      $MessageDate = date("y-m-d");

      $sql = "INSERT INTO feedback (FullName, Email, Messages,MessageDate)
  VALUES ('$name', '$email', '$message' , '$MessageDate')";

      if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    } ?>
    <br>
    <h2 id="contact-us-heading">Our Location :</h2>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3576.511799818381!2d50.16534504059168!3d26.309922075024186!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e49e63a6101cabb%3A0x7e4fd4e0d680283b!2sJarir%20Bookstore!5e0!3m2!1sen!2ssa!4v1675111981972!5m2!1sen!2ssa" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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

    const form = document.getElementById("contactusForm");
    form.addEventListener("submit", (event) => {
      event.preventDefault();
      const name = form.elements.name.value;
      const email = form.elements.email.value;
      const message = form.elements.message.value;

      if (name.trim() === "" || email.trim() === "" || message.trim() === "") {
        alert("All fields are required!");
        return;
      }

      const pattern = /^[a-zA-Z0-9 ]+$/;
      if (!pattern.test(name) || !pattern.test(email) || !pattern.test(message)) {
        alert("Input should contain only letters, numbers and spaces!");
        return;
      }

      form.submit();
    });
  </script>
</body>

</html>