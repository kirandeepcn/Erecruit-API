<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

header('Access-Control-Allow-Origin: *');

$WEB_URL = "http://www.wellspringinfotech.com";
function __autoload($classname) {
    if($classname != "PDO") {
        include "include/" . $classname . ".class.php";
    }
}

$type = $_POST["type"];
switch ($type) {
        
    case "add_loc":
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $lat = isset($_POST['lat']) ? $_POST['lat'] : "";
        $long = isset($_POST['long']) ? $_POST['long'] : "";        
        
        if ($email == "" || $lat == "" || $lat == "" || $long == "") {
            echo json_encode(array("code" => "-1", "log" => "Some fields are missing"));
            exit();
        } 
        
        $commObj = new Common();
        if ($commObj->checkUser($email)) {
            $message = $commObj->addLocation($email,$lat,$long);                                 
        } else {
            $message = $commObj->updateLocation($email,$lat,$long);                     
        } 
        echo str_replace("\/", "/", json_encode($message));
        break;

    case "get_loc":
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        if ($email == "") {
            echo json_encode(array("code" => "-1", "log" => "Some fields are missing"));
            exit();
        } 
        
        $commObj = new Common();       
        if (!($commObj->checkUser($email))) {
            $message = $commObj->getLocation($email);                                 
        } else {
            $message = array("log"=> "User does not exist");                     
        } 
        echo str_replace("\/", "/", json_encode($message));
        break;

        
    default: 
        echo "Default";
        break;
}

