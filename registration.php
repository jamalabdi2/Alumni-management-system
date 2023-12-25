<?php include 'header.php';?>
<?php

$name = $email = $password = $gradYear = $major = $occupation = $profilePicture = "";
$nameErr = $emailErr = $passwordErr= $gradYearErr = $majorErr = $occupationErr = $profilePictureErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize name
    if (empty($_POST['name'])) {
        $nameErr = 'Name is required';
    } else {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    }

    // Validate and sanitize email
    if (empty($_POST['email'])) {
        $emailErr = 'Email is required';
    } else {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = 'Invalid email format';
        }
    }
        // Check if the user already exists based on the email
    $check_user_query = "SELECT * FROM alumni_table WHERE email = '$email'";
    $check_user_result = mysqli_query($conn, $check_user_query);

    if ($check_user_result && mysqli_num_rows($check_user_result) > 0) {
        $emailErr = 'User with this email already exists';
        echo $emailErr;
    }
    
    // Validate and sanitize password
    if (empty($_POST['password'])) {
        $passwordErr = 'Password is required';
    } else {
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
        $hashed_password = password_hash($password,PASSWORD_DEFAULT);
    }

    // Validate and sanitize graduation year
    if (empty($_POST['gradYear'])) {
        $gradYearErr = 'Graduation year is required';
    } else {
        $gradYear = filter_input(INPUT_POST, 'gradYear', FILTER_SANITIZE_NUMBER_INT);
    }

    // Validate and sanitize major
    if (empty($_POST['major'])) {
        $majorErr = 'Major is required';
    } else {
        $major = filter_input(INPUT_POST, 'major', FILTER_SANITIZE_SPECIAL_CHARS);
    }

    // Validate and sanitize occupation
    if (empty($_POST['occupation'])) {
        $occupationErr = 'Occupation is required';
    } else {
        $occupation = filter_input(INPUT_POST, 'occupation', FILTER_SANITIZE_SPECIAL_CHARS);
    }

    // Validate and handle profile picture upload


    if (!empty($_FILES['profilePicture']['name'])) {
        $targetDirectory = "uploads/"; 
        $targetFile = $targetDirectory . basename($_FILES["profilePicture"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the image file is an actual image or fake image
        $check = getimagesize($_FILES["profilePicture"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $profilePictureErr = "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["profilePicture"]["size"] > 500000) {
            $profilePictureErr = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow only certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $profilePictureErr = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $profilePictureErr = "Sorry, your file was not uploaded.";
        } else {
            // Move the uploaded file to the desired directory
            if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $targetFile)) {
                $profilePicture = $targetFile;
            } else {
                $profilePictureErr = "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Check if there are no errors before processing the form
    if (empty($nameErr) && empty($emailErr) && empty($gradYearErr) && empty($majorErr) && empty($occupationErr) && empty($profilePictureErr) && empty($passwordErr)){
        // Insert data into the database
        $sql = "INSERT INTO alumni_table (name, email,hashed_password,gradYear, major, occupation, profilePicture) VALUES ('$name', '$email', '$hashed_password','$gradYear', '$major', '$occupation', '$profilePicture')";
        if (mysqli_query($conn, $sql)) {
            // Success
            // Redirect to the login.php file
            header('Location: login.php');
            exit();
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    }
}
?>

    <title>Alumni Registration</title>
    <link rel="stylesheet" href="registration.css">
</head>
<body>
    <div class="container">
        <h1>Alumni Registration</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="gradYear">Graduation Year:</label>
            <input type="number" id="gradYear" name="gradYear" required>

            <label for="major">Major:</label>
            <input type="text" id="major" name="major" required>

            <label for="occupation">Occupation:</label>
            <input type="text" id="occupation" name="occupation" required>

            <label for="profilePicture">Profile Picture:</label>
            <input type="file" id="profilePicture" name="profilePicture" accept="image/*">

            <button type="submit" name="registration">Register</button>
            <p>Already Have an account <a href="/login.php">Login</a></p>
        </form>
    </div>
    <?php include 'footer.php';?>
</body>
</html>







<?php  
?>