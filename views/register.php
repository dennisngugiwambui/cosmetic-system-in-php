
<?php

session_start();

// Include the database connection
include '../php/db.php';
global $conn;

// Initialize error and success messages
$registration_error = '';
$registration_success = '';

// Process form data when submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $usertype = isset($_POST['usertype']) ? $_POST['usertype'] : 'customer'; // Default to 'customer'

    // Check if the email already exists in the database
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Email already exists
        $registration_error = "An account with this email already exists.";
    } else {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new user into the database
        $sql = "INSERT INTO users (name, email, password, usertype) VALUES (:name, :email, :password, :usertype)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
        $stmt->bindParam(':usertype', $usertype, PDO::PARAM_STR);

        if ($stmt->execute()) {
            // Registration successful
            $registration_success = "Registration successful! You can now <a href='login.php'>login</a>.";
        } else {
            // Registration failed
            $registration_error = "Registration failed. Please try again.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glow Cosmetics - Register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 2rem 0;
        }

        .register-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            color: #ff69b4;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
        }

        input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        button {
            background-color: #ff69b4;
            color: #fff;
            border: none;
            padding: 0.75rem;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #ff1493;
        }

        .login-link {
            text-align: center;
            margin-top: 1rem;
        }

        .login-link a {
            color: #ff69b4;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="register-container">
    <h1>Register at Glow Cosmetics</h1>

    <!-- Show registration success or error messages -->
    <?php if (!empty($registration_success)): ?>
        <p style="color: green;"><?php echo $registration_success; ?></p>
    <?php endif; ?>

    <?php if (!empty($registration_error)): ?>
        <p style="color: red;"><?php echo $registration_error; ?></p>
    <?php endif; ?>

    <form action="register.php" method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <!-- Optional field for usertype (default is customer) -->
        <div class="form-group">
            <label for="usertype">User Type</label>
            <select id="usertype" name="usertype">
                <option value="customer">Customer</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <button type="submit">Register</button>
    </form>

    <div class="login-link">
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</div>
</body>
</html>