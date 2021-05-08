<?php

session_start();
// Include config file
require_once "config.php";
$id = $_SESSION["id"]; //$_SESSION['id'];
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
  header("location: login.php");
  
  exit;
}
$username = $_SESSION['username'];
$result = mysqli_query($link, "SELECT DISTINCT PLAYLISTID, LISTNAME, PLAYLIST.SONGID, SONGNAME, ALBUM, ARTIST
                                FROM PLAYLIST, SONG
                                WHERE USERID = '$id'  && PLAYLIST.SONGID = SONG.SONGID
                                ORDER BY PLAYLISTID");
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css"/>
    <style>
      body{ font: 14px sans-serif; }
      .wrapper{ width: 350px; padding: 20px; }
    </style>
  </head>
  <body>
    <table id="playlisttable" class="table table-striped table-bordered">
      <thead>
        <tr>
        <th>Playlist</th>
        <th>Song</th>
        <th>Album</th>
        <th>Artist</th>
        </tr>
      </thead>
    <a href="logout.php">Logout</a>
    <?php
if($result->num_rows > 0){
  $playlistid = "";
  while($row = $result->fetch_assoc()){
    echo '
    <tr>
      <td> '. $row['LISTNAME'] .' </td>
      <td> '. $row['SONGNAME'] .' </td>
      <td> '. $row['ALBUM'] .' </td>
      <td> '. $row['ARTIST'] .' </td>
      </tr> ';
    // if($playlistid != $row['PLAYLISTID'])
    // {
    //   $playlistid = $row['PLAYLISTID'];
    //   echo "Playlist: " . $row['LISTNAME'] . "<br>";
    // }
    //   echo "    " . $row['SONGID'] . "<br>";
  }
} else {
  echo "No Playlists found";
}
    ?>
      <tfoot>
            <tr>
                <th>Playlist</th>
                <th>Song</th>
                <th>Album</th>
                <th>Artist</th>
            </tr>
      </tfoot>
    </table>
    <a href="newPlaylist.php">New Playlist</a>
  </body>
</html>
<script>
$(document).ready( function () {
  $('#playlisttable').DataTable();
} );
</script>