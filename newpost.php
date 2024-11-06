<?php include "layouts/header.php"; ?>

<div class="container">
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8 main-content">
            <form action="actions/savenewpost.php" method="post">
                <h2>Add new post</h2>
                <hr>
                <textarea class="form-control" name="post" id="post" placeholder="What's on your mind?" rows="10"></textarea>
                <div class="d-flex justify-content-between" style="margin-top: 10px;">
                    <a class="btn btn-danger" href="index.php">Discard</a>
                    <button class="btn btn-primary" type="submit" name="submitpost" id="submitpost"><i data-feather="file-text"></i> Post</button>
                </div>
            </form>
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>

<?php include "layouts/footer.php"; ?>