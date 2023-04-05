<?php
class Post {
     private $ID, $title, $body, $thumbnail, $date_time, $categoryID, $authorID, $isFeatured;

    public function __construct($ID, $title, $body, $thumbnail, $date_time, 
            $categoryID, $authorID, $isFeatured) {

                $this->ID = $ID;
                $this->title = $title;
                $this->body = $body;
                $this->thumbnail = $thumbnail;
                $this->date_time = $date_time;
                $this->categoryID = $categoryID;
                $this->authorID = $authorID;
                $this->isFeatured = $isFeatured;  
    }
    
         
    public function getID() {
        return $this->ID;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getBody() {
        return $this->body;
    }

    public function getThumbnail() {
        return $this->thumbnail;
    }

    public function getDate_time() {
        return $this->date_time;
    }

    public function getCategoryID() {
        return $this->categoryID;
    }

    public function getAuthorID() {
        return $this->authorID;
    }

    public function getIsFeatured() {
        return $this->isFeatured;
    }

    public function setID($ID): void {
        $this->ID = $ID;
    }

    public function setTitle($title): void {
        $this->title = $title;
    }

    public function setBody($body): void {
        $this->body = $body;
    }

    public function setThumbnail($thumbnail): void {
        $this->thumbnail = $thumbnail;
    }

    public function setDate_time($date_time): void {
        $this->date_time = $date_time;
    }

    public function setCategoryID($categoryID): void {
        $this->categoryID = $categoryID;
    }

    public function setAuthorID($authorID): void {
        $this->authorID = $authorID;
    }

    public function setIsFeatured($isFeatured): void {
        $this->isFeatured = $isFeatured;
    }


    
}
