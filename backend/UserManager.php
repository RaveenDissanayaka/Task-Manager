<?php
session_start();
include "DBManager.php";

$RequstType = $_GET["RequstType"];

if (strcmp($RequstType, "SaveNewUser") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";


    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $user_name = $_GET["user_name"];
    $mobile_no = $_GET["mobile_no"];
    $email = $_GET["email"];
    $password = md5($_GET["password"]);
    $user_type = 'A';
    $user_status = '1';
    $created_by = $_SESSION["userid"];
    $created_date =date("Y-m-d h:i:s");


    // Query for Insertion
    $sql = "INSERT INTO users(email,name,password,user_type,telephone,user_status,created_by,created_date) VALUES(:email,:name,:password,:user_type,:telephone,:user_status,:created_by,:created_date)";
    $query = $db->prepare($sql);
// Binding Post Values
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':name', $user_name, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_INT);
    $query->bindParam(':user_type', $user_type, PDO::PARAM_STR);
    $query->bindParam(':telephone', $mobile_no, PDO::PARAM_STR);
    $query->bindParam(':user_status', $user_status, PDO::PARAM_STR);
    $query->bindParam(':created_by', $created_by, PDO::PARAM_STR);
    $query->bindParam(':created_date', $created_date, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $db->lastInsertId();
    if ($lastInsertId) {

        $ResponseXML .= "<Result><![CDATA[TRUE]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[User Created]]></Message>\n";
    } else {

        $ResponseXML .= "<Result><![CDATA[False]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[Something went wrong.Please try again]]></Message>\n";
    }

    $ResponseXML .= "</Validate>";
    echo $ResponseXML;
}