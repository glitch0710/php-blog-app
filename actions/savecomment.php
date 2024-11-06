<?php
    session_start();
    include "../connection.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $comment = $_POST['add_comment'];
        $post_id = $_POST['postid'];

        $sql = "INSERT INTO post_details (post_id, comment, date_created, user_id) VALUES (?,?,?,?)";
        if ($conn->execute_query($sql, [$post_id, $comment, date("Y-m-d H:i:s"), $_SESSION['user_id']])) {
            echo "<script type='text/javascript'>alert('Posted successfully!');</script>";
            header('location: ../postdetails.php?postid='.$post_id);
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

?>