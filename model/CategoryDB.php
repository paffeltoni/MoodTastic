<?php

Class CategoryDB {
    
   public static function getCategoryByID($ID) { 
    $db = Blog_Database::getDB();     
    $query = "SELECT * FROM categories WHERE ID = :ID ORDER BY ID";         
    $stmt = $db->prepare($query);
    $stmt->bindValue(':ID', $ID);
    $stmt->execute();
    $record = $stmt->fetch();
    $stmt->closeCursor();

    if ($record !== false) {
        $category = new Category(
                $record['ID'],
                $record['title'],
                $record['description']
               );
    } else {
        $category = new Category(-1,"","");                       
    }
    return $category;
}          

    
    public static function insertCategory($title, $description) {
         $db = Blog_Database::getDB();  
         $query = 'INSERT INTO categories (title, description)
                          VALUES(:title, :description)';

        $stmt = $db->prepare($query);              
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':description', $description);
        $stmt->execute();
        $stmt->closeCursor();       
    }
    
    public static function list_categories() {
        $db = Blog_Database::getDB();
        $query = 'SELECT * FROM categories ORDER BY ID';
        $statement = $db->prepare($query);
        $statement->execute();
        $records = $statement->fetchALL();
        $statement->closeCursor();

        $categoryObjectArray = array();
        foreach ($records as $record) {

            $categoryObject = new Category(
                   $record['ID'],
                    $record['title'],
                    $record['description']
                   );
            $categoryObjectArray[] = $categoryObject;
        }
        //return the array
        return $categoryObjectArray;
    }
    
    public static function updateCategory($ID, $title, $description) {
        $db = Blog_Database::getDB();
        $query = 'UPDATE categories
              SET  title = :title, description = :description
              WHERE ID = :ID';
    $statement = $db->prepare($query);
    $statement->bindValue(':ID', $ID);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();    
    }
    
   public static function getCategoryName($category_id) {
    $db = Blog_Database::getDB();     
    $query = "SELECT title FROM categories WHERE id = :category_id";         
    $stmt = $db->prepare($query);
    $stmt->bindValue(':category_id', $category_id);
    $stmt->execute();
    $category_name = $stmt->fetchColumn();
    $stmt->closeCursor();
    return $category_name;
}

    
}
