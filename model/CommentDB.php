<?php

class CommentDB {
    
       public static function insertComment($comment, $post_ID, $user_ID, $is_Approved) {
    $db = Blog_Database::getDB();  
    $query = 'INSERT INTO comments (comment, post_ID, user_ID, is_approved)
              VALUES(:comment, :post_ID, :user_ID, :is_approved)';

    $stmt = $db->prepare($query);              
    $stmt->bindValue(':comment', $comment);
    $stmt->bindValue(':post_ID', $post_ID);
    $stmt->bindValue(':user_ID', $user_ID);
    $stmt->bindValue(':is_approved', $is_Approved);
    $stmt->execute();
    $stmt->closeCursor();    
}

public static function getUsernameAndAvatar($user_ID) {
    $db = Blog_Database::getDB();  
    $query = 'SELECT username, avatar FROM users WHERE ID = :user_ID';
    $stmt = $db->prepare($query);              
    $stmt->bindValue(':user_ID', $user_ID);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();    

    // Return the username and avatar as an object
    $user = new stdClass();
    $user->username = $result['username'];
    $user->avatar = $result['avatar'];
    return $user;
}


    
   public static function getAllCommentsForPostByPostID($post_id) {
    $db = Blog_Database::getDB();  
    $query = "SELECT * FROM comments WHERE post_ID = :post_id ORDER BY ID";         
    $stmt = $db->prepare($query);
    $stmt->bindValue(':post_id', $post_id);
    $stmt->execute();
    $records = $stmt->fetchAll();
    $stmt->closeCursor();

    $comments = array();
    foreach ($records as $record) {
        $comment = new Comment(
            $record['ID'],
            $record['comment'],
            $record['post_ID'],
            $record['user_ID'],
            $record['is_approved']                  
        );
        $comments[] = $comment;
    }
    return $comments;
}

public static function getAllCommentsForUserByUserID($user_id) {
    $db = Blog_Database::getDB();  
    $query = "SELECT * FROM comments WHERE user_ID = :user_id ORDER BY ID";         
    $stmt = $db->prepare($query);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->execute();
    $records = $stmt->fetchAll();
    $stmt->closeCursor();

    $comments = array();
    foreach ($records as $record) {
        $comment = new Comment(
            $record['ID'],
            $record['comment'],
            $record['post_ID'],
            $record['user_ID'],
            $record['is_approved']                  
        );
        $comments[] = $comment;
    }
    return $comments;
}



    
}
