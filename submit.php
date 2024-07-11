<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "JSdatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape and sanitize inputs to prevent SQL injection
    $songname = mysqli_real_escape_string($conn, $_POST['songname']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // File upload handling
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];
    $file_error = $_FILES['file']['error'];

    // Check file type
    $allowed_extensions = array("mp4", "mp3", "avi");
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    if (!in_array($file_ext, $allowed_extensions)) {
        die("Only MP4, MP3, and AVI files are allowed.");
    }

    // Directory where uploaded files will be saved
    $upload_directory = "uploads/";
    $upload_path = $upload_directory . $file_name;

    // Check for duplicate files
    if (file_exists($upload_path)) {
        die("A file with the same name already exists.");
    }

    // Move uploaded file to the desired directory
    if (move_uploaded_file($file_tmp, $upload_path)) {
        // Insert data into database
        $sql = "INSERT INTO uploaddata (songname, description, file_name, file_size, file_type) 
                VALUES ('$songname', '$description', '$file_name', '$file_size', '$file_type')";

        if ($conn->query($sql) === TRUE) {
            echo "File uploaded successfully and data inserted into the database.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Failed to upload file.";
    }
}
// Close database connection
$conn->close();
?>