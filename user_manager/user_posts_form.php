<?php include '../view/header.php'; ?>
 <div class="background_floating_orbs">    
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
        </div>  
 

<!--====================== Featured Post ====================-->
 <?php if (isset($_SESSION['is_featured_post'])) { ?>
    <section class="featured">
        <div class="container featured__container post">
          <div class="post__thumbnail">
           <img src="<?php echo ROOT_URL . 'images_thumbnail/' . $_SESSION['is_featured_post']->getThumbnail(); ?>">
         </div>

            <div class="post__info">
                <a href="user_blog_form.php" class="category__button"><?php echo $category_name ?></a>
                <h2 class="post__title"><a href="user_manager/?controllerRequest=show_a_single_post"><?php echo $_SESSION['is_featured_post']->getTitle(); ?></a></h2>
                <p class="post__body"><?php echo substr($_SESSION['is_featured_post']->getBody(), 0, 300); ?> ... continue reading click on title....</p>
                <div class="post__author">
                    <div class="post__author-avatar">
                        <img src="./Images/avatar2.jpg">
                    </div>
                    <div class="post__author-info">
                        <h5>By: <?php echo $userName ?></h5>
                        <small><?php echo $_SESSION['is_featured_post']->getDate_time(); ?></small>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

 <!--END OF FEATURED =============================-->

 <!-- Display all the other posts -->
<div class="container posts__container">
    <?php foreach ($posts as $post) { ?>
        <article class="post">
            <div class="post__thumbnail">
                <img src="<?php echo ROOT_URL . 'images_thumbnail/' . $post->getThumbnail(); ?>">
            </div>
            <div class="post__info">
                <a href="category_posts.php" class="category__button"><?php echo $_SESSION['category_names'][$post->getId()]; ?></a>
                     <h3 class="post__title">
                    <a href="user_manager/?controllerRequest=show_a_single_post">
                        <?php echo $post->getTitle(); ?>
                    </a>
                    <input type="hidden" name="post_id" value="<?php echo $post->getID(); ?>">
                </h3>
                <p class="post__body"><?php echo substr($post->getBody(), 0, 300); ?> ... continue reading click on title....</p>
                <div class="post__author">
                    <div class="post__author-avatar">
                        <img src="">
                    </div>
                    <div class="post__author-info">
                        <h5>By: <?php echo $userName ?></h5>
                        <small><?php echo $post->getDate_time(); ?></small>
                    </div>
                </div>
            </div>
        </article>
    <?php } ?>
</div>

    
 <!--======================================END OF POSTS====================-->

    <section class="category__buttons">
        <div class="container category__buttons-container">
            <a href="" class="category__button">Positive Thinking</a></a>
            <a href="" class="category__button">Perspective</a>
            <a href="" class="category__button">Inspiration</a>
            <a href="" class="category__button">Reflection</a>
            <a href="" class="category__button">Health</a>
            <a href="" class="category__button">Changing Habits</a>     
        </div>
    </section>

 <!--======================================END OF CATEGORIES================-->
 </div>
 



<?php include '../view/footer.php'; ?>