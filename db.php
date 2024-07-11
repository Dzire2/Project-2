<?php
require_once('config.php'); // Include the database connection
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data using $_POST superglobal
    $Firstname = $_POST['Firstname'];
    $Lastname = $_POST['Lastname'];
    $Artisticname = $_POST['Artisticname'];
    $Email = $_POST['Email'];
    $Phonenumber = $_POST['Phonenumber'];
    $Password = $_POST['Password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if passwords match
    if ($Password !== $confirmPassword) {
        echo "Passwords do not match. Please try again.";
        // You can redirect or show an error message as needed
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($Password, PASSWORD_DEFAULT); // Using PASSWORD_DEFAULT for bcrypt

    // Prepare the SQL statement with placeholders
    $stmt = $conn->prepare("INSERT INTO artistdata (Firstname, Lastname, Artisticname, Email, Phonenumber, Password) VALUES (?, ?, ?, ?, ?, ?)");

    // Bind the actual values to the placeholders
    $stmt->bind_param("ssssss", $Firstname, $Lastname, $Artisticname, $Email, $Phonenumber, $hashed_password);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Registration successful, redirect user to login page
        $_SESSION['registration_success'] = true;
        header('Location: Login.php');
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
?>