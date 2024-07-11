<?php
session_start();
require_once 'config.php'; // Include the database connection script

// Process the login form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];

    // Admin credentials
    $adminEmail = 'admin@gmail.com';
    $adminPassword = 'admin#1234';

    // Check if the login is for the admin
    if ($Email === $adminEmail && $Password === $adminPassword) {
        $_SESSION['loggedin'] = true;
        $_SESSION['role'] = 'admin';
        header('Location: admin/admin.php');
        exit;
    } else {
        // Prepare the SQL statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT id, Email, Password FROM artistdata WHERE Email = ?");
        $stmt->bind_param("s", $Email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // Fetch the hashed password from the result set
            $row = $result->fetch_assoc();
            $hashed_password = $row['Password'];

            // Verify the password
            if (password_verify($Password, $hashed_password)) {
                // Password is correct, set session variables and redirect
                $_SESSION['loggedin'] = true;
                $_SESSION['role'] = 'artist';
                $_SESSION['user_id'] = $row['id']; // Optionally store user ID in session
                header('Location: Home.php');
                exit;
            } else {
                echo "Login failed. Please check your Email and Password.";
            }
        } else {
            echo "Login failed. Please check your Email and Password.";
        }
    }
}
?>