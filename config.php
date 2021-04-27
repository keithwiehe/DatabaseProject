<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'mysql.eecs.ku.edu');
define('DB_USERNAME', 'k527w451');
define('DB_PASSWORD', 'ieN4gaev');
define('DB_NAME', 'k527w451');
 
/* Attempt to connect to MySQL database */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($mysqli->connect_errno){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>