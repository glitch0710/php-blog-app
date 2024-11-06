<?php
session_start();
include "../connection.php";

$post_id = $_GET['postid'];

$sql = "UPDATE posts SET likes = likes + 1 WHERE post_id = ?";
if ($conn->execute_query($sql, [$post_id])) {
    echo "<script type='text/javascript'>alert('Liked successfully!');</script>";
    header('location: ../postdetails.php?postid='.$post_id);
}else{
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>