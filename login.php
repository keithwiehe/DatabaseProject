<!-- source:https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php  -->

<?php
// Initialize the session
session_start();
 
// Include config file
require_once "config.php";

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: home.php");
    
    exit;
}
 

 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    // header("Location: home.php");//remove TEST
    // die;//REMOVE TEST
  if(empty($username) || empty($password))
  {
    return;
  } 
  else{
    // $query = "SELECT * USER WHERE USERNAME = '$username' limit 1";//should be good
    
    $result = mysqli_query($link, "SELECT * 
                                  FROM USER 
                                  WHERE USERNAME = '$username' limit 1");//upload query
    
    if($row = $result->fetch_assoc()) {
      if($row['PASSWORD'] == $password)
      {
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $row['USERID'];
        $_SESSION["username"] = $username;           
        header("Location: home.php");
        die;
      }
    } else {
      echo "Invalid login";
    }

  }
}
?>
 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" 
    integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <style>
      body{ font: 14px sans-serif; }
      .wrapper{ width: 350px; padding: 20px; }
    </style>
  </head>
  <body>
    <center>
      <h1>Playlist Maker</h1>
      <h2>Login</h2>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <!-- <form action="login.php" method="post"></form> -->
        <table>
        <tr>
            <td>Username</td>
            <td>  <input type="text" name="username" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
            </td>
          </tr>
          <tr>
            <td> Password </td>
            <td> <input type ="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
            </td>
          </tr>
          <br>
          <tr>
            <td> <input type="submit" name="login" value="login"></td>
          </tr>
          <tr>
              <p>Don't have an account? <a href="register.php">register here</a>.</p>
          </tr>
        </table>
    </center>
    <!-- <script src=""></script> -->

  </body>
</html> -->