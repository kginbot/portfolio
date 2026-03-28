<?php
session_start();

// Hardcoded credentials for learning purpose
$admin_user = "admin";
$admin_pass = "121212"; // In real life, use hashed passwords!

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $admin_user && $password === $admin_pass) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
    <style>
        body {
            background-image: url('cover.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: Poppins, sans-serif;
            /* background: #0f172a;*/
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background: #1e293b;
            padding: 30px;
            border-radius: 10px;
            width: 300px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: none;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            background: #38bdf8;
            color: black;
            font-weight: 600;
            cursor: pointer;
            border-radius: 5px;
        }

        .error {
            color: #ff8080;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <h2>Admin Login</h2>
        <?php if (isset($error)) {
            echo "<p class='error'>$error</p>";
        } ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>