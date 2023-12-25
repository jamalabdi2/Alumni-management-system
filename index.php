<?php include 'header.php'?>
<?php


// Fetch all events from the database
$fetch_all_sql = "SELECT * FROM events";
$results = mysqli_query($conn, $fetch_all_sql);
if ($results) {
    $events = mysqli_fetch_all($results, MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event List</title>
   
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .card-columns {
            column-count: 3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 style = "text-align: center;">Welcome to KLUMNI</h1>
        <h2>All Events</h2>

        <div class="card-columns">
            <?php foreach ($events as $event): ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $event['title']; ?></h5>
                        <p class="card-text">
                            <strong>Location:</strong> <?php echo $event['location']; ?><br>
                            <strong>Category:</strong> <?php echo $event['category']; ?><br>
                            <strong>Date:</strong> <?php echo $event['date']; ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php include 'footer.php'?>
