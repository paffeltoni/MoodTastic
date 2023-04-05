<?php include '../view/header.php';?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit Category</h2>
        
         <form action="admin/index.php" method="post">
                <input type="hidden" name="controllerRequest" value="admin_edit_category">
                <input type="hidden" name="ID" readonly=true value="<?php echo $category->getID(); ?>">      
             <input type="text"  name="title" value="<?php echo $category->getTitle(); ?>" >
             <textarea name="description" value="<?php echo $category->getDescription(); ?>" rows="5" cols="10"></textarea>
            <button type="submit" name="submit" class="btn">Update Category</button>
        </form>
    </div>
</section>


<?php include '../view/footer.php'; ?>

