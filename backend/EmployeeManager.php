<?php
session_start();
include "DBManager.php";

$RequstType = $_GET["RequstType"];

if (strcmp($RequstType, "CheckEmployeeEmail") == 0) {
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
if (strcmp($RequstType, "SaveNewEmployee") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";


    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $user_name = $_GET["user_name"];
    $mobile_no = $_GET["mobile_no"];
    $email = $_GET["email"];
    $password = md5($_GET["password"]);
    $user_type = 'E';
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
        $ResponseXML .= "<Message><![CDATA[Employee Created]]></Message>\n";
    } else {

        $ResponseXML .= "<Result><![CDATA[False]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[Something went wrong.Please try again]]></Message>\n";
    }

    $ResponseXML .= "</Validate>";
    echo $ResponseXML;
}
if (strcmp($RequstType, "DeleteEmployee") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $user_id = $_GET["user_id"];
    $user_status = '0';

    $sql = "UPDATE users SET `user_status`= :user_status WHERE `user_id` = :user_id";
    $query = $db->prepare($sql);
    $query -> bindParam(':user_status', $user_status, PDO::PARAM_STR);
    $query -> bindParam(':user_id' , $user_id , PDO::PARAM_INT);
    $query -> execute();
    if($query -> rowCount() > 0)
    {
        $ResponseXML .= "<Result><![CDATA[TRUE]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[Employee has been deleted]]></Message>\n";
    }
    else
    {
        $ResponseXML .= "<Result><![CDATA[False]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[Something went wrong.Please try again]]></Message>\n";
    }

    $ResponseXML .= "</Validate>";
    echo $ResponseXML;
}if (strcmp($RequstType, "ActiveEmployee") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $user_id = $_GET["user_id"];
    $user_status = '1';

    $sql = "UPDATE users SET `user_status`= :user_status WHERE `user_id` = :user_id";
    $query = $db->prepare($sql);
    $query -> bindParam(':user_status', $user_status, PDO::PARAM_STR);
    $query -> bindParam(':user_id' , $user_id , PDO::PARAM_INT);
    $query -> execute();
    if($query -> rowCount() > 0)
    {
        $ResponseXML .= "<Result><![CDATA[TRUE]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[Employee has been activated]]></Message>\n";
    }
    else
    {
        $ResponseXML .= "<Result><![CDATA[False]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[Something went wrong.Please try again]]></Message>\n";
    }

    $ResponseXML .= "</Validate>";
    echo $ResponseXML;
}
if (strcmp($RequstType, "GetEmployee") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $employee_id = $_GET["employee_id"];


    $sql = "SELECT name,email,telephone,user_status FROM users WHERE `user_id` = :employee_id";
    $query = $db->prepare($sql);
    $query->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    if ($query->rowCount() > 0) {
        $ResponseXML .= "<EmployeeName><![CDATA[".$row['name']."]]></EmployeeName>\n";
        $ResponseXML .= "<EmployeeEmail><![CDATA[".$row['email']."]]></EmployeeEmail>\n";
        $ResponseXML .= "<EmployeeTelephone><![CDATA[".$row['telephone']."]]></EmployeeTelephone>\n";
        $ResponseXML .= "<EmployeeStatus><![CDATA[".$row['user_status']."]]></EmployeeStatus>\n";
    }

    $ResponseXML .= "</Validate>";
    echo $ResponseXML;
}