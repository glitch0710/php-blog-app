<?php include "layouts/header.php"; ?>
<?php include "connection.php"; ?>

<?php
$post_id = $_GET['postid'];
$sql = "SELECT * FROM posts WHERE post_id = ?";
$result = $conn->execute_query($sql, [$post_id]);
$record = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post = $_POST['post'];
    $sql = "UPDATE posts SET post = ? WHERE post_id = ?";
    if ($conn->execute_query($sql, [$post, $post_id])) {
        header('location: postdetails.php?postid='.$post_id);
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<div class="container">
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8 main-content">
            <form action="" method="post">
                <h2>Edit Post</h2>
                <hr>
                <textarea class="form-control" name="post" id="post" placeholder="What's on your mind?" rows="10"><?php echo $record['post'] ?></textarea>
                <div class="d-flex justify-content-between" style="margin-top: 10px;">
                    <a class="btn btn-danger" href="postdetails.php?postid=<?php echo $post_id; ?>">Discard</a>
                    <button class="btn btn-primary" type="submit" name="submitpost" id="submitpost"><i data-feather="file-text"></i> Save</button>
                </div>
            </form>
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>

<?php include "layouts/footer.php"; ?>