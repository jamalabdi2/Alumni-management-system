<?php
include 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $location = $_POST['location'];
    $category = $_POST['category'];
    $date = $_POST['date'];

    // Perform database insert
    $insert_query = "INSERT INTO events (title, location, category, date) VALUES ('$title', '$location', '$category', '$date')";
    $insert_result = mysqli_query($conn, $insert_query);

    if ($insert_result) {
        echo "Event registered successfully!";
        header('location: dashboard.php');
    } else {
        echo "Error registering event: " . mysqli_error($conn);
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }

        form {
            max-width: 400px;
            margin: auto;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Event Registration Form</h2>

        <form action="events.php" method="POST">
            <div class="form-group">
                <label for="title">Event Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" class="form-control" id="location" name="location" required>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" class="form-control" id="category" name="category" required>
            </div>

            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>

            <button type="submit" class="btn btn-primary">Register Event</button>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
