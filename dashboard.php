
<?php
session_start();
include 'header.php';
$user_name = $_SESSION['name'];
$id = $_SESSION['id'];

if(!isset($user_name)){
    header('location: login.php');
    exit();

}
//select all the record from the database
$sql = "SELECT * FROM alumni_table";
$results = mysqli_query($conn,$sql);
$alumni_information = mysqli_fetch_all($results,MYSQLI_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
    <title>Alumni Dashboard</title>
</head>
<body>
    <div class="container">
        <a class="events" href="events.php">Register Events</a>
        <h1>Alumni Dashboard</h1>
        <?php if(empty($alumni_information)):?>
            <p>There is no information to displayed</p>
        <?php endif;?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Profile Picture</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Graduation Year</th>
                    <th>Major</th>
                    <th>Occupation</th>
                    <th>Time Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($alumni_information as $info):?>
                    <tr>
                        <td><?php echo $info['id'];?></td>
                        <td><img src="<?php echo $info['profilePicture']; ?>"></td>
                        <td><?php echo $info['name'];?></td>
                        <td><?php echo $info['email'];?></td>
                        <td><?php echo $info['gradYear'];?></td>
                        <td><?php echo $info['major'];?></td>
                        <td><?php echo $info['occupation'];?></td>
                        <td><?php echo $info['time'];?></td>
                        
                        <td>
                                <a href="dashboard_edit.php?id=<?php echo (int)$info['id']; ?>">Edit</a>
                                <button onclick="deleteAlumni(<?php echo $info['id']; ?>)">Delete</button>
                        </td>

                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>

    <?php include 'footer.php'; ?>
    <script>
        function deleteAlumni(alumniId) {
            if (confirm("Are you sure you want to delete this alumni?")) {
                window.location.href = "delete.php?id=" + alumniId;
            }
        }
    </script>

</body>
</html>
