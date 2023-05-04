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

       <?php if (!is_null($comments)) { ?>
    <div class="comments__list">
         <div class="container comments__container">
        <div class="comments__box">
        <h3>What others are thinking about this post.... </h3>
        <?php foreach ($comments as $comment) {
            // Get the commenter's information using the getUsernameAndAvatar() method
            $commenter = CommentDB::getUsernameAndAvatar($comment->getUser_ID());
            // Get the commenter's username and avatar
            $comment_user_name = $commenter->username;
            $comment_user_avatar = $commenter->avatar;
        ?>
            <div class="comment">
                <p><div class="post__author-avatar">
                    <img src="./images/<?= $comment_user_avatar ?>">
                </div><?php echo $comment->getComment(); ?> ~~~~  <?php echo $comment_user_name; ?></p>              
            </div>
        <?php } ?>
    </div>
<?php } else { ?>
    <p>No comments found.</p>
<?php } ?>
         </div>
    </div>

            
            
   <div class="comments comments__list">
    <div class="container comments__container">
        <div class="comments__box">
            <h3>What are your thoughts? </h3>
            
               <?php if(isset($_SESSION['comment_error_message'])): ?>
            <div class="alert__message error">
            <p> <?= $_SESSION['comment_error_message'];
            unset($_SESSION['comment_error_message']);?>
            </p>     
            </div>
        <?php endif ?>
            
            <form action="user_manager/index.php?controllerRequest=user_comment" method="POST">
                <input type="hidden" name="post_ID" value="<?php echo $_SESSION['selected_post_id'] ?>"
                       <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea rows="3" name="comment" placeholder="Comment" required></textarea>                   
        </div>
        <button type="submit" class="btn" style="margin-top: 1rem; margin-bottom: 1rem;">Submit Comment</button>
        </form>
    </div>
</div>


    </div>  
</section>


<?php include '../view/footer.php'; ?>
