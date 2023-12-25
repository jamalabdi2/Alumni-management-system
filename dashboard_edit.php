<?php 
include 'config/database.php';

//get id from the request
if(isset($_GET['id'])){
     $alumni_id= $_GET['id'];
     //retrieve the data from the database
     $sql = "SELECT * FROM alumni_table WHERE id = $alumni_id";
     $result = mysqli_query($conn,$sql);
     if($result){
        $alumni = mysqli_fetch_array($result);
     }
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['update'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $gradYear = $_POST['gradYear'];
        $major = $_POST['major'];
        $occupation = $_POST['occupation'];
        $alumniId = $_POST['alumniId'];

        $update_query = "UPDATE alumni_table SET 
                     name='$name', 
                     email='$email',  
                     gradYear=$gradYear, 
                     major='$major', 
                     occupation='$occupation' 
                     WHERE id=$alumniId";

        $update_result = mysqli_query($conn, $update_query);
        if($update_result){
            header('location: dashboard.php');
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }

    }
 }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit.css">
    <title>Edit Alumni</title>
</head>
<body>
    <div class="container">
        <h1>Edit Alumni</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="alumniId" value="<?php echo $alumni['id']?>">

            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $alumni['name']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $alumni['email']; ?>" required>

            <label for="gradYear">Graduation Year:</label>
            <input type="number" id="gradYear" name="gradYear" value="<?php echo $alumni['gradYear']; ?>" required>

            <label for="major">Major:</label>
            <input type="text" id="major" name="major" value="<?php echo $alumni['major']; ?>" required>

            <label for="occupation">Occupation:</label>
            <input type="text" id="occupation" name="occupation" value="<?php echo $alumni['occupation']; ?>" required>

            <button type="submit" name="update">Save Changes</button>
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
