<?php include'../view/header.php'; ?>

<section class="singlepost">
    <div class="container singlepost__container">
        <h2><?= $selected_post->getTitle() ?></h2>
        <div class="post__author">
            <div class="post__author-avatar">
                <img src="#">
            </div>
            <div class="post__author-info">
                <h5>By: <?=$selected_post->getTitle() ?></h5>
                <small>
                    <?= date("M d, Y - H:i", strtotime($selected_post->getDateTime())) ?>
                </small>
            </div>
        </div>
        <div class="singlepost__thumbnail">
            <img src="./images/<?= $selected_post->getThumbnail() ?>">
        </div>
        <p>
            <?= $selected_post->getBody() ?>
        </p>
    </div>
</section>



    
<?php include'../view/footer.php'; ?>

