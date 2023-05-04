<?php

class Comment {
    private $ID, $comment, $post_ID, $user_ID, $is_Approved;

    public function __construct($ID, $comment, $post_ID, $user_ID, $is_Approved) {

                $this->ID = $ID;
                $this->comment = $comment;
                $this->post_ID = $post_ID;
                $this->user_ID = $user_ID;
                $this->is_Approved = $is_Approved;
    }
    
    public function getID() {
        return $this->ID;
    }

    public function getComment() {
        return $this->comment;
    }

    public function getPost_ID() {
        return $this->post_ID;
    }

    public function getUser_ID() {
        return $this->user_ID;
    }

    public function getIs_Appoved() {
        return $this->is_Appoved;
    }

    public function setID($ID): void {
        $this->ID = $ID;
    }

    public function setComment($comment): void {
        $this->comment = $comment;
    }

    public function setPost_ID($post_ID): void {
        $this->post_ID = $post_ID;
    }

    public function setUser_ID($user_ID): void {
        $this->user_ID = $user_ID;
    }

    public function setIs_Appoved($is_Appoved): void {
        $this->is_Appoved = $is_Appoved;
    }


}
