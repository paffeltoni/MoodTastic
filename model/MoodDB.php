<?php
class MoodDB {
    
    
   public static function getMoodsByCurrentUser($ID) {
    $db = Blog_Database::getDB();
    $query = "SELECT mood_entries.* FROM mood_entries
              JOIN users ON mood_entries.user_id = users.ID
              WHERE users.ID = :ID
              ORDER BY mood_entries.ID";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':ID', $ID);
    $stmt->execute();
    $records = $stmt->fetchAll();
    $stmt->closeCursor();

    $moods = array();
    foreach ($records as $record) {
        $mood = new Mood(
            $record['ID'],
            $record['mood_level'],
            $record['stress_level'],
            $record['abuse_level'],
            $record['date_time'],
            $record['user_id']
        );
        $moods[] = $mood;
    }

    return $moods;
}


public static function insertMood($mood_level, $stress_level, $abuse_level, $user_id) {
    // Validate user_id to ensure it exists in the users table
    $db = Blog_Database::getDB();
    $user_query = "SELECT ID FROM users WHERE ID = :user_id";
    $user_stmt = $db->prepare($user_query);
    $user_stmt->bindValue(':user_id', $user_id);
    $user_stmt->execute();
    $user_record = $user_stmt->fetch();
    $user_stmt->closeCursor();
    if (!$user_record) {
        // User ID is invalid, return false or throw an error
        return false; // or throw an error
    }

    // Insert mood into moods table
    $query = "INSERT INTO mood_entries (mood_level, stress_level, abuse_level, user_id)
              VALUES (:mood_level, :stress_level, :abuse_level, :user_id)";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':mood_level', $mood_level);
    $stmt->bindValue(':stress_level', $stress_level);
    $stmt->bindValue(':abuse_level', $abuse_level);
    $stmt->bindValue(':user_id', $user_id);
    $result = $stmt->execute();
    $stmt->closeCursor();
    return $result;
}


}
