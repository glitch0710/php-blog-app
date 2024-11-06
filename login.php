<?php

session_start();
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pwd = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $result = $conn->execute_query($sql, [$email, md5($pwd)]);

    if ($result->num_rows >= 1) {
        $record = $result->fetch_assoc();
        $_SESSION["fullname"] = $record['fullname'];
        $_SESSION["email"] = $record['email'];
        $_SESSION["user_id"] = $record['user_id'];
        header('location: index.php');
    } else {
        echo "<script type='text/javascript'>alert('Invalid email and password combination. Please try again!');</script>";
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">My Blog App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4 main-content">
                <form action="" method="post">
                    <div class="text-center mb-5">
                        <h2>Login</h2>
                    </div>
                    <label class="m-2" for="email">Email:</label>
                    <input class="form-control" type="email" name="email" id="email">
                    <label class="m-2" for="email">Password:</label>
                    <input class="form-control" type="password" name="password" id="password">
                    <div class="mt-4 d-grid gap-2">
                        <button type="submit" class="btn btn-primary" name="loginButton">Login</button>
                    </div>
                    <div class="text-center mt-2">
                        <p>No account yet? <a href="register.php">Register here</a></p>
                    </div>
                </form>

            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace();
    </script>
</body>

</html>