<?php
session_start(); // Start the session at the very beginning

// Check if artist is logged in
if (!isset($_SESSION['artist_id'])) {
    // Redirect to login page or handle unauthorized access
    header('Location: Login.php');
    exit;
}

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "JSdatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve artist_id from session
$artist_id = $_SESSION['artist_id'];

// SQL query to fetch uploaded items for the logged-in artist
$sql = "SELECT * FROM uploaddata WHERE artist_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $artist_id);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Uploaded Music</title>
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            min-height: 100vh;
            margin: 0;
        }

        .sidebar {
            background-color: #4b4276;
            color: white;
            width: 250px;
            padding: 15px;
            box-sizing: border-box;
        }

        .sidebar h2 {
            text-align: center;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 15px 0;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .sidebar ul li a:hover {
            background-color: #57517a;
        }

        .social_media {
            text-align: center;
            margin-top: 20px;
        }

        .social_media a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
            font-size: 20px;
        }

        .main-content {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .view-container {
            max-width: 800px;
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .view-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .items-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .item {
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .item h3 {
            margin-top: 0;
            font-size: 18px;
        }

        .item p {
            margin-bottom: 10px;
            font-size: 14px;
        }

        .item video {
            width: 100%;
            height: auto;
            display: block;
        }

        .comments-section {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #ccc;
        }

        .comments-section h4 {
            margin: 0;
        }

        .comment {
            margin-top: 10px;
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 4px;
        }

        .comment p {
            margin: 5px 0;
        }

        .approval-status {
            font-weight: bold;
            display: inline-block;
            margin-top: 5px;
        }

        .approved {
            color: green;
        }

        .rejected {
            color: red;
        }

        .pending {
            color: orange;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f1f1f1;
            text-align: center;
            border-top: 1px solid #ccc;
        }
        .comment {
            position: relative;
        }

        .approval-status {
            font-weight: bold;
        }

        .approved {
            color: green;
        }

        .rejected {
            color: red;
        }

        .approval-status.approved:hover::after {
            content: "Approved";
            position: absolute;
            left: 0;
            top: 100%;
            background-color: green;
            color: white;
            padding: 5px;
            border-radius: 4px;
            font-weight: bold;
        }

        .approval-status.rejected:hover::after {
            content: "Rejected";
            position: absolute;
            left: 0;
            top: 100%;
            background-color: red;
            color: white;
            padding: 5px;
            border-radius: 4px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Artist BASATA Account</h2>
        <ul>
            <li><a href="Home.php"><i class="fas fa-box"></i> Dashboard</a></li>
            <li><a href="upload.html"><i class="fas fa-upload"></i> Upload</a></li>
            <li><a href="uploaded.php"><i class="fas fa-eye"></i> View Uploaded</a></li>
            <li><a href="About.html"><i class="fas fa-info-circle"></i> About</a></li>
            <li><a href="helppage.html"><i class="fas fa-question-circle"></i> Help</a></li>
            <li><a href="Login.php"><i class="fas fa-sign-out-alt"></i> Log out</a></li>
        </ul>
        <div class="social_media">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
    </div>

    <div class="main-content">
        <div class="view-container">
            <h2>View Uploaded Music</h2>
            <div class="items-container">
                <?php
                // Display items if there are any
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="item">';
                        echo '<h3>' . htmlspecialchars($row['songname']) . '</h3>';
                        echo '<p>' . htmlspecialchars($row['description']) . '</p>';
                        echo '<video controls disablepictureinpicture controlsList="nodownload">';
                        echo '<source src="uploads/' . htmlspecialchars($row['file_name']) . '" type="video/mp4">';
                        echo 'Your browser does not support the video tag.';
                        echo '</video>';

                        // Fetch and display comments related to this item
                        $item_id = $row['id'];
                        $comment_sql = "SELECT * FROM comments WHERE item_id = ?";
                        $stmt_comments = $conn->prepare($comment_sql);
                        $stmt_comments->bind_param("i", $item_id);
                        $stmt_comments->execute();
                        $comments_result = $stmt_comments->get_result();

                        if ($comments_result->num_rows > 0) {
                            echo '<div class="comments-section">';
                            echo '<h4>Comments:</h4>';
                            while ($comment_row = $comments_result->fetch_assoc()) {
                                echo '<div class="comment">';
                                echo '<p>' . htmlspecialchars($comment_row['comment']) . '</p>';
                                $status = htmlspecialchars($comment_row['approval_status']);
                                $status_class = strtolower($status); // Use status to determine class
                                echo '<p class="approval-status ' . $status_class . '">' . htmlspecialchars($status) . '</p>';
                                echo '</div>';
                            }
                            echo '</div>';
                        } else {
                            echo '<p>No comments yet.</p>';
                        }

                        // Close the statement for comments
                        $stmt_comments->close();

                        echo '</div>';
                    }
                } else {
                    echo "No items uploaded yet.";
                }

                // Close prepared statements
                $stmt->close();
                
                // Close the database connection
                $conn->close();
                ?>
            </div>
        </div>
    </div>
</body>
</html>