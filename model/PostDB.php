<?php

class PostDB {

    public static function updatePostFeaturedStatus($is_featured) {
        $db = Blog_Database::getDB();
        $query = 'UPDATE posts
              SET is_featured = :is_featured';
        $statement = $db->prepare($query);
        $statement->bindValue(':is_featured', $is_featured);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function insertPost($title, $body, $thumbnail, $categoryID, $authorID, $isFeatured) {
        $db = Blog_Database::getDB();

        $query = 'INSERT INTO posts (title, body, thumbnail, category_id, author_id, is_featured) 
                      VALUES (:title, :body, :thumbnail, :category_id, :author_id, :is_featured)';

        $stmt = $db->prepare($query);

        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':body', $body);
        $stmt->bindValue(':thumbnail', $thumbnail['name']); // Store only the filename
        $stmt->bindValue(':category_id', $categoryID);
        $stmt->bindValue(':author_id', $authorID);
        $stmt->bindValue(':is_featured', $isFeatured);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public static function getPostsByCurrentUser($ID) {
        $db = Blog_Database::getDB();
        $query = "SELECT posts.* FROM posts
                            JOIN users ON posts.author_id = users.ID
                            WHERE users.ID = :ID
                            ORDER BY posts.ID";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':ID', $ID);
        $stmt->execute();
        $records = $stmt->fetchAll();
        $stmt->closeCursor();

        $posts = array();
        foreach ($records as $record) {
            $post = new Post(
                    $record['ID'],
                    $record['title'],
                    $record['body'],
                    $record['thumbnail'],
                    $record['date_time'],
                    $record['category_id'],
                    $record['author_id'],
                    $record['is_featured']
            );
            $posts[] = $post;
        }

        return $posts;
    }

    public static function getAllPosts() {
        $db = Blog_Database::getDB();
        $query = "SELECT * FROM posts ORDER BY ID";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $records = $stmt->fetchAll();
        $stmt->closeCursor();

        $posts = array();
        foreach ($records as $record) {
            $post = new Post(
                    $record['ID'],
                    $record['title'],
                    $record['body'],
                    $record['thumbnail'],
                    $record['date_time'],
                    $record['category_id'],
                    $record['author_id'],
                    $record['is_featured']
            );
            $posts[] = $post;
        }

        return $posts;
    }

    public static function getFeaturedPost() {
        $db = Blog_Database::getDB();
        $query = "SELECT * FROM posts WHERE is_featured = 1 ORDER BY ID DESC LIMIT 1";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $record = $stmt->fetch();
        $stmt->closeCursor();

        if ($record) {
            $post = new Post(
                    $record['ID'],
                    $record['title'],
                    $record['body'],
                    $record['thumbnail'],
                    $record['date_time'],
                    $record['category_id'],
                    $record['author_id'],
                    $record['is_featured'],
            );
            return $post;
        }

        return null;
    }

    public static function getAuthorsUsername($author_id) {
    $db = Blog_Database::getDB();
    $query = "SELECT username FROM users WHERE id = :author_id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':author_id', $author_id);
    $stmt->execute();
    $username = $stmt->fetchColumn();
    $stmt->closeCursor();
    return $username;
}

public static function getPostById($post_id) {
    $db = Blog_Database::getDB();
    $query = "SELECT * FROM posts WHERE id = :post_id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':post_id', $post_id);
    $stmt->execute();
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $post;
}

public static function updatePost($postID, $title, $body) {
    $db = Blog_Database::getDB();
    $query = 'UPDATE posts
              SET title = :title, body = :body
              WHERE ID = :postID';
    $statement = $db->prepare($query);
    $statement->bindValue(':postID', $postID);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':body', $body);
    $statement->execute();
    $statement->closeCursor();    
}


}
