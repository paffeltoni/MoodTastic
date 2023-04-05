<?php

require_once '../model/Blog_Database.php';
require_once '../model/UserDB.php';
require_once '../model/User.php';
require_once '../model/CategoryDB.php';
require_once '../model/Category.php';
require_once '../model/Post.php';
require_once '../model/PostDB.php';

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


    //****************************************
    // Admin adds user
    //****************************************
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
        if (isset($_SESSION['admin_add_user_error'])) {
            header('Location: ' . ROOT_URL . 'admin/add_user.php');
            die();
        } else {
            //insert the new user into the database
            $userId = UserDB::adminAddUser($firstName, $lastName, $userName, $email, $password, $avatar, $is_Admin);
            //redirect to admin add user page if success
            header('location: ' . ROOT_URL . 'admin/manage_user.php');
        }
        break;

    //****************************************
    // Display all Users
    //****************************************
    case 'admin_display_users':
        //list all the users from the database
        $users = UserDB::list_users();
        include 'manage_user.php';
        break;

    //****************************************
    // Show the Edit User Form , carry ID over
    //****************************************
    case 'admin_edit_user_form':
        //Bringing in the hidden var ID to get the ID of the edit clicked-
        $ID = filter_input(INPUT_POST, 'ID', FILTER_VALIDATE_INT);
        $user = UserDB::getUserByID($ID);
        include 'edit_user.php';
        break;

    //****************************************
    // Edit User
    //****************************************
    case 'admin_edit_user':
        $ID = filter_input(INPUT_POST, 'ID', FILTER_VALIDATE_INT);
        $firstName = filter_input(INPUT_POST, "firstName", FILTER_SANITIZE_SPECIAL_CHARS);
        $lastName = filter_input(INPUT_POST, "lastName", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
        $admin = filter_input(INPUT_POST, "userRole", FILTER_VALIDATE_INT);

        if ($firstName == null || $lastName == null) {
            $errorMessage = "Please fill out all fields";
        } else {
            //update the user into the database
            UserDB::update_user($ID, $firstName, $lastName, $email, $admin);
            $users = UserDB::list_users();
            include ('manage_user.php');
        }
        include 'edit_user.php';
        break;

    //****************************************
    // Add Category
    //****************************************
    case 'add_category':
        $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_SPECIAL_CHARS);
        $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_SPECIAL_CHARS);

        if ($title == null) {
            $_SESSION['add_category_error'] = "Enter Title";
        } else if ($description == null) {
            $_SESSION['add_category_error'] = "Enter Description";
        }
        //keeping on the page if there is invalid input
        else if (isset($_SESSION['add_category_error'])) {
            $_SESSION['add_category_error'] = $_POST;
            header('Location: ' . ROOT_URL . 'admin/add_category.php');
            die();
        } else {
            //insert category into database and go back to the category page
            CategoryDB::insertCategory($title, $description);
            $_SESSION['add_category_success'] = "Category $title added successfully";
            header('Location: ' . ROOT_URL . 'admin/manage_categories.php');
            die();
        }
        header('Location: ' . ROOT_URL . 'admin/add_category.php');
        break;

    //****************************************
    // Display all Categories
    //****************************************
    case 'admin_display_categories':
        //list all the categories from the database
        $categories = CategoryDB::list_categories();
        include 'manage_categories.php';
        break;

    //****************************************
    // Show the Category Form , carry ID over
    //****************************************
    case 'admin_edit_category_form':
        //Bring in the hidden variable ID to get the ID clicked
        $ID = filter_input(INPUT_POST, 'ID', FILTER_VALIDATE_INT);
        $category = CategoryDB::getCategoryByID($ID);
        include 'edit_category.php';
        break;

    //****************************************
    // Edit the Category
    //****************************************
    case 'admin_edit_category':
        $ID = filter_input(INPUT_POST, 'ID', FILTER_VALIDATE_INT);
        $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_SPECIAL_CHARS);
        $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_SPECIAL_CHARS);

        if ($title == null || $description == null) {
            $errorMessage = "Please fill out all fields";
        } else {
            //update the category into the database
            CategoryDB::updateCategory($ID, $title, $description);
            $categories = CategoryDB::list_categories();
            include 'manage_categories.php';
        }
        include 'edit_category.php';
        break;

    //****************************************
    // Show add Post Form w loaded categories
    //****************************************
    case 'show_add_post':
        $categories = CategoryDB::list_categories();
        include 'add_post.php';
        break;

    //****************************************
    // Add Post
    //****************************************
    case 'add_post':
        //get the user id that is in session from when they logged in user_manager/index - log in
        $author_id = $_SESSION['user_id'];
        $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_SPECIAL_CHARS);
        $body = filter_input(INPUT_POST, "body", FILTER_SANITIZE_SPECIAL_CHARS);
        $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
        $isFeatured = filter_input(INPUT_POST, "isFeatured", FILTER_SANITIZE_SPECIAL_CHARS);
        $thumbnail = $_FILES['thumbnail'];

        //set isFeatured to 0 if its not checked
        $isFeatured = $isFeatured == 1 ?: 0;

        //validate the form
        if (!$title) {
            $_SESSION['add-post-error'] = "Please enter a title";
        } else if (!$category_id) {
            $_SESSION['add-post-error'] = "Please choose a category";
        } else if (!$body) {
            $_SESSION['add-post-error'] = "Please enter post";
        } else if (!$thumbnail['name']) {
            $_SESSION['add-post-error'] = "Choose Post Thumbnail";
        } else {
            //work on the thumbnail
            $thumbnail_name = $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_destination_path = '../images_thumbnail/' . $thumbnail_name;

            //make sure the file is an image
            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extension = strtolower(pathinfo($thumbnail_name, PATHINFO_EXTENSION));
            if (in_array($extension, $allowed_files)) {
                //make sure image is not too big (2mb+)
                if ($thumbnail['size'] < 2000000) {
                    //upload thumbnail
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                } else {
                    $_SESSION['add-post-error'] = "File size is too big, should be less than 2mb";
                }
            } else {
                $_SESSION['add-post-error'] = "File should be png, jpg, or jpeg";
            }

        }
        //Redirect back to page with form data if there is any problem
        if(isset($_SESSION['add-post-error'])){
            $_SESSION['add-post-data'] = $_POST;
            header('Location: ' . ROOT_URL . 'admin/add_post.php');
            die();
        }else{
            //check to see if the post is featured- we only want one featured post in our database
            //Doing this before we insert the new post so it will all come together, like magic :) 
            //so here we are going to set isFeatured to 0 with an update statement from DB
            if($isFeatured == 1){
                $isFeatured = 0;
                PostDB::updatePostFeaturedStatus($isFeatured);
            }      
            //insert post into posts table
            PostDB::insertPost($title, $body, $thumbnail, $category_id, $author_id, $isFeatured);
            header('Location: ' . ROOT_URL . 'admin/manage_post.php');
            die();
        }
        break;
        
        //****************************************
        // Fetch Posts based on user role
        //****************************************   
    case 'show_user_posts':
        if ($_SESSION['is_admin']) {
            // if the user is an admin, show all posts
            $posts = PostDB::getAllPosts();
        } else {
            // if the user is not an admin, show only their own posts
            $current_user_posts = $_SESSION['user_id'];
            $posts = PostDB::getPostsByCurrentUser($current_user_posts);
        }
        include 'manage_post.php';
        break;
    
    //****************************************
    // BLANK TEMPLATE
    //****************************************
    case '#':
        //what are we doing     
        include 'page.php';
        break;
    
    
     //****************************************
    // BLANK TEMPLATE
    //****************************************
    case '#':
        //what are we doing     
        include 'page.php';
        break;
    
     //****************************************
    // BLANK TEMPLATE
    //****************************************
    case '#':
        //what are we doing     
        include 'page.php';
        break;
    
    
    
    
    
    
    
     
}