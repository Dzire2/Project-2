<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../Login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin View uploaded Music | BASATA</title>
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
            max-width: 1200px;
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
        }

        .item p {
            margin-bottom: 10px;
        }

        .comment-form {
            margin-top: 10px;
        }

        .comment-form textarea {
            width: 90%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            resize: vertical;
        }

        .comment-form input[type="submit"] {
            background-color: #4b4276;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .comment-form input[type="submit"]:hover {
            background-color: #57517a;
        }

        .approval-buttons {
            margin-top: 10px;
        }

        .approval-buttons button {
            padding: 8px 16px;
            margin-right: 10px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .approval-buttons button.approve {
            background-color: #4CAF50;
            color: white;
        }

        .approval-buttons button.reject {
            background-color: #f44336;
            color: white;
        }

        .approval-buttons button:hover {
            opacity: 0.8;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f1f1f1;
            text-align: center;
            border-top: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="admin.php"><i class="fas fa-box"></i> Dashboard</a></li>
            <li><a href="Adminview.php"><i class="fas fa-eye"></i> View Uploaded</a></li>
            <li><a href="../Logout.php"><i class="fas fa-key"></i> Log out</a></li>
        </ul>
        <div class="social_media">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
    </div>

    <div class="main-content">
        <div class="view-container">
            <h2>Admin View for Uploaded Music</h2>
            <div class="items-container">
                <!-- PHP code to display uploaded items with options to comment -->
                <?php
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

                // SQL query to fetch uploaded items
                $sql = "SELECT * FROM uploaddata";
                $result = $conn->query($sql);

                // Display items if there are any
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="item">';
                        echo '<h3>' . htmlspecialchars($row['songname']) . '</h3>';
                        echo '<p>' . htmlspecialchars($row['description']) . '</p>';
                        // Display video or audio
                        if (strpos($row['file_type'], 'video') !== false) {
                            echo '<video width="90%" controls>';
                            echo '<source src="../uploads/' . htmlspecialchars($row['file_name']) . '" type="' . htmlspecialchars($row['file_type']) . '">';
                            echo 'Your browser does not support the video tag.';
                            echo '</video>';
                            // Add download link for video

                        } elseif (strpos($row['file_type'], 'audio') !== false) {
                            echo '<audio controls>';
                            echo '<source src="../uploads/' . htmlspecialchars($row['file_name']) . '" type="' . htmlspecialchars($row['file_type']) . '">';
                            echo 'Your browser does not support the audio tag.';
                            echo '</audio>';
                            // Add download link for audio
                        } else {
                            // Debugging: Display a message if the file type is not recognized
                            echo '<p>Unsupported file type: ' . htmlspecialchars($row['file_type']) . '</p>';
                        }
                        // Comment and approval form
                 echo '<form class="comment-form" method="post" action="apprController.php">';
                 echo '<input type="hidden" name="item_id" value="' . $row['id'] . '">';
                 echo '<textarea name="comment" rows="3" placeholder="Add your comment..." required></textarea>';
                 echo '<div class="approval-buttons">';
                 echo '<button type="submit" name="approve" value="approve" class="approve">Approve</button>';
                 echo '<button type="submit" name="reject" value="reject" class="reject">Reject</button>';
                 echo '</div>';
                 echo '</form>';

                    }
                } else {
                    echo "No items uploaded yet.";
                }

                // Close database connection
                $conn->close();
                ?>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 BASATA. All rights reserved.</p>
    </footer>
</body>
</html>