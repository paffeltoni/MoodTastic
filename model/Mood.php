<?php 
class Mood {
 private $ID, $moodLevel, $stressLevel, $abuseLevel, $date_time, $userID ;

    public function __construct( $ID, $moodLevel, $stressLevel, $abuseLevel, $date_time, $userID) {

                $this->ID = $ID;
                $this->moodLevel = $moodLevel;
                $this->stressLevel = $stressLevel;
                $this->abuseLevel = $abuseLevel;
                $this->date_time = $date_time;
                $this->userID = $userID;
    }
    public function getID() {
        return $this->ID;
    }

    public function getMoodLevel() {
        return $this->moodLevel;
    }

    public function getStressLevel() {
        return $this->stressLevel;
    }

    public function getAbuseLevel() {
        return $this->abuseLevel;
    }

    public function getDate_time() {
        return $this->date_time;
    }

    public function getUserID() {
        return $this->userID;
    }

    public function setID($ID): void {
        $this->ID = $ID;
    }

    public function setMoodLevel($moodLevel): void {
        $this->moodLevel = $moodLevel;
    }

    public function setStressLevel($stressLevel): void {
        $this->stressLevel = $stressLevel;
    }

    public function setAbuseLevel($abuseLevel): void {
        $this->abuseLevel = $abuseLevel;
    }

    public function setDate_time($date_time): void {
        $this->date_time = $date_time;
    }

    public function setUserID($userID): void {
        $this->userID = $userID;
    }


    
}