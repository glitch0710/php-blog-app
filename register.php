<?php
session_start();
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $pwd = $_POST['password'];
    $confirmpwd = $_POST['confirmpassword'];

    if ($pwd != $confirmpwd) {
        echo "<script type='text/javascript'>alert('Passwords do not match!');</script>";
    } else {
        $sql = "SELECT * FROM users WHERE email = ?";
        $result_count = $conn->execute_query($sql, [$email]);

        if ($result_count->num_rows > 0) {
            echo "<script type='text/javascript'>alert('Email already registered.');</script>";
        } else {
            $sql = "INSERT INTO users (fullname, email, password) VALUES (?,?,?)";
            if ($conn->execute_query($sql, [$fullname, $email, md5($pwd)])) {
                header('location: login.php');
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
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
                        <h2>Register</h2>
                    </div>
                    <label class="m-2" for="email">Email:</label>
                    <input class="form-control" type="email" name="email" id="email">

                    <label class="m-2" for="fullname">Fullname:</label>
                    <input class="form-control" type="text" name="fullname" id="fullname">

                    <label class="m-2" for="password">Password:</label>
                    <input class="form-control" type="password" name="password" id="password">

                    <label class="m-2" for="confirmpassword">Confirm Password:</label>
                    <input class="form-control" type="password" name="confirmpassword" id="confirmpassword">

                    <div class="mt-4 d-grid gap-2">
                        <button type="submit" class="btn btn-primary" name="loginButton">Register</button>
                    </div>
                    <div class="text-center mt-2">
                        <p>Already have an account? <a href="login.php">Login here</a></p>
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