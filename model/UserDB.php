<?php

Class UserDB {
    
    public static function getUserByID($ID) { 
        $db = Blog_Database::getDB();     
         $query = "SELECT * FROM Blog WHERE ID = :ID ORDER BY ID";
         
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
                    $record['userName'],
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
        $stmt->bindValue(':admin', 1);
        $stmt->execute();
        $stmt->closeCursor();
    }
    
    //check if a user is in the database
    public static function findUserByEmailAndPassword($email, $password) {
    $db = Blog_Database::getDB();
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
  }
     
    
  
}
