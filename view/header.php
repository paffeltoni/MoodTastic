
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoodTastic</title>
    <!--Custom Style Sheet-->
    <link href="styles/styles.css" rel="stylesheet" type="text/css"/>
    <link href="../styles/styles.css" rel="stylesheet" type="text/css"/>
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
            
            
            <li><a href="user_manager/?controllerRequest=user_show_blog_form">Blog</a></li>
            <li><a href="user_manager/?controllerRequest=user_show_user_you_form">You Page</a></li>
            <li><a href="extra_page.php">XtraPage</a></li>
            <li><a href="user_manager/?controllerRequest=user_show_login_form">Login</a></li>
            
            <li class="nav__profile">
                <div class="avatar">
               <!--add avatar in here-->
                </div>
                <ul>
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Log Out</a></li>
                </ul>
            </li>
            
            
            
        </ul>
        <button id="open__nav-btn"><i class="uil uil-moon-eclipse"></i></button>
        <button id="close__nav-btn"><i class="uil uil-moon"></i></button>
       </div> 
    </nav>
    <!--END OF NAV=============================-->
   
   
    
    


