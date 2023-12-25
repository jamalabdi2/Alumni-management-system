<?php
include 'config/database.php';
session_start();

$user_id = $_SESSION['id'];

$sql = "SELECT * FROM alumni_table WHERE id = $user_id";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_array($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Add Bootstrap CSS link here -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-4">
        <h2>User Profile</h2>
        <div class="card" style="width: 18rem;">
            <img src="<?php echo $row['profilePicture']; ?>" style="max-width: 150px; margin: auto;" alt="Profile Picture">
            <div class="card-body">
                <h5 class="card-title"><?php echo $row['name']; ?></h5>
                <p class="card-text"><strong>ID:</strong> <?php echo $row['id']; ?></p>
                <p class="card-text"><strong>Email:</strong> <?php echo $row['email']; ?></p>
                <p class="card-text"><strong>Graduation Year:</strong> <?php echo $row['gradYear']; ?></p>
                <p class="card-text"><strong>Major:</strong> <?php echo $row['major']; ?></p>
                <p class="card-text"><strong>Occupation:</strong> <?php echo $row['occupation']; ?></p>
                <p class="card-text"><strong>Time Created:</strong> <?php echo $row['time']; ?></p>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap JS and Popper.js scripts here -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
