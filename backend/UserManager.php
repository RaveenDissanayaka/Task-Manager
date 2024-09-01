<?php
session_start();
include "DBManager.php";

$RequstType = $_GET["RequstType"];

if (strcmp($RequstType, "CheckUserEmail") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $email = $_GET["email"];

    $sql = "SELECT * FROM users WHERE email = :email";
    $query = $db->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $ResponseXML .= "<Result><![CDATA[TRUE]]></Result>\n";
    } else {
        $ResponseXML .= "<Result><![CDATA[FALSE]]></Result>\n";
    }

    $ResponseXML .= "</Validate>";
    echo $ResponseXML;
}
if (strcmp($RequstType, "CheckUserEmailWithID") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $email = $_GET["email"];
    $user_id = $_GET["user_id"];

    $sql = "SELECT * FROM users WHERE email = :email AND `user_id` != :user_id";
    $query = $db->prepare($sql);
    $query->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $ResponseXML .= "<Result><![CDATA[TRUE]]></Result>\n";
    } else {
        $ResponseXML .= "<Result><![CDATA[FALSE]]></Result>\n";
    }

    $ResponseXML .= "</Validate>";
    echo $ResponseXML;
}
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
    $created_date = date("Y-m-d h:i:s");


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
if (strcmp($RequstType, "DeleteUser") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $user_id = $_GET["user_id"];
    $user_status = '0';

    $sql = "UPDATE users SET `user_status`= :user_status WHERE `user_id` = :user_id";
    $query = $db->prepare($sql);
    $query->bindParam(':user_status', $user_status, PDO::PARAM_STR);
    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $query->execute();
    if ($query->rowCount() > 0) {
        $ResponseXML .= "<Result><![CDATA[TRUE]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[User has been deleted]]></Message>\n";
    } else {
        $ResponseXML .= "<Result><![CDATA[False]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[Something went wrong.Please try again]]></Message>\n";
    }

    $ResponseXML .= "</Validate>";
    echo $ResponseXML;
}
if (strcmp($RequstType, "ActiveUser") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $user_id = $_GET["user_id"];
    $user_status = '1';

    $sql = "UPDATE users SET `user_status`= :user_status WHERE `user_id` = :user_id";
    $query = $db->prepare($sql);
    $query->bindParam(':user_status', $user_status, PDO::PARAM_STR);
    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $query->execute();
    if ($query->rowCount() > 0) {
        $ResponseXML .= "<Result><![CDATA[TRUE]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[User has been activated]]></Message>\n";
    } else {
        $ResponseXML .= "<Result><![CDATA[False]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[Something went wrong.Please try again]]></Message>\n";
    }

    $ResponseXML .= "</Validate>";
    echo $ResponseXML;
}
if (strcmp($RequstType, "UpdateUser") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $user_id = $_GET["user_id"];
    $user_name = $_GET["user_name"];
    $user_email = $_GET["user_email"];
    $user_mobile = $_GET["user_mobile"];

    $sql = "UPDATE users SET `name`= :user_name,`email`= :user_email,`telephone`= :user_mobile WHERE `user_id` = :user_id";
    $query = $db->prepare($sql);
    $query->bindParam(':user_name', $user_name, PDO::PARAM_STR);
    $query->bindParam(':user_email', $user_email, PDO::PARAM_STR);
    $query->bindParam(':user_mobile', $user_mobile, PDO::PARAM_STR);
    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $query->execute();
    if ($query->rowCount() > 0) {
        $ResponseXML .= "<Result><![CDATA[TRUE]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[User has been updated]]></Message>\n";
    } else {
        $ResponseXML .= "<Result><![CDATA[False]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[Something went wrong.Please try again]]></Message>\n";
    }

    $ResponseXML .= "</Validate>";
    echo $ResponseXML;
}
if (strcmp($RequstType, "ResetUserPassword") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $user_id = $_GET["user_id"];
    $password = md5($_GET["new_pass"]);

    $sql = "UPDATE users SET `password`= :user_password WHERE `user_id` = :user_id";
    $query = $db->prepare($sql);
    $query->bindParam(':user_password', $password, PDO::PARAM_STR);
    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $query->execute();
    if ($query->rowCount() > 0) {
        $ResponseXML .= "<Result><![CDATA[TRUE]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[User password has been updated]]></Message>\n";
    } else {
        $ResponseXML .= "<Result><![CDATA[False]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[Something went wrong.Please try again]]></Message>\n";
    }

    $ResponseXML .= "</Validate>";
    echo $ResponseXML;
}
if (strcmp($RequstType, "GetUser") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $user_id = $_GET["user_id"];


    $sql = "SELECT name,email,telephone,user_status FROM users WHERE `user_id` = :user_id";
    $query = $db->prepare($sql);
    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    if ($query->rowCount() > 0) {
        $ResponseXML .= "<UserName><![CDATA[".$row['name']."]]></UserName>\n";
        $ResponseXML .= "<UserEmail><![CDATA[".$row['email']."]]></UserEmail>\n";
        $ResponseXML .= "<UserTelephone><![CDATA[".$row['telephone']."]]></UserTelephone>\n";
        $ResponseXML .= "<UserStatus><![CDATA[".$row['user_status']."]]></UserStatus>\n";
    }

    $ResponseXML .= "</Validate>";
    echo $ResponseXML;
}