<?php
Class Category{
    
  private $ID,$title,$description ;

    public function __construct($ID, $title, $description) {

                $this->ID = $ID;
                $this->title = $title;
                $this->description = $description;
    }
    
    public function getID() {
        return $this->ID;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setID($ID): void {
        $this->ID = $ID;
    }

    public function setTitle($title): void {
        $this->title = $title;
    }

    public function setDescription($description): void {
        $this->description = $description;
    }



}