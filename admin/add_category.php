<?php include'../view/header.php'; 
 session_start();
?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Category</h2>
        
        <?php if(isset($_SESSION['add_category_error'])): ?>
        <div class="alert__message error">
            <p>
                <?= $_SESSION['add_category_error'];
                unset($_SESSION['add_category_error']);?>
            </p>
        </div>   
        <?php endif ?>
        
       <form action="admin/index.php" enctype="multipart/form-data" method="POST" >
            <input type="hidden" name="controllerRequest" value="add_category">  
            
            <input type="text" name="title" placeholder="Title">    
            <textarea rows="4" name="description" placeholder="Description"></textarea>            
            <button type="submit" class="btn">Add Category</button>
            
        </form>
    </div>
</section>
<!--======================================END OF CATEGORY================-->

<?php include'../view/footer.php'; ?>

