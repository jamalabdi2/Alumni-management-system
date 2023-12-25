<?php include 'config/database.php' ?>
<?php
// Get the alumni ID from the URL parameter
if(isset($_GET)){
    $alumniId = $_GET['id'];
}


// Query to delete the alumni record based on ID
$sql = "DELETE FROM alumni_table WHERE id = $alumniId";
mysqli_query($conn, $sql);

// Redirect back to the dashboard or any other page
header('Location: dashboard.php');
exit();
?>
