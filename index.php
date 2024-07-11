<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BASATA | Artist Registration Form</title>
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
        <div>
            <h2>Artist Music Content Review System</h2>
        </div>

        <form method="POST" action="db.php">
            <div>
                <h1>Artist Registration Form</h1>
            </div>
            <div>
                <label for="Firstname"><i class="fas fa-user"></i> First Name:</label>
                <input name="Firstname" class="form-control" type="text" placeholder="First Name" id="Firstname" required>
            </div>
            <div>
                <label for="Lastname"><i class="fas fa-user"></i> Last Name:</label>
                <input name="Lastname" class="form-control" type="text" placeholder="Last Name" id="Lastname" required>
            </div>
            <div>
                <label for="Artisticname"><i class="fas fa-user"></i> Artistic Name:</label>
                <input name="Artisticname" class="form-control" type="text" placeholder="Artistic Name" id="Artisticname" required>
            </div>
            <div>
                <label for="Email"><i class="fas fa-envelope"></i> Email Address:</label>
                <input name="Email" class="form-control" type="text" placeholder="Enter your Email Address" id="Email" required>
            </div>
            <div>
                <label for="Phonenumber"><i class="fas fa-phone"></i> Phone Number:</label>
                <input name="Phonenumber" class="form-control" type="text" placeholder="+255 --- --- ---" id="Phonenumber" required>
            </div>
            <div>
                <label for="Password"><i class="fas fa-key"></i> Password:</label>
                <input name="Password" class="form-control" type="password" placeholder="********" id="Password" required>
            </div>
            <div>
                <label for="confirmPassword"><i class="fas fa-key"></i> Confirm Password:</label>
                <input name="confirmPassword" class="form-control" type="password" placeholder="********" id="confirmPassword" required>
            </div>
            <div>
                <button name="Register" class="btn">Sign Up</button>
            </div> <br> <hr>
            <div class="alt-action">
                <p>Already Have an Account?</p> <br>
                <button class="btn-btn"><a href="Login.php">Sign in</a></button>
            </div>
        </form>
    </div>
 <footer>
         <p>&copy; 2024 BASATA. All rights reserved.</p>
     </footer>
</body>
</html>