<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: Login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Page</title>
    <script src="fontawesome/js/all.js"></script>
    <link rel="stylesheet" href="">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            min-height: 100vh;
            margin: 0;
        }

        .wrapper {
            display: flex;
            width: 100%;
        }

        .sidebar {
            background-color: #4b4276;
            color: white;
            width: 350px;
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

        .main_content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .header {
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
            background-color: #4b4276;
            color: white;
            padding: 10px 0;
        }

        .info {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .info h1 {
            margin-bottom: 10px;
        }

        .info h4 {
            margin-bottom: 20px;
        }

        .info p {
            line-height: 1.6;
        }

        marquee p {
            margin: 0;
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
<div class="wrapper">
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
    <div class="main_content">
        <div class="header">
            <marquee width="60%" direction="right" height="30px">
                <p style="font-size: 22px;">Welcome!!!! To BASATA official page</p>
            </marquee>
        </div>
        <div class="info">
            <h1>Artist Music Content Review System</h1><br>
            <h4>BASATA - Balaza la Sanaa la Taifa</h4> <br>
            <p>
                Mamlaka ya Baraza la Sanaa la Taifa (BASATA) inaleta mfumo kwa ajili ya kufufua na kukuza kazi za sanaa, kufanya utafiti, kutoa ushauri na usaidizi wa kiufundi, kupanga na kuratibu shughuli za kisanii, kuishauri Serikali, kutoa mafunzo, na kukagua kazi za wasanii.
            </p>
        </div>
    </div>
</div>
<footer>
      <p>&copy; 2024 BASATA. All rights reserved.</p>
  </footer>
</body>
</html>
