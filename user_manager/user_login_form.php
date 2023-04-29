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
        <h2>Sign In</h2>

       <?php if(isset($_SESSION['signup-success'])): ?>
        <div class="alert__message success">
            <p>
                <?= $_SESSION['signup-success'];
                unset($_SESSION['signup-success']); ?>  
            </p>
        </div>
        <?php elseif(isset($_SESSION['login_error'])) : ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION['login_error'];
                    unset($_SESSION['login_error']);
                    ?>
                </p>
            </div>
        <?php endif ?>

         <form action="index.php" method="post">
            <input type="hidden" name="controllerRequest" value="user_process_login">   
            <input type="text" name="email" value="savvy@email.com" placeholder="Email">           
            <input type="text" name="password" value="pass1234" placeholder="Password">       
            <button type="submit" name="submit" class="btn">Sign In</button>
            <small>Don't have an account? <a href="user_register_form.php">Sign Up</a></small>
        </form>
    </div>
</section>


</body>
</html>

