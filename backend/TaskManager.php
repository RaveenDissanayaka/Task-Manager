<?php
session_start();
include "DBManager.php";

$RequstType = $_GET["RequstType"];

if (strcmp($RequstType, "CheckTaskName") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $task_name = $_GET["task_name"];

    $sql = "SELECT * FROM tasks WHERE task_name = :task_name";
    $query = $db->prepare($sql);
    $query->bindParam(':task_name', $task_name, PDO::PARAM_STR);
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
if (strcmp($RequstType, "SaveNewTask") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";


    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $task_name = $_GET["task_name"];
    $closing_date = $_GET["closing_date"];
    $task_description = $_GET["task_description"];
    $task_status = '1';
    $created_by = $_SESSION["userid"];
    $created_date = date("Y-m-d h:i:s");


    // Query for Insertion
    $sql = "INSERT INTO tasks(task_name,task_description,closing_date,task_status,created_by,created_date) VALUES(:task_name,:task_description,:closing_date,:task_status,:created_by,:created_date)";
    $query = $db->prepare($sql);
// Binding Post Values
    $query->bindParam(':task_name', $task_name, PDO::PARAM_STR);
    $query->bindParam(':task_description', $task_description, PDO::PARAM_STR);
    $query->bindParam(':closing_date', $closing_date, PDO::PARAM_STR);
    $query->bindParam(':task_status', $task_status, PDO::PARAM_INT);
    $query->bindParam(':created_by', $created_by, PDO::PARAM_INT);
    $query->bindParam(':created_date', $created_date, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $db->lastInsertId();
    if ($lastInsertId) {

        $ResponseXML .= "<Result><![CDATA[TRUE]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[Task Created]]></Message>\n";
    } else {

        $ResponseXML .= "<Result><![CDATA[False]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[Something went wrong.Please try again]]></Message>\n";
    }

    $ResponseXML .= "</Validate>";
    echo $ResponseXML;
}