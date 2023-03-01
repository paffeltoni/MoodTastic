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


//go through forms for admin 
switch ($controllerChoice) {
    case 'add_user':
         //get data from form 
        $firstName = filter_input(INPUT_POST, "firstName", FILTER_SANITIZE_SPECIAL_CHARS);
        $lastName = filter_input(INPUT_POST, "lastName", FILTER_SANITIZE_SPECIAL_CHARS);
        $userName = filter_input(INPUT_POST, "userName", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_SPECIAL_CHARS);
        $is_Admin = filter_input(INPUT_POST, "userRole", FILTER_VALIDATE_INT);
        $avatar = $_FILES['avatar'];
        
        $errorMessage = "";

        //validate inputs - I am leaving out the avatar 
        if (!$firstName) {
            $_SESSION['admin_add_user_error'] = "Please enter First Name";
        } else if (!$lastName) {
            $_SESSION['admin_add_user_error'] = "Please enter Last Name";
        } else if (!$userName) {
            $_SESSION['admin_add_user_error'] = "Please enter User Name";
        } else if (!$email) {
            $_SESSION['admin_add_user_error'] = "Please enter Email";
        } elseif (strlen($password) < 8 || strlen($confirmPassword) < 8) {
            $_SESSION['admin_add_user_error'] = "Password should be 8+ characters";
        } elseif ($password != $confirmPassword) {
            $_SESSION['admin_add_user_error'] = "Passwords do not match!";
        }  //if they do hash them
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            //create a method in the UserDB to check if username or email already exists in the database
            $user = UserDB::findUserByEmailAndPassword($email, $password);
            if ($user < 0) {
                $_SESSION['admin_add_user_error'] = "Username or Email is already in use";
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
                    $_SESSION['admin_add_user_error'] = "File should be png, jpg, jpeg";
                }
            }
            //redirect back to the admin add user page if there is an error
            if(isset($_SESSION['admin_add_user_error'])){
                header('Location: ' . ROOT_URL . 'admin/add_user.php');
                die();
            }else{
            //insert the new user into the database
            $userId = UserDB::adminAddUser($firstName, $lastName, $userName, $email, $password, $avatar, $is_Admin);
            //redirect to admin add user page if success
            header('location: ' . ROOT_URL . 'admin/manage_user.php');     
            }
            break;
             case 'list_users':
                 //list all the users from the database
                 $user = UserDB::list_users();
                 include 'manage_user.php';
}