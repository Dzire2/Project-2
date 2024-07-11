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
    $item_id = mysqli_real_escape_string($conn, $_POST['item_id']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    if (isset($_POST['approve'])) {
        $status = 'approved';
    } elseif (isset($_POST['reject'])) {
        $status = 'rejected';
    } else {
        // Handle unexpected form submission
        echo "Error: Unexpected form submission.";
        exit;
    }

    // Function to handle approval status and insert into database
    function approval_status($conn, $item_id, $comment, $status) {
        // Check if item_id already exists in the comments table
        $check_query = "SELECT * FROM comments WHERE item_id = '$item_id'";
        $result = $conn->query($check_query);

        if ($result->num_rows > 0) {
            echo "Comment for this item already exists.";
            return;
        }

        // Insert comment with approval status
        $sql = "INSERT INTO comments (item_id, comment, approval_status)
                VALUES ('$item_id', '$comment', '$status')";

        if ($conn->query($sql) === TRUE) {
            echo "Comment $status successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Call function to handle approval status insertion
    approval_status($conn, $item_id, $comment, $status);
}

// Close database connection
$conn->close();
?>