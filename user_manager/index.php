<?php

require_once '../model/Blog_Database.php';
require_once '../model/UserDB.php';
require_once '../model/User.php';

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
    case 'user_show_login_form':
        //just takes you to the login form
        header('Location: ' . ROOT_URL . 'user_manager/user_login_form.php');
        break;
    //login form
    case 'user_process_login':
    //get the form data
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);

    //validate input
    if (!$username_email) {
        $_SESSION['login_error'] = "Username or Email required";
    } elseif (!$password) {
        $_SESSION['login_error'] = "Password required";
    } else {
        $user = UserDB::getUserByUsernameOrEmailAndPassword($username_email, $password);
        $ID = $user['ID'];
        if ($ID > 0) {
            $user = UserDB::getUserByID($ID);  
            $_SESSION['user_id'] = $user->getID();
            $_SESSION['username'] = $user->getUserName();
            $_SESSION['email'] = $user->getEmail();
            $_SESSION['is_admin'] = $user->getAdmin();
            if ($user ->getAdmin() == 1) {
                header('Location: ' . ROOT_URL . 'admin/manage_post.php');
            } else {
                header('Location: ' . ROOT_URL . 'user_manager/user_you_form.php');
            }
            exit;
        } else {
            $_SESSION['login_error'] = "Invalid username/email or password";
        }
    }
    break;
    case'user_register_form':
        include('user_register_form.php');
        break;
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
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = '../images/' . $avatar_name;

                //5.Make sure the file is an img & check size
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extention = explode('.', $avatar_name);
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
            $userId = UserDB::registerUser($firstName, $lastName, $userName, $email, $password, $avatar);
            //redirect to login page with success mssge
            $_SESSION['signup-success'] = "Registration success, Please login";
            header('location: ' . ROOT_URL . 'user_manager/user_login_form.php');
            die();
        }
        break;
        
        
        
        
        
        
        case'user_show_blog_form':
        include('user_blog_form.php');
        break;
        case'blog_form':
        //get all the data from the form   
        break;
    
    
    
         case'user_show_user_you_form':
        include('user_you_form.php');
        break;
        case'#':
        //get all the data from the form   
        break;
        
        
}