<?php
session_start();
unset($_SESSION['userid']); // unset session variable
session_destroy(); // destroy session
header("location:index.php");
?>