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


    $sql = "SELECT tasks.task_name,activities.taskId,activities.activity_name,activities.activity_description,activities.date_start,activities.date_complete, activities.activity_status
FROM activities
 INNER JOIN tasks ON tasks.taskId = activities.taskId WHERE activities.`activityId` = :activity_id";
    $query = $db->prepare($sql);
    $query->bindParam(':activity_id', $activity_id, PDO::PARAM_INT);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    if ($query->rowCount() > 0) {
        $ResponseXML .= "<TaskName><![CDATA[".$row['task_name']."]]></TaskName>\n";
        $ResponseXML .= "<TaskID><![CDATA[".$row['taskId']."]]></TaskID>\n";
        $ResponseXML .= "<ActivityName><![CDATA[".$row['activity_name']."]]></ActivityName>\n";
        $ResponseXML .= "<DateStart><![CDATA[".$row['date_start']."]]></DateStart>\n";
        $ResponseXML .= "<DateComplete><![CDATA[".$row['date_complete']."]]></DateComplete>\n";
        $ResponseXML .= "<ActivityDescription><![CDATA[".$row['activity_description']."]]></ActivityDescription>\n";
        $ResponseXML .= "<ActivityStatus><![CDATA[".$row['activity_status']."]]></ActivityStatus>\n";
    }

    $ResponseXML .= "</Validate>";
    echo $ResponseXML;
}
if (strcmp($RequstType, "CheckActivityNameWithID") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $activity_name = $_GET["activity_name"];
    $task_id = $_GET["task_id"];
    $activity_id = $_GET["activity_id"];

    $sql = "SELECT * FROM activities WHERE activity_name = :activity_name AND `taskId` = :task_id AND `activityId` != :activity_id";
    $query = $db->prepare($sql);
    $query->bindParam(':task_id', $task_id, PDO::PARAM_STR);
    $query->bindParam(':activity_name', $activity_name, PDO::PARAM_STR);
    $query->bindParam(':activity_id', $activity_id, PDO::PARAM_STR);
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
if (strcmp($RequstType, "UpdateActivity") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $activity_id = $_GET["activity_id"];
    $task_id = $_GET["task_id"];
    $activity_name = $_GET["activity_name"];
    $date_start = $_GET["date_start"];
    $date_complete = $_GET["date_complete"];
    $activity_description = $_GET["activity_description"];

    $sql = "UPDATE activities SET `activity_name`= :activity_name,`taskId`= :task_id,`date_start`= :date_start ,`date_complete`= :date_complete ,`activity_description`= :activity_description
WHERE `activityId` = :activity_id";
    $query = $db->prepare($sql);
    $query->bindParam(':activity_name', $activity_name, PDO::PARAM_STR);
    $query->bindParam(':date_start', $date_start, PDO::PARAM_STR);
    $query->bindParam(':date_complete', $date_complete, PDO::PARAM_STR);
    $query->bindParam(':activity_description', $activity_description, PDO::PARAM_STR);
    $query->bindParam(':task_id', $task_id, PDO::PARAM_INT);
    $query->bindParam(':activity_id', $activity_id, PDO::PARAM_INT);
    $query->execute();
    if ($query->rowCount() > 0) {
        $ResponseXML .= "<Result><![CDATA[TRUE]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[Activity has been updated]]></Message>\n";
    } else {
        $ResponseXML .= "<Result><![CDATA[False]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[Something went wrong.Please try again]]></Message>\n";
    }

    $ResponseXML .= "</Validate>";
    echo $ResponseXML;
}
if (strcmp($RequstType, "DeleteActivity") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $activity_id = $_GET["activity_id"];
    $activity_status = '0';

        $sql = "UPDATE activities SET `activity_status`= :activity_status WHERE `activityId` = :activity_id";
        $query = $db->prepare($sql);
        $query->bindParam(':activity_status', $activity_status, PDO::PARAM_STR);
        $query->bindParam(':activity_id', $activity_id, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0) {
            $ResponseXML .= "<Result><![CDATA[TRUE]]></Result>\n";
            $ResponseXML .= "<Message><![CDATA[Activity has been deleted]]></Message>\n";
        } else {
            $ResponseXML .= "<Result><![CDATA[False]]></Result>\n";
            $ResponseXML .= "<Message><![CDATA[Something went wrong.Please try again]]></Message>\n";
        }


    $ResponseXML .= "</Validate>";
    echo $ResponseXML;
}
if (strcmp($RequstType, "ActiveActivity") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $activity_id = $_GET["activity_id"];
    $activity_status = '1';

    $sql = "UPDATE activities SET `activity_status`= :activity_status WHERE `activityId` = :activity_id";
    $query = $db->prepare($sql);
    $query->bindParam(':activity_status', $activity_status, PDO::PARAM_STR);
    $query->bindParam(':activity_id', $activity_id, PDO::PARAM_INT);
    $query->execute();
    if ($query->rowCount() > 0) {
        $ResponseXML .= "<Result><![CDATA[TRUE]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[Activity has been activated]]></Message>\n";
    } else {
        $ResponseXML .= "<Result><![CDATA[False]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[Something went wrong.Please try again]]></Message>\n";
    }

    $ResponseXML .= "</Validate>";
    echo $ResponseXML;
}
if (strcmp($RequstType, "GetActivityList") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $task_id = $_GET["task_id"];
    $activity_status = '1';

    $tableResult = '';

    $sql = "UPDATE tasks SET `task_status`= :task_status WHERE `taskId` = :task_id";
    $query = $db->prepare($sql);
    $query->bindParam(':activity_status', $activity_status, PDO::PARAM_STR);
    $query->bindParam(':task_id', $task_id, PDO::PARAM_INT);
    $query->execute();
    if ($query->rowCount() > 0) {
        $ResponseXML .= "<Result><![CDATA[TRUE]]></Result>\n";

    }

    $ResponseXML .= "</Validate>";
    echo $ResponseXML;
}
if (strcmp($RequstType, "ChangeStatus") == 0) {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<Validate>\n";

    $activity_id = $_GET["activity_id"];
    $activity_status = $_GET["activity_status"];

    $sql = "UPDATE user_has_tasks SET `user_task_status`= :activity_status WHERE `user_task_id` = :activity_id";
    $query = $db->prepare($sql);
    $query->bindParam(':activity_status', $activity_status, PDO::PARAM_STR);
    $query->bindParam(':activity_id', $activity_id, PDO::PARAM_INT);
    $query->execute();
    if ($query->rowCount() > 0) {
        $ResponseXML .= "<Result><![CDATA[TRUE]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[Status has been chnaged]]></Message>\n";
    } else {
        $ResponseXML .= "<Result><![CDATA[False]]></Result>\n";
        $ResponseXML .= "<Message><![CDATA[Something went wrong.Please try again]]></Message>\n";
    }

    $ResponseXML .= "</Validate>";
    echo $ResponseXML;
}