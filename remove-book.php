<?php
include 'connection.php'; 
  if (isset($_POST['delete'])) {
    $bookID = $_POST['book_id'];
    $sql = "DELETE FROM Books WHERE BookID = '$bookID'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Book Removed Successfully')</script>";
        echo "<script>window.location.href='products_all.php';</script>";
    } else {
      echo "Error deleting record: " . $conn->error;
    }
  }
?>