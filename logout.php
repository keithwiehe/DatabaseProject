<?php
  session_start();
  unset($_SESSION['username']);
  $_SESSION['loggedin'] = false;
  $_SESSION["id"] = "";
  $_SESSION["username"] ="";      
  header("Location: login.php"); // Redirecting To Home Page
?> 