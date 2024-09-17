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
if (strcmp($RequstType, "GetTask") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $task_id = $_GET["task_id"];


    $sql = "SELECT task_name,task_description,closing_date,task_status FROM tasks WHERE `taskId` = :task_id";
    $query = $db->prepare($sql);
    $query->bindParam(':task_id', $task_id, PDO::PARAM_INT);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    if ($query->rowCount() > 0) {
        $ResponseXML .= "<TaskName><![CDATA[".$row['task_name']."]]></TaskName>\n";
        $ResponseXML .= "<ClosingDate><![CDATA[".$row['closing_date']."]]></ClosingDate>\n";
        $ResponseXML .= "<TaskDascription><![CDATA[".$row['task_description']."]]></TaskDascription>\n";
        $ResponseXML .= "<TaskStatus><![CDATA[".$row['task_status']."]]></TaskStatus>\n";
    }

    $ResponseXML .= "</Validate>";
    echo $ResponseXML;
}
if (strcmp($RequstType, "CheckTaskNameWithID") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $task_name = $_GET["task_name"];
    $task_id = $_GET["task_id"];

    $sql = "SELECT * FROM tasks WHERE task_name = :task_name AND `taskId` != :task_id";
    $query = $db->prepare($sql);
    $query->bindParam(':task_id', $task_id, PDO::PARAM_STR);
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
if (strcmp($RequstType, "UpdateTask") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $task_id = $_GET["task_id"];
    $task_name = $_GET["task_name"];
    $closing_date = $_GET["closing_date"];
    $task_description = $_GET["task_description"];

    $sql = "UPDATE tasks SET `task_name`= :task_name,`closing_date`= :closing_date,`task_description`= :task_description WHERE `taskId` = :task_id";
    $query = $db->prepare($sql);
    $query->bindParam(':task_name', $task_name, PDO::PARAM_STR);
    $query->bindParam(':closing_date', $closing_date, PDO::PARAM_STR);
    $query->bindParam(':task_description', $task_description, PDO::PARAM_STR);
    $query->bindParam(':task_id', $task_id, PDO::PARAM_INT);
    $query->execute();
    if ($query->rowCount() > 0) {
        $ResponseXML .= "<Result><![CDATA[TRUE]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[Task has been updated]]></Message>\n";
    } else {
        $ResponseXML .= "<Result><![CDATA[False]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[Something went wrong.Please try again]]></Message>\n";
    }

    $ResponseXML .= "</Validate>";
    echo $ResponseXML;
}
if (strcmp($RequstType, "DeleteTask") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $task_id = $_GET["task_id"];
    $task_status = '0';
    $activity_status = '1';

    $sqlActivity = "SELECT * FROM activities WHERE activity_status = :activity_status AND `taskId` = :task_id";
    $queryActivity = $db->prepare($sqlActivity);
    $queryActivity->bindParam(':task_id', $task_id, PDO::PARAM_INT);
    $queryActivity->bindParam(':activity_status', $activity_status, PDO::PARAM_INT);
    $queryActivity->execute();
    if ($queryActivity->rowCount() > 0) {
        $ResponseXML .= "<Result><![CDATA[False]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[Can not delete. Active activities available]]></Message>\n";
    }else {

        $sql = "UPDATE tasks SET `task_status`= :task_status WHERE `taskId` = :task_id";
        $query = $db->prepare($sql);
        $query->bindParam(':task_status', $task_status, PDO::PARAM_STR);
        $query->bindParam(':task_id', $task_id, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0) {
            $ResponseXML .= "<Result><![CDATA[TRUE]]></Result>\n";
            $ResponseXML .= "<Message><![CDATA[Task has been deleted]]></Message>\n";
        } else {
            $ResponseXML .= "<Result><![CDATA[False]]></Result>\n";
            $ResponseXML .= "<Message><![CDATA[Something went wrong.Please try again]]></Message>\n";
        }
    }

    $ResponseXML .= "</Validate>";
    echo $ResponseXML;
}
if (strcmp($RequstType, "ActiveTask") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $task_id = $_GET["task_id"];
    $task_status = '1';

    $sql = "UPDATE tasks SET `task_status`= :task_status WHERE `taskId` = :task_id";
    $query = $db->prepare($sql);
    $query->bindParam(':task_status', $task_status, PDO::PARAM_STR);
    $query->bindParam(':task_id', $task_id, PDO::PARAM_INT);
    $query->execute();
    if ($query->rowCount() > 0) {
        $ResponseXML .= "<Result><![CDATA[TRUE]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[Task has been activated]]></Message>\n";
    } else {
        $ResponseXML .= "<Result><![CDATA[False]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[Something went wrong.Please try again]]></Message>\n";
    }

    $ResponseXML .= "</Validate>";
    echo $ResponseXML;
}
if (strcmp($RequstType, "AssignTask") == 0) {
    $employee_id = $_GET["employee_id"];
    $task_id = $_GET["task_id"];
    $activity_status = 1;

    $sqlActivity = "SELECT * FROM activities WHERE activity_status = :activity_status AND `taskId` = :task_id";
    $queryActivity = $db->prepare($sqlActivity);
    $queryActivity->bindParam(':task_id', $task_id, PDO::PARAM_INT);
    $queryActivity->bindParam(':activity_status', $activity_status, PDO::PARAM_INT);
    $queryActivity->execute();
    while ($row = $queryActivity->fetch(PDO::FETCH_ASSOC)) {

        $activity_id = $row["activityId"];
        $user_task_status = 0;

        $sql = "INSERT INTO user_has_tasks(user_id,taskId,activityId,user_task_status) VALUES(:employee_id,:task_id,:activity_id,:user_task_status)";
        $query = $db->prepare($sql);
        $query->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
        $query->bindParam(':task_id', $task_id, PDO::PARAM_INT);
        $query->bindParam(':activity_id', $activity_id, PDO::PARAM_INT);
        $query->bindParam(':user_task_status', $user_task_status, PDO::PARAM_INT);
        $query->execute();

    }
}
