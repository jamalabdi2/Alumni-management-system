<?php 

define('DB_NAME','alumni');
define('DB_PASS','Your_password_here');
define('DB_HOST','localhost');
define('DB_USER','jamal');
define('DB_PORT',3307);
define('DB_SOCKET','/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock');

$conn =  new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME,DB_PORT,DB_SOCKET);

//check for the errors
if($conn -> connect_error){
    die('connection Failed' . $conn -> connect_error);
}
?>

