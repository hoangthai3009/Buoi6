<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("db.class.php");

    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = new Db();
    $connection = $db->connect();

    $sql = "SELECT * FROM user WHERE username='$username'";
    $result = $connection->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($password == $row['password']) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];
            header("location: index.php");
            exit();
        } else {
            echo "Sai tên đăng nhập hoặc mật khẩu.";
        }
    } else {
        echo "Sai tên đăng nhập hoặc mật khẩu.";
    }

    $connection->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {

            color: #333;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center">Login Form</h2>
    <form action="login.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
</body>

</html>