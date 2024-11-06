<?php

include "connection.php";

$post_id = $_GET['postid'];

$sql = "DELETE FROM posts WHERE post_id = ?";
if ($conn->execute_query($sql, [$post_id])) {
    header('location: index.php');
}else{
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>