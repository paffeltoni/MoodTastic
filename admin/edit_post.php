<?php include '../view/header.php';?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit Post</h2>
        
         <form action="admin/index.php" method="post">
                <input type="hidden" name="controllerRequest" value="edit_post">
                <input type="hidden" name="ID" readonly=true value="<?php echo $post->getID(); ?>">   
                
                <input type="text"  name="title" value="<?php echo $post->getTitle(); ?>" >
               <textarea name="body" value="<?php echo $post->getBody(); ?>" rows="5" cols="10"></textarea>
               
               
            <button type="submit" name="submit" class="btn">Update Post</button>
        </form>
    </div>
</section>


<?php include '../view/footer.php'; ?>

