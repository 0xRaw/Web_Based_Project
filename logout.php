<?php
session_start();
session_destroy();

//what verifies a user on our side.. :)
unset($_SESSION['username']);
unset($_SESSION['userID']);
header("Location: account.php");
exit;
?>