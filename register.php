<?php
include 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user_type = $_POST['user_type'];

    $check = $conn->query("SELECT * FROM users WHERE email = '$email'");
    if ($check->num_rows > 0) {
        echo "<p style='color:red; text-align:center;'>Email already exists.</p>";
    } else {
        $conn->query("INSERT INTO users (username, email, password, user_type) VALUES ('$username', '$email', '$password', '$user_type')");
        echo "<p style='color:green; text-align:center;'>Registration successful. <a href='login.php'>Login here</a>.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up Page</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    body {
      background: linear-gradient(135deg, #74ebd5, #9face6);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .signup-container {
      background-color: white;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 400px;
    }

    .signup-container h2 {
      text-align: center;
      margin-bottom: 24px;
      color: #333;
    }

    .signup-container input[type="text"],
    .signup-container input[type="email"],
    .signup-container input[type="password"] {
      width: 100%;
      padding: 12px;
      margin: 8px 0 16px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    .signup-container input[type="submit"] {
      width: 100%;
      padding: 12px;
      background-color: #5c6bc0;
      border: none;
      border-radius: 8px;
      color: white;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .signup-container input[type="submit"]:hover {
      background-color: #3f51b5;
    }

    .signup-container .footer {
      text-align: center;
      margin-top: 16px;
      font-size: 14px;
      color: #666;
    }

    .signup-container .footer a {
      color: #5c6bc0;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="signup-container">
    <h2>Create Account</h2>
    <form method="POST" action="">
      <input type="text" name="username" placeholder="Username" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>

      <label><input type="radio" name="user_type" value="buyer" checked> Buyer</label>
      <label><input type="radio" name="user_type" value="seller"> Seller</label><br><br>

      <input type="submit" value="Register">
    </form>
    <div class="footer">
      Already have an account? <a href="login.php">Login</a>
    </div>
  </div>
</body>
</html>
