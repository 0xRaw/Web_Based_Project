<?php 
session_start();
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Register</title>
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

    <!-- ---------- account page------------- -->
    <div class="account-page">
      <div class="container">
        <div class="row">
          <div class="col-2">
            <img src="images/header-pic.png" alt="Header Pic" />
          </div>
          <div class="col-2">
            <div class="form-container">
              <div class="form-btn">
                <span onclick="signIn()"> Sign In </span>
                <span onclick="signUp()"> Sign Up </span>
                <hr id="indicator" />

                <form id="signInForm" method="POST" action="account.php">
                  <input name="uname" type="text" placeholder="Username" />
                  <span id="uname"></span>
                  <input name="password" type="password" placeholder="Password" />
                  <button name="signin-btn" type="submit" class="btn">Sign In</button>
                  <a href="">Forgot password</a>
                </form>

                <form id="signUpForm" method="POST" action="account.php">
                  <input type="text" placeholder="Username" name="uname_reg" />
                  <input type="email" placeholder="Email" name="email_reg" />
                  <input name="pwd_reg" type="password" placeholder="Password"  />
                  <button name="signup-btn" type="submit" class="btn" >Sign Up</button>
                </form>  
              </div>
            </div>
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
    <!-- -----------js for toggle form------------------ -->
    <script>
      var signInForm = document.getElementById("signInForm");
      var signUpForm = document.getElementById("signUpForm");
      var indicator = document.getElementById("indicator");

      function signIn() {
        signUpForm.style.transform = "translateX(300px)";
        signInForm.style.transform = "translateX(300px)";
        indicator.style.transform = "translateX(0px)";
      }
      function signUp() {
        signUpForm.style.transform = "translateX(0px)";
        signInForm.style.transform = "translateX(0px)";
        indicator.style.transform = "translateX(100px)";
      }
    </script>
    <!-- -----------------js for form validation ------------------ -->
    <script>
      function formvalidate() {
        var ptrn = /^([^0-9\W]*)$/;
        if (ptrn.test(document.myform.uname.value)) {
          document.getElementById("uname").textContent = "User Name is Valid";
          document.getElementById("uname").style.background = "#72EF57";
          document.getElementById("uname").style.fontSize = "12px";
        } else {
          document.getElementById("uname").textContent = "User Name is Invalid";
          document.getElementById("uname").style.background = "#EF6257";
          document.getElementById("uname").style.fontSize = "12px";
        }
      }

      document.myform.uname.addEventListener("blur", formvalidate);
    </script>
  </body>
</html>
<?php
if (isset($_POST["signup-btn"])) {
  // Sign Up button was clicked
  $email = $_POST['email_reg'];
  $username = $_POST['uname_reg'];
  $password = md5($_POST['pwd_reg']); // hash the password using md5 (Weak I KNOW)

  // Check if email already exists in the user table
  $emailCheck = $conn->prepare("SELECT * FROM users WHERE Email = ?");
  $emailCheck->bind_param("s", $email);
  $emailCheck->execute();
  $emailResult = $emailCheck->get_result();

  if ($emailResult->num_rows > 0) {
    echo "<div>The email is already registered</div>";
  }

  // Check if username already exists in the user table
  $usernameCheck = $conn->prepare("SELECT * FROM users WHERE UserName = ?");
  $usernameCheck->bind_param("s", $username);
  $usernameCheck->execute();
  $usernameResult = $usernameCheck->get_result();

  if ($usernameResult->num_rows > 0) {
    echo "<div>The username is already taken</div>";
  } else {
    // add the new user to the table
    $insert = $conn->prepare("INSERT INTO users (UserName, Email, Pwd, isAdmin) VALUES (?, ?, ?,0)");
    $insert->bind_param("sss", $username, $email, $password);
    $insert->execute();
    //HERE WE CAN REDIRECT USER And SESSION For the user.
    //Store the username in a session variable
    $_SESSION["username"] = $username;
    //Redirect the user after registration process to user_dashboard.html
    echo "<script>window.location.href='user_dashboard.php';</script>";
    
  }
}
if (isset($_POST['signin-btn'])) {
  // Sign In button was clicked
  $username=$_POST['uname'];
  $password=md5($_POST['password']);
  $loginCheck = $conn->prepare("SELECT * FROM users WHERE UserName = ? AND  Pwd = ?");
  $loginCheck->bind_param("ss", $username, $password); //check this line
  $loginCheck->execute();
  $loginResult = $loginCheck->get_result();
  if ($loginResult->num_rows > 0) {
    $user = $loginResult->fetch_assoc();
    //Can Be used for checks.
    $_SESSION["username"] = $username;
    $_SESSION["userID"] = $user['UserID'];
    if($user['isAdmin'] === 1){
      $_SESSION["isAdmin"] = 1;
      echo "<script>window.location.href='dashboard.php';</script>";
    }else{
      $_SESSION["isAdmin"] = 0;
      echo "<script>window.location.href='user_dashboard.php';</script>";
    }
  }else{
    echo "<div> invalid Username/Password </div>";
  };
};
?>