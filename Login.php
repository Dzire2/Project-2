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
        $stmt = $conn->prepare("SELECT id, Password FROM artistdata WHERE Email = ?");
        $stmt->bind_param("s", $Email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($Password, $row['Password'])) {
                // Login successful, set session variables and redirect
                $_SESSION['loggedin'] = true;
                $_SESSION['artist_id'] = $row['id'];
                $_SESSION['role'] = 'artist';
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BASATA | Artist Login Form</title>
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            min-height: 100vh;
            background-color: slategray;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
            padding-bottom: 100px; /* To ensure space between the form and the footer */
        }
        .message-container {
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 500px;
            text-align: center;
            background-color: #f0f0f0;
            padding: 10px 20px;
            border-bottom: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            padding: 20px;
            text-align: center;
            margin-bottom: auto; /* To ensure space between the form and the footer */
        }
        h1, h2 {
            color: #333;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            border-color: #6b73ff;
            outline: none;
        }
        .btn {
            background: #6b73ff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }
        .btn:hover {
            background: #000dff;
        }
        .btn-btn {
            background: #23a327;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }
        .btn-btn:hover {
            background: #1c7f1f;
        }
        .btn a {
            color: #fff;
            text-decoration: none;
        }
        .alt-action {
            margin-top: 20px;
            font-size: 14px;
        }
        p {
            color: #333;
            margin-top: 20px;
        }
        label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            color: #333;
        }
        footer {
            width: 100%;
            background-color: #f1f1f1;
            text-align: center;
            border-top: 1px solid #ccc;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            left: 0;
        }
    </style>
</head>
<body>
<div class="container">
    <form method="post" action="Login.php">
        <h1>Artist Music Content Review System</h1>
        <h2>Artist Login Form</h2>
        <div class="form-group">
            <label for="Email"><i class="fas fa-envelope"></i> Email Address:</label>
            <input type="text" name="Email" class="form-control" placeholder="Enter your Email" id="Email" required>
        </div>
        <div class="form-group">
            <label for="Password"><i class="fas fa-key"></i> Password:</label>
            <input type="password" name="Password" class="form-control" placeholder="********" id="Password" required>
        </div>
        <div class="form-group">
            <button id="login" class="btn">Sign in</button>
        </div>
        <div class="alt-action">
            <p>_____________ Or ______________</p>
            <p>You Don't Have an Account?</p> <br>
            <button id="" class="btn-btn"><a href="index.php">Sign Up</a></button>
        </div>
    </form>
</div>
<footer>
    <p>&copy; 2024 BASATA. All rights reserved.</p>
</footer>
</body>
</html>
