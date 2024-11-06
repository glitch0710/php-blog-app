<?php include "layouts/header.php"; ?>
<?php include "connection.php"; ?>

<?php

$sql = "SELECT * FROM posts INNER JOIN users ON posts.user_id = users.user_id WHERE post_id = ?";
$result = $conn->execute_query($sql, [$_GET['postid']]);
$record = $result->fetch_assoc();

$sql = "SELECT * FROM post_details INNER JOIN users ON post_details.user_id = users.user_id WHERE post_id = ? ORDER BY date_created DESC";
$result_comments = $conn->execute_query($sql, [$_GET['postid']]);

?>

<div class="container">
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8 main-content">
            <div class="d-flex">
                <h2 class="p-2 flex-grow-1"><?php echo $record['fullname'] ?></h2>
                <?php if ($_SESSION['user_id'] == $record['user_id']) {
                ?>
                    <a href="editpost.php?postid=<?php echo $record['post_id'] ?>" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover p-2 btn-sm"><i data-feather="edit"></i> Edit</a>
                    <a href="deletepost.php?postid=<?php echo $record['post_id'] ?>" class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover p-2 btn-sm"><i data-feather="trash"></i> Delete</a>
                <?php
                }
                ?>
            </div>

            <hr>
            <p class="subtitle-details"><?php echo $record['date_created'] ?></p>
            <div class="post-content">
                <p><?php echo $record['post'] ?></p>
            </div>
            <div>
                <a class="btn btn-outline-primary btn-sm" href="actions/savelike.php?postid=<?php echo $record['post_id'] ?>"><i data-feather="thumbs-up"></i> Like</a> <span class="engagement-text"><?php echo $record['likes'] ?> likes</span>
            </div>
            <hr>
            <h5>Comments</h5>
            <form action="actions/savecomment.php" method="post">
                <div class="d-flex">
                    <textarea class="form-control" placeholder="Add your comment here..." type="text" name="add_comment" id="add_comment"></textarea>
                    <input type="hidden" name="postid" value="<?php echo $_GET['postid'] ?>">
                    <button type="submit" class="btn btn-outline-primary">Post</button>
                </div>
            </form>
            <div class="comments-section">
                <div class="container mt-5">
                    <?php

                    if ($result_comments !== false && $result_comments->num_rows > 0) {
                        while ($row = $result_comments->fetch_assoc()) {

                    ?>
                            <div class="card" style="margin-bottom: 10px;">
                                <div class="card-body d-flex">
                                    <img src="img/blank.jpg" alt="User Image" class="rounded-circle mr-3" style="width: 50px; height: 50px;">
                                    <div>
                                        <h6 class="mb-1 font-weight-bold"><?php echo $row['fullname'] ?></h6>
                                        <p class="mb-2 text-muted"><small><?php echo $row['date_created'] ?></small></p>
                                        <p class="mb-0"><?php echo $row['comment'] ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php

                        }
                    } else {
                        ?>
                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                            <p> There's no comments in here. Be the first to comment.</p>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>

<?php include "layouts/footer.php"; ?>