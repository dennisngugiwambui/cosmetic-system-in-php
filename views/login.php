<?php
// Start the session
session_start();

// Include the database connection
include '../php/db.php';
global $conn;


// Set session timeout duration (20 minutes = 1200 seconds)
$timeout_duration = 1200;

// Check if the session exists and if it has expired
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout_duration)) {
    // If the session has been inactive for too long, destroy it and redirect to login
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
// Update last activity time stamp
$_SESSION['last_activity'] = time();

// Process form data when submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user from the database
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // If password matches, set session variables for the logged-in user
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['usertype'] = $user['usertype']; // Store the usertype in the session
        $_SESSION['last_activity'] = time();  // Update session activity time
        $_SESSION['logged_in'] = true;

        // Redirect based on usertype
        if ($user['usertype'] === 'admin') {
            header("Location: ../views/admin.php");  // Redirect admins to admin.php
        } else {
            header("Location: ../views/userDashboard.php");  // Redirect customers to userDashboard.php
        }
        exit();
    } else {
        // Invalid credentials
        $login_error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glow Cosmetics - Login</title>
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
            height: 100vh;
        }

        .login-container {
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

        .register-link {
            text-align: center;
            margin-top: 1rem;
        }

        .register-link a {
            color: #ff69b4;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="login-container">
    <h1>Login to Glow Cosmetics</h1>

    <!-- Show login error message if credentials are incorrect -->
    <?php if (isset($login_error)): ?>
        <p style="color: red;"><?php echo $login_error; ?></p>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>

    <div class="register-link">
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</div>
</body>
</html>
