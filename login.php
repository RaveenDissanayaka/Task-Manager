<?php
session_start();
//Database Configuration File
include('backend/DBManager.php');

if(isset($_POST['login']))
{
    // Getting username/ email and password
    $uname=$_POST['username'];
    $password=md5($_POST['password']);
    // Fetch data from database on the basis of username/email and password
    $sql ="SELECT user_id,user_type FROM users WHERE (email=:usname) and (password=:usrpassword)";
    $query= $db -> prepare($sql);
    $query-> bindParam(':usname', $uname, PDO::PARAM_STR);
    $query-> bindParam(':usrpassword', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetch(PDO::FETCH_ASSOC);
    if($query->rowCount() > 0)
    {
        $_SESSION['userid']=$results['user_id'];
        if($results['user_type'] == 'A') {
            echo "<script type='text/javascript'> document.location = 'app/dashboard.php'; </script>";
        }else {
            echo "<script type='text/javascript'> document.location = 'app/employee_dashboard.php'; </script>";
        }
    } else{
        echo "<script>alert('Invalid Details');</script>";
        echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
    }
}
?>