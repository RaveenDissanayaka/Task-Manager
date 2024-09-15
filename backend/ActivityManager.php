<?php
session_start();
include "DBManager.php";

$RequstType = $_GET["RequstType"];

if (strcmp($RequstType, "CheckActivityName") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $task_id = $_GET["task_id"];
    $activity_name = $_GET["activity_name"];

    $sql = "SELECT * FROM activities WHERE activity_name = :activity_name AND taskId = :task_id";
    $query = $db->prepare($sql);
    $query->bindParam(':activity_name', $activity_name, PDO::PARAM_STR);
    $query->bindParam(':task_id', $task_id, PDO::PARAM_STR);
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
if (strcmp($RequstType, "SaveNewActivity") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";


    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $task_id = $_GET["task_id"];
    $activity_name = $_GET["activity_name"];
    $date_start = $_GET["date_start"];
    $date_complete = $_GET["date_complete"];
    $activity_description = $_GET["activity_description"];
    $activity_status = '1';
    $created_by = $_SESSION["userid"];
    $created_date = date("Y-m-d h:i:s");


    // Query for Insertion
    $sql = "INSERT INTO activities(taskId,activity_name,activity_description,date_start,date_complete,activity_status,created_by,created_date) VALUES(:task_id,:activity_name,:activity_description,:date_start,:date_complete,:activity_status,:created_by,:created_date)";
    $query = $db->prepare($sql);
// Binding Post Values
    $query->bindParam(':task_id', $task_id, PDO::PARAM_STR);
    $query->bindParam(':activity_name', $activity_name, PDO::PARAM_STR);
    $query->bindParam(':date_start', $date_start, PDO::PARAM_STR);
    $query->bindParam(':date_complete', $date_complete, PDO::PARAM_STR);
    $query->bindParam(':activity_description', $activity_description, PDO::PARAM_STR);
    $query->bindParam(':activity_status', $activity_status, PDO::PARAM_INT);
    $query->bindParam(':created_by', $created_by, PDO::PARAM_INT);
    $query->bindParam(':created_date', $created_date, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $db->lastInsertId();
    if ($lastInsertId) {

        $ResponseXML .= "<Result><![CDATA[TRUE]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[Activity Created]]></Message>\n";
    } else {

        $ResponseXML .= "<Result><![CDATA[False]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[Something went wrong.Please try again]]></Message>\n";
    }

    $ResponseXML .= "</Validate>";
    echo $ResponseXML;
}
if (strcmp($RequstType, "GetActivity") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $activity_id = $_GET["activity_id"];


    $sql = "SELECT tasks.task_name,activities.activity_name,activities.activity_description,activities.date_start,activities.date_complete, activities.activity_status
FROM activities
 INNER JOIN tasks ON tasks.taskId = activities.taskId WHERE activities.`taskId` = :activity_id";
    $query = $db->prepare($sql);
    $query->bindParam(':activity_id', $activity_id, PDO::PARAM_INT);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    if ($query->rowCount() > 0) {
        $ResponseXML .= "<TaskName><![CDATA[".$row['task_name']."]]></TaskName>\n";
        $ResponseXML .= "<ActivityName><![CDATA[".$row['activity_name']."]]></ActivityName>\n";
        $ResponseXML .= "<DateStart><![CDATA[".$row['date_start']."]]></DateStart>\n";
        $ResponseXML .= "<DateComplete><![CDATA[".$row['date_complete']."]]></DateComplete>\n";
        $ResponseXML .= "<ActivityDascription><![CDATA[".$row['activity_description']."]]></ActivityDascription>\n";
        $ResponseXML .= "<ActivityStatus><![CDATA[".$row['activity_status']."]]></ActivityStatus>\n";
    }

    $ResponseXML .= "</Validate>";
    echo $ResponseXML;
}