<?php
session_start();
include "DBManager.php";

$RequstType = $_GET["RequstType"];

if (strcmp($RequstType, "CheckUserEmail") == 0) {

}