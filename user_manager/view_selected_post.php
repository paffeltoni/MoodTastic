<?php include '../view/header.php'; ?>

<section class="singlepost">
    <div class="container singlepost__container">
        <h2><?= $selected_post->getTitle() ?></h2>
        <div class="post__author">
            <div class="post__author-avatar">
                <img src="./images/<?= $author->getAvatar() ?>">
            </div>
            <div class="post__author-info">
                <h5>By: <?php echo $author->getUserName(); ?></h5>
                <small>
                    <?= date("M d, Y - H:i", strtotime($selected_post->getDate_Time())) ?>
                </small>
            </div>
        </div>
        <div class="post__thumbnail">
            <img src="./images_thumbnail/<?= $selected_post->getThumbnail() ?>">
        </div>
        <p><?= $selected_post->getBody() ?></p>
        
        <div class="comments__list">
            <h1>Other peoples thoughts</h1>
                <div class="comment">
                    <h5>Name of User</h5>
                    <small>date of comment</small>
                    <p>Users comment here</p>
                </div>
        </div>
        
        
    </div>  
</section>

<section class="comments">
    <div class="container comments__container">
        <div class="comments__box">
            <h3>What are your thoughts?</h3>
            <form action="post_comment.php" method="POST">
                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea id="comment" name="comment" required></textarea>
                </div>
                <input type="hidden" name="post_id" value="<?= $selected_post->getId() ?>">
                <button type="submit" class="btn">Submit Comment</button>
            </form>
        </div>
    </div>
</section>

<?php include '../view/footer.php'; ?>
