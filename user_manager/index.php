<?php

require_once '../model/Blog_Database.php';
require_once '../model/UserDB.php';
require_once '../model/User.php';
require_once '../model/Post.php';
require_once '../model/PostDB.php';
require_once '../model/Category.php';
require_once '../model/CategoryDB.php';

session_start();

//Constant used to direct in headers
define('ROOT_URL', 'http://localhost//MoodTastic/');
//To use: header('Location: ' . ROOT_URL . 'folder/your_page.php');

$controllerChoice = filter_input(INPUT_POST, 'controllerRequest');
if ($controllerChoice == NULL) {
    $controllerChoice = filter_input(INPUT_GET, 'controllerRequest');
    if ($controllerChoice == NULL) {
        $controllerChoice = 'Not set = null';
    }
}
//go through user pages 
switch ($controllerChoice) {


    //****************************************
    //Show User Login Form
    //****************************************
    case 'user_show_login_form':
        //just takes you to the login form
        header('Location: ' . ROOT_URL . 'user_manager/user_login_form.php');
        break;
    //****************************************
    // Login User
    //****************************************
    case 'user_process_login':
        //get the form data
        $email = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);

        //validate input
        if ($email == null) {
            $_SESSION['login_error'] = "Email required";
        } elseif ($password == null) {
            $_SESSION['login_error'] = "Password required";
        } else {
            $user = UserDB::getUserByUsernameOrEmailAndPassword($email, $password);
            $ID = $user['ID'];
            if ($ID > 0) {
                $user = UserDB::getUserByID($ID);
                $_SESSION['user_id'] = $user->getID();
                $_SESSION['username'] = $user->getUserName();
                $_SESSION['email'] = $user->getEmail();
                $_SESSION['is_admin'] = $user->getAdmin();
                $_SESSION['avatar'] = $user->getAvatar();
                if ($user->getAdmin() == 1) {
                    //Move them to the dashboard
                     header('Location: ' . ROOT_URL . 'admin/index.php?controllerRequest=show_user_posts');
                } else {
                    // I am leaving this statement here for later on if I decide to change where the user goes when logging in 
                    header('Location: ' . ROOT_URL . 'admin/index.php?controllerRequest=show_user_posts');
                }
                exit;
            }     
         break;
        }
     
       
    //****************************************
    // Show Register Form
    //****************************************
    case'user_register_form':
        include('user_register_form.php');
        break;
    //****************************************
    // Register Form
    //****************************************
    case'user_registration':
        //get data from form 
        $firstName = filter_input(INPUT_POST, "firstName", FILTER_SANITIZE_SPECIAL_CHARS);
        $lastName = filter_input(INPUT_POST, "lastName", FILTER_SANITIZE_SPECIAL_CHARS);
        $userName = filter_input(INPUT_POST, "userName", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_SPECIAL_CHARS);
        $avatar = $_FILES['avatar'];

        //validate inputs - I am leaving out the avatar just in case no pic also I am going to use a session for this to throw the error mssgs 
        if (!$firstName) {
            $_SESSION['registration_error'] = "Please enter First Name";
        } else if (!$lastName) {
            $_SESSION['registration_error'] = "Please enter Last Name";
        } else if (!$userName) {
            $_SESSION['registration_error'] = "Please enter User Name";
        } else if (!$email) {
            $_SESSION['registration_error'] = "Please enter Email";
        } elseif (strlen($password) < 8 || strlen($confirmPassword) < 8) {
            $_SESSION['registration_error'] = "Password should be 8+ characters";
        } elseif ($password != $confirmPassword) {
            $_SESSION['registration_error'] = "Passwords do not match!";
        } else {
            //if they do hash them
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            //create a method in the UserDB to check if username or email already exists in the database
            $user = UserDB::findUserByEmailAndPassword($email, $password);
            if ($user < 0) {
                $_SESSION['registration_error'] = "Username or Email is already in use";
            } else {
               //1. Check the avatar
                    //2. Rename the avatar
                    //3. Make each image unique using current timestamp
                    $time = time();
                    //4. Rename the avatar
                    $avatar_name = $time . '.png';
                    $avatar_tmp_name = $avatar['tmp_name'];
                    $avatar_destination_path = '../images/' . $avatar_name;

                    //5.Make sure the file is an img & check size
                    $allowed_files = ['png', 'jpg', 'jpeg'];
                    $extention = explode('.', $avatar['name']);
                    $extention = end($extention);

                    if (in_array($extention, $allowed_files)) {
                        //make sure the file size is not to large(1mb)
                        if ($avatar['size'] < 1000000) {
                            //upload the avatar
                            move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                        } else {
                            $avatar = "File size is to big. Should be less than 1mb";
                        }
                    } else {
                        $_SESSION['registration_error'] = "File should be png, jpg, jpeg";
                    }
                }

                //insert the new user into the database
                $userId = UserDB::registerUser($firstName, $lastName, $userName, $email, $password, $avatar_destination_path);
            
            //redirect to login page with success mssge
            $_SESSION['signup-success'] = "Registration success, Please login";
            header('location: ' . ROOT_URL . 'user_manager/user_login_form.php');
            die();
        }
        
        break;

    //****************************************
    // Showing the posts / blogs 
    //****************************************
    case'user_show_posts_form':
       // Get the featured post
        $featuredPost = PostDB::getFeaturedPost();
        // Pass the featured post to the view
        $_SESSION['is_featured_post'] = $featuredPost;
        
        //Get the category from the categories table using the category  id from the post
        $category_id = $_SESSION['is_featured_post']->getCategoryID();
        $category_name = CategoryDB::getCategoryName($category_id);
        
        //Get the authors name 
        $author_id = $_SESSION['is_featured_post']->getAuthorID();
        $userName = PostDB::getAuthorsUsername($author_id);

        //Get the rest of the posts
        $posts = PostDB::getAllPosts();
        //Pass the posts to the view
        $_SESSION['all_posts'] = $posts;
        //get the category name for all of the posts
         
        include 'user_posts_form.php';
        break;
    
    //****************************************
    // Show User Page
    //****************************************
    case'user_show_user_you_form':
        include('user_you_form.php');
        break;
    
      //****************************************
    // BLANK
    //****************************************
    case'#':
        include('form.php');
        break;
    
      //****************************************
    // BLANK
    //****************************************
    case'#':
        include('form.php');
        break;
   
}