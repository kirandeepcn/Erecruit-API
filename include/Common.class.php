<?php

/*

 * To change this license header, choose License Headers in Project Properties.

 * To change this template file, choose Tools | Templates

 * and open the template in the editor.

 */

/**

 * Description of Common

 *

 * @author KDS

 */
class Common {

    protected $con;

    function __construct() {

        $this->con = new Connection();
    }

    
    function addLocation($email,$lat,$long) {
       
        $query = "INSERT INTO `location`(`email`, `lat`, `long`) VALUES (:email,:lat,:long)";

        $bindParams = array("email" => $email, "lat" => $lat, "long" => $long);

        $id = $this->con->insertQuery($query, $bindParams);

        return array("log" => "Success");
    }
    
    function updateLocation($email,$lat,$long) {
       
        $query = "UPDATE `location` SET `lat`= :lat,`long`= :long WHERE `email`= :email";

        $bindParams = array("email" => $email, "lat" => $lat, "long" => $long);

        $id = $this->con->insertQuery($query, $bindParams);

        return array("log" => "Success");
    }
    
    
    public function checkUser($email) {

        $query = "SELECT COUNT(*) as count FROM `location` WHERE `email`=:email";

        $bindParams = array("email" => $email);

        $qh = $this->con->getQueryHandler($query, $bindParams);

        $res = $qh->fetch(PDO::FETCH_ASSOC);

        $bool = ($res["count"] > 0) ? false : true;

        return $bool;
    }
    
    
    public function getLocation($email) {

        $query = "SELECT `lat`, `long` FROM `location` WHERE `email`=:email";

        $bindParams = array("email" => $email);

        $qh = $this->con->getQueryHandler($query, $bindParams);

        $res = $qh->fetch(PDO::FETCH_ASSOC);        

        return $res;
    }
    
}