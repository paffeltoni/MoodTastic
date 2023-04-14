<?php

require_once '../model/Blog_Database.php';
require_once '../model/UserDB.php';
require_once '../model/User.php';
require_once '../model/Post.php';
require_once '../model/PostDB.php';
require_once '../model/Category.php';
require_once '../model/CategoryDB.php';
require_once '../model/Mood.php';
require_once '../model/MoodDB.php';

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

        // Get the rest of the posts
        $posts = PostDB::getAllPosts();
        // Pass the posts to the view
        $_SESSION['all_posts'] = $posts;

        // Get the category names for all of the posts
        $categoryNames = array();
        foreach ($posts as $post) {
            $categoryNames[$post->getId()] = CategoryDB::getCategoryName($post->getCategoryId());
        }
        $_SESSION['category_names'] = $categoryNames;

        include 'user_posts_form.php';
        break;

    //*******************************************************************
    // Show User Page / case statement for Weather API
    //*******************************************************************
    case'user_show_user_you_form':
    //****************************************
    // WEATHER MOON API
    //****************************************
    case'weather':

        $url = 'https://api.openweathermap.org/data/2.5/weather?q={city name}&appid={API key}';
        $asiKey = 'a326f948827325b077851cc20fb9efa2';

        $city = filter_input(INPUT_POST, "city", FILTER_SANITIZE_STRING);

        if ($city == null) {
            $_SESSION['city_error'] = "Please enter a city";
        }
        if ($city) {
            $API_Data = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=" . $city . "&appid=a326f948827325b077851cc20fb9efa2");
            $weatherArray = json_decode($API_Data, true);

            // Get the longitude and latitude from the weather API response
            $longitude = $weatherArray['coord']['lon'];
            $latitude = $weatherArray['coord']['lat'];

            //Make temp F
            $tempFahrenheit = ($weatherArray['main']['temp'] - 273) * 9 / 5 + 32;

            $weatherDescription = ucfirst($weatherArray['weather'][0]['description']);

            // Get the current moon phase
            $apiKey = '146f5466da3247d6bfb9ad3ebc92ee04';
            $moonAPIUrl = "https://api.ipgeolocation.io/astronomy?apiKey=$apiKey&lat=$latitude&long=$longitude";
            $moonAPIResponse = file_get_contents($moonAPIUrl);
            $moonAPIResult = json_decode($moonAPIResponse, true);

            //Use print r to get the array of values from your API
            //print_r($moonAPIResult);
            // Get the moonrise and moonset times from the API response
            $moonrise = strtotime($moonAPIResult['moonrise']);
            $moonset = strtotime($moonAPIResult['moonset']);

            // Get the current time
            $current_time = time();

            // Determine the moon phase based on the moonrise and moonset times
            if ($moonrise < strtotime('today') && $moonset > strtotime('today')) {
                $moon_phase = 'Waxing Gibbous';
            } elseif ($moonrise > strtotime('today') && $moonset > strtotime('today')) {
                $moon_phase = 'Waxing Crescent';
            } elseif ($moonrise < strtotime('today') && $moonset < strtotime('today')) {
                $moon_phase = 'Waning Gibbous';
            } elseif ($moonrise > strtotime('today') && $moonset < strtotime('today')) {
                $moon_phase = 'Waning Crescent';
            } else {
                $moon_phase = 'Unknown';
            }

            // Build the weather message with temperature, weather condition, and moon phase
            $_SESSION['weather'] = "<b>Temperature:</b> " . round($tempFahrenheit, 1) . "°F<br>";
            $_SESSION['weather'] .= "<b>Weather Condition:</b> " . $weatherDescription . "<br>";
            $_SESSION['weather'] .= "<b>Moon Phase:</b> " . $moon_phase;
        }
        include('user_you_form.php');
        break;

    //****************************************
    // User MOOD LEVELS
    //****************************************
    case 'user_mood_levels':
        // Retrieve form input values
        $moodLevel = filter_input(INPUT_POST, 'moodLevelInput', FILTER_SANITIZE_SPECIAL_CHARS);
        $stressLevel = filter_input(INPUT_POST, 'stressLevelInput', FILTER_SANITIZE_SPECIAL_CHARS);
        $abuseLevel = filter_input(INPUT_POST, 'abuseLevelInput', FILTER_SANITIZE_SPECIAL_CHARS);
        // get the user in session
        $userId = $_SESSION['user_id'];
        //insert moods to database 
        MoodDB::insertMood($moodLevel, $stressLevel, $abuseLevel, $userId);

        //get the users moods to display in the chart





        include('user_you_form.php');
        break;

    
    
    case 'user_logout':
    // Unset all session variables
    session_unset();
    // Destroy the session
    session_destroy();
    // Redirect to the login page
    header('location: ' . ROOT_URL . 'user_manager/user_login_form.php');
    exit;
    break;

    //****************************************
    // BLANK
    //****************************************
    case'#':
        include('form.php');
        break;
}