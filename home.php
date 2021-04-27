<?php

// Include config file
require_once "config.php";
$id = 1; //$_SESSION['id'];
$_SESSION["loggedin"] = true;
$username = "test";//$_SESSION['username'];
$result = mysqli_query($link, "SELECT * FROM PLAYLIST WHERE USERID = '$id' ORDER BY PLAYLISTID");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" 
    integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <script src ="cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"> </script>
    <script src ="cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <style>
      body{ font: 14px sans-serif; }
      .wrapper{ width: 350px; padding: 20px; }
    </style>
  </head>
  <body>
    <?php
if($result->num_rows > 0){
  $playlistid = "";
  while($row = $result->fetch_assoc()){
    if($playlistid != $row['PLAYLISTID'])
    {
      $playlistid = $row['PLAYLISTID'];
      echo "Playlist: " . $row['LISTNAME'] . "<br>";
    }
      echo "    " . $row['SONGID'] . "<br>";
  }
} else {
  echo "No Playlists found";
}

    ?>
  </body>
</html>