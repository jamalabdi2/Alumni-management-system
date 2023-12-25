<?php
include 'config/database.php';
session_start();

$user_name = $_SESSION['name'];
$id = $_SESSION['id'];

if(!isset($user_name)){
    header('location: login.php');

}
$user_id = $_SESSION['id'];

$sql = "SELECT * FROM alumni_table WHERE id = $user_id";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_array($result);
}

// Fetch all users from the database
$fetch_all_sql = "SELECT * FROM alumni_table";
$results = mysqli_query($conn, $fetch_all_sql);
if ($results) {
    $alumni_information = mysqli_fetch_all($results, MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .navbar {
            background-color: #4caf50;
            padding: 15px 20px;
            border-bottom: 1px solid #ddd;
            color: #fff;
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
        }

        .navbar-nav {
            margin-top: 10px;
            list-style: none;
            display: flex;
        }

        .navbar-nav .nav-item {
            margin-right: 15px;
            font-size: 18px;
        }

        .navbar-nav .nav-item a {
            text-decoration: none;
            color: #fff;
        }

        .navbar-nav .nav-item a:hover {
            color: #333;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 8px;
            margin-right: 5px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        td img {
            max-width: 50px;
            max-height: 50px;
            border-radius: 50%;
        }
    </style>
</head>
<body>
<nav class="navbar">
    <div class="navbar-brand">
        <img src="<?php echo $row['profilePicture']; ?>" alt="Profile Picture" style="max-width: 40px; border-radius: 50%;">
    </div>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="index.php">Home</a></li>
        <li class="nav-item"><a href="profile.php">Profile</a></li>
        <li class="nav-item"><a href="logout.php">Logout</a></li>
    </ul>
</nav>

    <div class="container mt-4">
        <h3>Hey <?php echo $row['name'] ?></h3>
        <div class="row">
            <div class="col">
                <h2>All Alumni Information</h2>
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
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alumni_information as $info): ?>
                            <tr>
                                <td><?php echo $info['id']; ?></td>
                                <td><img src="<?php echo $info['profilePicture']; ?>"></td>
                                <td><?php echo $info['name']; ?></td>
                                <td><?php echo $info['email']; ?></td>
                                <td><?php echo $info['gradYear']; ?></td>
                                <td><?php echo $info['major']; ?></td>
                                <td><?php echo $info['occupation']; ?></td>
                                <td><?php echo $info['time']; ?></td>
                                <?php if($info['id'] == $user_id):?>
                                    <td>
                                        <a class = "edit" href="edit2.php?id=<?php echo $info['id']; ?>">Edit</a>
                                    </td>
                                <?php else: ?>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
