<?php

Class UserDB {
    
    public static function getUserByID($ID) { 
        $db = Blog_Database::getDB();     
        $query = "SELECT * FROM users WHERE ID = :ID ORDER BY ID";         
        $stmt = $db->prepare($query);
        $stmt->bindValue(':ID', $ID);
        $stmt->execute();
        $record = $stmt->fetch();
        $stmt->closeCursor();

        if ($record['ID'] > 0) {
            $user = new User(
                    $record['ID'],
                    $record['first_name'],
                    $record['last_name'],
                    $record['username'],
                    $record['email'],
                    $record['password'],
                    $record['avatar'],
                    $record['admin']
                   );
            }else{
                $user = new User(-1,"","","","","","","");
        }
        return $user;
    }
    
     //list all users
    public static function list_users() {
        $db = Blog_Database::getDB();
        $query = 'SELECT * FROM users ORDER BY ID';
        $statement = $db->prepare($query);
        $statement->execute();
        $records = $statement->fetchALL();
        $statement->closeCursor();

        $userObjectArray = array();
        foreach ($records as $record) {

            $userObject = new User(
                   $record['ID'],
                    $record['first_name'],
                    $record['last_name'],
                    $record['username'],
                    $record['email'],
                    $record['password'],
                    $record['avatar'],
                    $record['admin']
                   );
            $userObjectArray[] = $userObject;
        }
        //return the array
        return $userObjectArray;
    }
    
    //user registration 
    public static function registerUser($firstName, $lastName, $userName, $email, $password, $avatar){
        $db = Blog_Database::getDB();
        $query = 'INSERT INTO users (first_name, last_name, userName, email, password, avatar, admin)
                        VALUES(:first_name, :last_name, :userName, :email, :password, :avatar, :admin)';

        $stmt = $db->prepare($query);
               
        $stmt->bindValue(':first_name', $firstName);
        $stmt->bindValue(':last_name', $lastName);
        $stmt->bindValue(':userName', $userName);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':avatar', $avatar);
        $stmt->bindValue(':admin', 0);
        $stmt->execute();
        $stmt->closeCursor();
    }
    
    //admin add user 
    public static function adminAddUser($firstName, $lastName, $userName, $email, $password, $avatar, $admin){
        $db = Blog_Database::getDB();
        $query = 'INSERT INTO users (first_name, last_name, userName, email, password, avatar, admin)
                        VALUES(:first_name, :last_name, :userName, :email, :password, :avatar, :admin)';

        $stmt = $db->prepare($query);
               
        $stmt->bindValue(':first_name', $firstName);
        $stmt->bindValue(':last_name', $lastName);
        $stmt->bindValue(':userName', $userName);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':avatar', $avatar);
        $stmt->bindValue(':admin', $admin);
        $stmt->execute();
        $stmt->closeCursor();
    }
    
    //check if a user is in the database for registering
    public static function findUserByEmailAndPassword($email, $password) {
    $db = Blog_Database::getDB();
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
  }
  //login a user with either their username or email
  public static function getUserByUsernameOrEmailAndPassword($email, $password) {
  $db = Blog_Database::getDB();
  $query = "SELECT * FROM users WHERE email = :email AND password = :password";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':email', $email);
  $stmt->bindValue(':password', $password);
  $stmt->execute();
  $user = $stmt->fetch();
  $stmt -> closeCursor();
  return $user;
  }
  

//Returns that admin is true
//The binded parameter is i because we are returning a single integer... so userID is bound to true or false
    public static function userIsAdmin($userID) {
    $db = Blog_Database::getDB();
    $query = "SELECT admin FROM users WHERE ID = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $stmt->bind_result($isAdmin);
    $stmt->fetch();
    $stmt->close();

    return $isAdmin == 1;
    }
}
