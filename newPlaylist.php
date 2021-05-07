<?php
session_start();

// Include config file
require_once "config.php";
$id = $_SESSION["id"]; //$_SESSION['id'];
$_SESSION["loggedin"] = true;
$username = "test";//$_SESSION['username'];
$playlist_err = $playlist = "";
$value = $playlistid = 0;
$nameExists = false;

$result = mysqli_query($link, "SELECT DISTINCT SONGNAME, ALBUM, ARTIST, SONGID
                                FROM SONG
                                ORDER BY ARTIST");

  if(isset($_POST['save']))
  {
    $playlist = $_POST['playlist'];
    if(empty($playlist))
    {
      echo 'Must enter a playlist name!';
    }else {
    $query = mysqli_query($link, "SELECT DISTINCT PLAYLISTID, LISTNAME
                                  FROM PLAYLIST");
    if($query->num_rows > 0){
      $playlistid = $query->num_rows;
      while($row = $query->fetch_assoc())
      {
        if($playlist == $row['LISTNAME'])
          $nameExists = true;
      }
    }
    if($nameExists == false){
      $playlistid++;//id should always be 1 or +1 from highest.
      if(isset($_POST['checkItem'])){
        foreach($_POST['checkItem'] as $i)
        {
          $query = mysqli_query($link, "INSERT INTO PLAYLIST (PLAYLISTID, LISTNAME, USERID, SONGID)
                              VALUES ('$playlistid', '$playlist', '$id', '$i' )");
        }
      }
      header("Location: home.php");
    }  else{
      echo 'Name already exists try again';
      $nameExists = false;
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
    <script src ="cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"> </script>
    <script src ="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css"> </script>
    <script src ="cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src ="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src ="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css"/>
    <style>
      body{ font: 14px sans-serif; }
      .wrapper{ width: 350px; padding: 20px; }
    </style>
  </head>
  <body>
    <form method="post" action="">
    <table id="newtable" class="table table-striped table-bordered">
      <thead>
        <tr>
        <th>Add/Remove</th>
        <th>Song</th>
        <th>Album</th>
        <th>Artist</th>
        </tr>
      </thead>
    <?php
if($result->num_rows > 0){
  while($row = $result->fetch_assoc()){
    $value++;
    echo '
    <tr>
      <td> <input type="checkbox" name="checkItem[]" value='.$value.'></td>
      <td> '.$row['SONGNAME'].' </td>
      <td> '. $row['ALBUM'] .' </td>
      <td> '. $row['ARTIST'] .' </td>
    </tr> ';
  }
} else {
  echo "No Playlists found";
}
    ?>
    <tfoot>
            <tr>
                <th>Add/Remove</th>
                <th>Song</th>
                <th>Album</th>
                <th>Artist</th>
            </tr>
        </tfoot>
    </table>
      <p>Enter playlist name here </p>
      <input type ="text" name="playlist" class="form-control <?php echo (!empty($playlist_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $playlist; ?>">
      <button type="submit" class="btn btn-primary" style="width:200px" name="save">Submit</button>
      <br></br>
      <a href="home.php">Home</a>
    <br></br>
    <a href="logout.php">Logout</a>
<script>"js/jquery.min.js"</script>
<script>"js/boostrap.min.js"</script>
<script>"js/jquery.dataTables.min.js"</script>
<script>"js/dataTables.bootsrap.min.js"</script>
<script>"js/dataTables.checkboxes.min.js"</script>
<script>
$(document).ready( function () {
  var table = $('#newtable').DataTable( {
        columnDefs: [ {
    targets: 0,
    data: null,
    defaultContent: '',
    orderable: false,
    className: 'select-checkbox'
} ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        order: [[ 1, 'asc' ]]
    } );
} );
</script>
  </body>
</html>
