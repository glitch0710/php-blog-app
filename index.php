<?php include "layouts/header.php"; ?>
<?php include "connection.php"; ?>

<?php
if (isset($_GET['q'])) {
    $sql = "SELECT * FROM posts INNER JOIN users ON posts.user_id = users.user_id WHERE fullname LIKE ? ORDER BY date_created DESC";
    $result = $conn->execute_query($sql, ["%".$_GET['q']."%"]);
} else {
    $sql = "SELECT * FROM posts INNER JOIN users ON posts.user_id = users.user_id ORDER BY date_created DESC";
    $result = $conn->query($sql);
}


?>

<div class="container">
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8 main-content">
            <h2>Latest Posts</h2>
            <hr>
            <?php
            if ($result !== false && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $sql = "SELECT COUNT(*) AS comment_count FROM posts RIGHT JOIN post_details ON posts.post_id = post_details.post_id WHERE posts.post_id = " . $row['post_id'] . ";";
                    $result_count = $conn->query($sql);
                    $record = $result_count->fetch_assoc();
            ?>
                    <div class="card" style="margin-bottom: 10px;">
                        <div class="card-body">
                            <div class="d-flex justify-content-start">
                                <img class="prof-pic" src="img/blank.jpg" alt="profile picture">
                                <p class="card-title"><strong><?php echo $row['fullname'] ?></strong></p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="card-subtitle mb-2 text-body-secondary subtitle"><?php echo $row['date_created'] ?></h6>
                                <a href="postdetails.php?postid=<?php echo $row['post_id'] ?>" class="card-link stretched-link subtitle">See more</a>
                            </div>
                            <p class="card-text" style="text-align: justify;"><?php echo $row['post'] ?></p>
                            <div class="d-flex">
                                <p class="p-2 engagement-text small"><i data-feather="thumbs-up"></i> <?php echo $row['likes'] ?></p>
                                <p class="p-2 flex-grow-1 engagement-text small"><i data-feather="message-circle"></i> <?php echo $record['comment_count'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <p> There's no posts in here.</p>
                </div>
            <?php
            }
            ?>

        </div>
        <div class="col-sm-2"></div>
    </div>
</div>

<?php include "layouts/footer.php"; ?>