<?php include'../view/header.php';?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Post</h2>
        
        
         <?php if(isset($_SESSION['add-post-error'])) : ?>
            <div class="alert__message error">
            <p>
            <?=
             $_SESSION['add-post-error'];
             unset($_SESSION['add-post-error']);
             ?>
            </p>
        </div>
        <?php endif; ?>
        
      
        <form action="admin/index.php" enctype="multipart/form-data" method="post" >   
            <input type="hidden" name="controllerRequest" value="add_post">
            
            <input type="text" name="title" placeholder="Title">  

            <select name="category">
                    <?php foreach ($categories as $category) { ?>
                    <option value="<?php echo $category->getID(); ?>">
                    <?php echo $category->getTitle(); ?>
                    </option>
                    <?php } ?>
            </select>


            <textarea rows="10" name="body" placeholder="Body"></textarea>   
            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) { ?>
            <div class="form__control inline">
                <input type="checkbox" id="is_featured" name="isFeatured" value="1" checked>
                <label for="is_featured">Featured</label>
            </div> 
            <?php } ?>
            <div class="form__control">
                <label for="thumbnail">Add Thumbnail</label>
                <input type="file" id="thumbnail" name="thumbnail">
            </div>    

            <button type="submit" class="btn">Add Post</button>
        </form>
    </div>
</section>

<?php include'../view/footer.php'; ?>


