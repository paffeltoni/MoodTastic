<?php 
include'../view/header.php'; 
session_start();
?>
 

<section class="form__section">
    <div class="container form__section-container">
        <h2>Add User</h2>
        
        
        <?php if(isset($_SESSION['admin_add_user_error'])) : ?>
            <div class="alert__message error">
            <p>
            <?=
             $_SESSION['admin_add_user_error'];
             unset($_SESSION['admin_add_user_error']);
             ?>
            </p>
        </div>
        <?php endif; ?>
        
        
        <form action="admin/index.php" enctype="multipart/form-data" method="POST" >
            <input type="hidden" name="controllerRequest" value="add_user">
            
            <input type="text" name="firstName" placeholder="First Name">
            <input type="text" name="lastName" placeholder="Last Name">
            <input type="text" name="userName" placeholder="Username">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Create Password">
            <input type="password" name="confirmPassword" placeholder="Confirm Password">
            
            <select name="userRole">
                <option value="0">User</option>
                <option value="1">Admin</option>
            </select> 
            
            <div class="form__control">
                <label for="avatar">Add Avatar</label>
                <input type="file" name="avatar" id="avatar">
            </div>         
           <button type="submit" name="submit" class="btn">Add User</button>
        </form>
    </div>
</section>
<!--======================================END OF CATEGORY================-->



<?php include'../veiw/footer.php'; ?>
