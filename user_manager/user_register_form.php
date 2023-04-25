<!--no header on this page, doesn't need a nav menu-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoodTastic</title>
    
    <!--Custom Style Sheet-->
    <link href="../styles/styles.css" rel="stylesheet" type="text/css"/>
    
     <!--FONTS--> 
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,800&display=swap" rel="stylesheet">
    
    <!--ICONSCOUT CDN-->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>
<body>


    <section class="form__section">
    <div class="container form__section-container">
        <h2>Sign Up</h2>    
        
          <?php if(isset($_SESSION['registration_error'])): ?>
            <div class="alert__message error">
            <p> <?= $_SESSION['registration_error'];
            unset($_SESSION['registration_error']);?>
            </p>     
            </div>
        <?php endif ?>
       
        <form action="index.php" enctype="multipart/form-data" method="POST" >
            <input type="hidden" name="controllerRequest" value="user_registration">
            
            <input type="text" name="firstName" value="" placeholder="First Name">
            <input type="text" name="lastName" value="" placeholder="Last Name">
            <input type="text" name="userName" value="" placeholder="Username">
            <input type="email" name="email" value="" placeholder="Email">
            <input type="password" name="password" value="" placeholder="Create Password">
            <input type="password" name="confirmPassword" value="" placeholder="Confirm Password">
            <div class="form__control">
                <label for="avatar">User Avatar</label>
                <input type="file" name="avatar" id="avatar">
            </div>
            <button type="submit" name="submit" class="btn">Sign Up</button>                       
            <small>Already have an account? <a href="user_login_form.php">Sign In</a></small>
        </form>
    </div>
</section>

</body>
</html>
