<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: q1.php");
    exit();
}

$host = "localhost";
$user = "root";
$pass = "";
$db = "quiz_db";
$conn = new mysqli($host, $user, $pass, $db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $username = htmlspecialchars($_POST['user']);
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($userId);

    if ($stmt->fetch()) {
        $_SESSION['user_id'] = $userId;
        $_SESSION['username'] = $username;
        header("Location: q1.php");
        exit();
    } else {
        $error = "Invalid username.";
    }

    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colorful Login</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: rgb(249, 224, 250);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 350px;
            max-width: 90%;
            text-align: center;
            border: 2px solid #7d4caf;
        }
        .login-container h2 {
            color: rgb(176, 25, 210);
            margin-bottom: 30px;
            font-size: 2.5em;
        }
        .login-container label {
            display: block;
            margin-bottom: 10px;
            color: #555;
            text-align: left;
            font-weight: bold;
        }
        .login-container input {
            width: calc(100% - 24px);
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 1em;
        }
        .login-container input:focus {
            border-color: rgb(255, 168, 232);
            outline: none;
            box-shadow: 0 0 8px rgba(63, 169, 245, 0.5);
        }
        .login-container input#username {
            border-left: 5px solid #7d4caf;
        }
        .login-container input#submit {
            background-color: #7d4caf;
            color: white;
            padding: 12px 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1em;
            width: 100%;
            transition: background-color 0.3s ease;
        }
        .login-container input#submit:hover {
            background-color: rgb(226, 177, 255);
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<div class="login-container">
    <h2>Login</h2>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form action="login.php" method="post">
        <label for="username">Enter your username</label>
        <input type="text" id="username" name="user" placeholder="Your Username" required>
        <input type="submit" value="Login Now" name="submit" id="submit">
    </form>
</div>
</body>
</html>
