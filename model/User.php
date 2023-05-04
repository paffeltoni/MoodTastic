<?php

class User {
    
     private $ID, $firstName, $lastName, $userName, $email, $password, $avatar, $admin ;

    public function __construct($ID, $firstName, $lastName, $userName, $email, 
            $password, $avatar, $admin) {

        $this->ID = $ID;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->userName = $userName;
        $this->email = $email;
        $this->password = $password;
        $this->avatar = $avatar;
        $this->admin = $admin;
        
    }
    
      //admin method for display purposes
      public function getStatusAdmin() {
        $status = "";
        if ($this->getAdmin() == 0) {
            $status = "User";
        } else {
            $status = "Admin";
        }
        return $status;
    }
  
    public function getID() {
        return $this->ID;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getUserName() {
        return $this->userName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getAvatar() {
        return $this->avatar;
    }

    public function getAdmin() {
        return $this->admin;
    }

    public function setID($ID): void {
        $this->ID = $ID;
    }

    public function setFirstName($firstName): void {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName): void {
        $this->lastName = $lastName;
    }

    public function setUserName($userName): void {
        $this->userName = $userName;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function setPassword($password): void {
        $this->password = $password;
    }

    public function setAvatar($avatar): void {
        $this->avatar = $avatar;
    }

    public function setAdmin($admin): void {
        $this->admin = $admin;
    }


}
