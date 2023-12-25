<?php include 'header.php' ?>
<?php 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    // Fetch the hashed password from the database based on the entered email
    $fetch_password_query = "SELECT hashed_password FROM alumni_table WHERE email = '$email'";
    $fetched_password_result = mysqli_query($conn, $fetch_password_query);

    if ($fetched_password_result) {
        $hashed_password_from_db = mysqli_fetch_assoc($fetched_password_result)['hashed_password'];

        // Verify the entered password against the hashed password from the database
        if (password_verify($password, $hashed_password_from_db)) {
            // Password is correct. Proceed to login.
            $sql = "SELECT * FROM alumni_table WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                // Check if user exists
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    $user_id = $row['id'];
                    $user_name = $row['name'];

                    // Authenticated user
                    // Store username and id in session
                    $_SESSION['name'] = $user_name;
                    $_SESSION['id'] = $user_id; 

                    // Redirect to the appropriate page
                    if ($email != 'admin_email_here') {
                        header('location: home.php');
                        exit();
                    } else {
                        header('Location: dashboard.php');
                        exit();
                    }
                } else {
                    // Invalid credentials, redirect to login page
                    header('Location: login.php?error=InvalidCredentials');
                }
            } else {
                // Database error
                echo 'Error: ' . mysqli_error($conn);
            }
        } else {
            // Invalid password, redirect to login page
            header('Location: login.php?error=InvalidCredentials');
        }
    } else {
        // Database error
        echo 'Error: ' . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
        <p>You don't have an account?:<a href="/registration.php">Register</a></p>
    </div>
<?php include 'footer.php'?>
</body>
</html>
