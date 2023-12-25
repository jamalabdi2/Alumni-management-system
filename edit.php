<?php
include 'header.php';

// Function to get alumni details by ID
// Function to get alumni details by ID
function getAlumniById($conn, $alumniId) {
    $stmt = mysqli_prepare($conn, "SELECT * FROM alumni_table WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $alumniId);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    return $result ? mysqli_fetch_assoc($result) : false;
}


// Function to update alumni information
function updateAlumni($conn, $alumniId, $data) {
    var_dump($data);
    $stmt = mysqli_prepare($conn, "UPDATE alumni_table SET 
                                    name = ?,
                                    email = ?,
                                    gradYear = ?,
                                    major = ?,
                                    occupation = ?,
                                    profilePicture = ?
                                  WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "ssisssi", $data['name'], $data['email'], $data['gradYear'], $data['major'], $data['occupation'], $data['profilePicture'], $alumniId);

    return mysqli_stmt_execute($stmt);
}



// Get the alumni ID from the URL parameter
if(isset($_GET['id'])){
    $alumniId = (int)$_GET['id'];

}


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the existing alumni data
    var_dump($_POST);
    $alumni = getAlumniById($conn, $alumniId);

    if ($alumni) {
        // Get the updated values from the form
        $alumniId = $_POST['alumniId'];
        $updatedData = [
            
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'gradYear' => $_POST['gradYear'],
            'major' => $_POST['major'],
            'occupation' => $_POST['occupation'],
            'profilePicture' => $alumni['profilePicture'], // Default to the existing picture
        ];

        // Check if a new profile picture is uploaded
        if ($_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            $uploadFile = $uploadDir . basename($_FILES['profilePicture']['name']);

            if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $uploadFile)) {
                $updatedData['profilePicture'] = $uploadFile;
            } else {
                echo "Error uploading profile picture.";
            }
        }

        // Update the alumni record in the database
        if (updateAlumni($conn, $alumniId, $updatedData)) {
            echo "Alumni information updated successfully!";
            header('Location: dashboard.php');
            exit();
        } else {
            echo "Error updating alumni information.";
        }
    } else {
        echo "Alumni not found.";
        exit();
    }
} else {
    // Check if the ID is set before querying the database
    if ($alumniId !== null) {
        // Query to retrieve alumni information based on ID
        $alumni = getAlumniById($conn, $alumniId);

        // Debugging statement
        var_dump($alumni);

        if (!$alumni) {
            echo "Alumni not found.";
            exit();
        }
    } else {
        // Redirect to the dashboard if ID is not set
        header('Location: dashboard.php');
        exit();
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
            <!-- Include your form fields here with pre-filled values from $alumni -->
            <input type="hidden" name="alumniId" value="<?php echo isset($alumni['id']) ? (int)$alumni['id'] : 0; ?>">



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

            <label for="profilePicture">Profile Picture:</label>
            <input type="file" id="profilePicture" name="profilePicture" accept="image/*">

            <button type="submit" name="update">Save Changes</button>
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
