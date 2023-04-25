
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoodTastic</title>
    
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.1/chart.min.js"></script> <!-- Include Chart.js library -->
 <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script> <!-- Include chartjs-plugin-datalabels library -->    
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
    
     <!-- main js script nav and you_page --> 
     <script src="../js/main.js" defer></script>
     
   
     
    <!--Custom Style Sheet-->     
    <link href="styles/styles.css" rel="stylesheet" type="text/css"/>
    <link href="../styles/styles.css" rel="stylesheet" type="text/css"/>
    
    <!--change the favicon image-->
    <link rel="icon" type="../images_thumbnail/png" href="Sun1.png">
   
    <base href="http://localhost/MoodTastic/">
    <!--FONTS-->
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,800&display=swap" rel="stylesheet">
    <!--ICONSCOUT CDN-->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
   
   

   
</head>
<body>

    <nav>
       <div class="container nav__container">
       <a href="#" class="nav__logo">MoodTastic</a>
     <ul class="nav__items">
    <li><a href="user_manager/?controllerRequest=user_show_posts_form">Posts</a></li>
    <?php if (isset($_SESSION['user_id'])) : ?>
        <li><a href="user_manager/?controllerRequest=user_show_user_you_form">My Mood</a></li>
        <li class="nav__profile">
            <div class="avatar">           
                <img src="../images/<?php echo $_SESSION['avatar']; ?>">
            </div>
            <ul>
                <li><a href="admin/?controllerRequest=show_user_posts">Dashboard</a></li>
                <li><a href="user_manager/?controllerRequest=user_logout">Logout</a></li>
            </ul>
        </li>
    <?php else : ?>
        <li><a href="user_manager/?controllerRequest=user_show_login_form">Login</a></li>
    <?php endif ?>
</ul>

        <button id="open__nav-btn"><i class="uil uil-moon-eclipse"></i></button>
        <button id="close__nav-btn"><i class="uil uil-moon"></i></button>
       </div> 
    
    </nav>
    <!--END OF NAV=============================-->
   
   
    
    


