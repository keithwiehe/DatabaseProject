<!-- source:https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php  -->
<?php
 session_start();
 // Include config file
require_once "config.php";
 


// Define variables and initialize with empty values
$username = $password = $userid = "";

// //Processing form data when form is submitted
// if($_SERVER["REQUEST_METHOD"] == "POST"){

//   // Prepare a select statement
//   $query = "SELECT USERID 
//             FROM USER 
//             WHERE username = '$username'";
//   $result = mysqli_query($link, $query);
//   if(mysqli_stmt_num_rows($stmt) != 0){
//       $username_err = "This username is already taken.";
//   } else{
//     $username = trim($_POST["username"]);
//   }
//   } 
// else{
// echo "Oops! Something went wrong. Please try again later.";
// }

// // Validate password
// if(empty(trim($_POST["password"]))){
//   $password_err = "Please enter a password.";     
// } elseif(strlen(trim($_POST["password"])) < 6){
//   $password_err = "Password must have atleast 6 characters.";
// } else{
//   $password = trim($_POST["password"]);
// }

// // Check input errors before inserting in database
// if(empty($username_err) && empty($password_err)){
  
//   // Prepare an insert statement
//   $sql = "INSERT INTO USER (USERNAME, PASSWORD) VALUES ('$username', '$password')";//should be good
   
//   if($stmt = mysqli_prepare($link, $sql)){
//       // Bind variables to the prepared statement as parameters
//       mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
      
//       // Set parameters
//       $param_username = $username;
//       $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
      
//       // Attempt to execute the prepared statement
//       if(mysqli_stmt_execute($stmt)){
//           // Redirect user to welcome page
//           echo "Should have added to database";
//           header("location: home.php");
//       } else{
//           echo "Oops! Something went wrong. Please try again later.";
//       }

//       // Close statement
//       mysqli_stmt_close($stmt);
//   }

// // Close connection
// mysqli_close($link);
// }

$username_err = $password_err = "";
 
// //Processing form data when form is submitted
// if($_SERVER["REQUEST_METHOD"] == "POST"){
 
//     // Validate username
//     if(empty(trim($_POST["username"]))){
//         $username_err = "Please enter a username.";
//     } else{
//         // Prepare a select statement
//         $query = "SELECT USERID 
//                 FROM USER 
//                 WHERE username = '$username'";
        
//         if($stmt = mysqli_prepare($link, $query)){
//             // Bind variables to the prepared statement as parameters
//             mysqli_stmt_bind_param($stmt, "s", $param_username);
            
//             // Set parameters
//             $param_username = trim($_POST["username"]);
            
//             // Attempt to execute the prepared statement
//             if(mysqli_stmt_execute($stmt)){
//                 /* store result */
//                 mysqli_stmt_store_result($stmt);
                
//                 if(mysqli_stmt_num_rows($stmt) == 1){
//                     $username_err = "This username is already taken.";
//                 } else{
//                     $username = trim($_POST["username"]);
//                 }
//             } else{
//                 echo "Oops! Something went wrong. Please try again later.";
//             }

//             // Close statement
//             mysqli_stmt_close($stmt);
//         }
//     }
    
//     // Validate password
//     if(empty(trim($_POST["password"]))){
//         $password_err = "Please enter a password.";     
//     } elseif(strlen(trim($_POST["password"])) < 4){
//         $password_err = "Password must have atleast 4 characters.";
//     } else{
//         $password = trim($_POST["password"]);
//     }
    
//     // Check input errors before inserting in database
//     if(empty($username_err) && empty($password_err)){
        
//         // Prepare an insert statement
//         $query = "INSERT INTO USER (USERNAME, PASSWORD) 
//                 VALUES ('$username', '$password')";//should be good
         
//         if($stmt = mysqli_prepare($link, $query)){
//             // Bind variables to the prepared statement as parameters
//             mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
//             // Set parameters
//             $param_username = $username;
//             $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
//             // Attempt to execute the prepared statement
//             if(mysqli_stmt_execute($stmt)){
//                 // Redirect user to welcome page
//                 // echo "Should have added to database";
//                 $_SESSION["loggedin"] = true;
//                 $_SESSION["id"] = $row['USERID'];
//                 $_SESSION["username"] = $username;
//                 header("location: home.php");
//             } else{
//                 echo "Oops! Something went wrong. Please try again later.";
//             }

//             // Close statement
//             mysqli_stmt_close($stmt);
//         }
//     }
    
//     // Close connection
//     mysqli_close($link);
// }

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(empty($username) || empty($password))
        {
            return;
        } else{
            $query = "INSERT INTO USER (USERNAME, PASSWORD) 
                      VALUES ('$username', '$password')";//should be good
            
            mysqli_query($link, $query);//upload query
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $row['USERID'];
                $_SESSION["username"] = $username;
            header("Location: home.php");
            die;
        }
    }

?>
 <!-- my code here -->
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
      <h2>Register</h2>
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
            <td> <input type="submit" name="register" value="register"></td>
          </tr>
          <tr>
              <p>Already have an account? <a href="login.php">Login here</a>.</p>
          </tr>
        </table>
    </center>
    <!-- <script src=""></script> -->

  </body>
</html> -->
<!-- my code ends -->

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>
    </div>    
</body>
</html> -->