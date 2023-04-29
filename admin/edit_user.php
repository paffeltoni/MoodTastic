<?php include '../view/header.php';?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit User</h2>
      <?php if(isset($_SESSION['edit_user_error'])) : ?>
            <div class="alert__message error">
            <p>
            <?=
             $_SESSION['edit_user_error'];
             unset($_SESSION['edit_user_error']);
             ?>
            </p>
        </div>
        <?php endif; ?>
        
         <form action="admin/index.php" method="post">
                <input type="hidden" name="controllerRequest" value="admin_edit_user">
                <input type="hidden" name="ID" readonly=true value="<?php echo $user->getID(); ?>">
                
                
            <input type="text"  name="firstName" value="<?php echo $user->getFirstName(); ?>" >
            <input type="text"  name="lastName" value="<?php echo $user->getLastName(); ?>" >
            <input type="text"  name="email" value="<?php echo $user->getEmail(); ?>" >
            
            <select name="userRole">
                <option value="0">User</option>
                <option value="1">Admin</option>
            </select>
            
            <button type="submit" name="submit" class="btn">Update User</button>
            
            
        </form>
    </div>
</section>

<?php include '../view/footer.php'; ?>

