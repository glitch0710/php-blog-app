<?php
session_start();
include "../connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post = $_POST['post'];

    $sql = "INSERT INTO posts (post, date_created, user_id, likes) VALUES (?,?,?,?)";
    if ($conn->execute_query($sql, [$post, date("Y-m-d H:i:s"), $_SESSION["user_id"], 0])) {
        echo "<script type='text/javascript'>alert('Posted successfully!');</script>";
        header('location: ../index.php');
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>