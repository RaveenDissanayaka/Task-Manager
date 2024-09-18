<?php
$pageTitle = 'Dashboard';

include_once('Common/header.php');
$is_dashboard = 1;
include_once('Common/menu.php');

if ($userType != 'A') { ?>
    <script>
        window.location.href = "employee_dashboard.php";
    </script>
    <?php

}

$queryUsers = $db->prepare("SELECT COUNT(user_id) AS userCount FROM users WHERE user_type = 'A'");
$queryUsers->execute();
$rowU = $queryUsers->fetch(PDO::FETCH_ASSOC);
$userCount = $rowU['userCount'];

$queryEmployees = $db->prepare("SELECT COUNT(user_id) AS employeeCount FROM users WHERE user_type = 'E'");
$queryEmployees->execute();
$rowE = $queryEmployees->fetch(PDO::FETCH_ASSOC);
$employeeCount = $rowE['employeeCount'];

$queryTasks = $db->prepare("SELECT COUNT(taskId) AS taskCount FROM tasks ");
$queryTasks->execute();
$rowT = $queryTasks->fetch(PDO::FETCH_ASSOC);
$taskCount = $rowT['taskCount'];

$queryActivities = $db->prepare("SELECT COUNT(activityId) AS activityCount FROM activities ");
$queryActivities->execute();
$rowA = $queryActivities->fetch(PDO::FETCH_ASSOC);
$activityCount = $rowA['activityCount'];
?>
<div class="content-page">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="card card-block card-stretch card-height">
                    <div class="card-body">
                        <div class="top-block d-flex align-items-center justify-content-between">
                            <h5>User</h5>
                            <span class="badge badge-primary">All</span>
                        </div>
                        <h3><span class="counter"><?php echo $userCount; ?></span></h3>
                        <div class="d-flex align-items-center justify-content-between mt-1">
                            <p class="mb-0">Total Users</p>
                            <span class="text-primary">100%</span>
                        </div>
                        <div class="iq-progress-bar bg-primary-light mt-2">
                            <span class="bg-primary iq-progress progress-1" data-percent="100"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card card-block card-stretch card-height">
                    <div class="card-body">
                        <div class="top-block d-flex align-items-center justify-content-between">
                            <h5>Employee</h5>
                            <span class="badge badge-warning">All</span>
                        </div>
                        <h3><span class="counter"><?php echo $employeeCount; ?></span></h3>
                        <div class="d-flex align-items-center justify-content-between mt-1">
                            <p class="mb-0">Total Employees</p>
                            <span class="text-warning">100%</span>
                        </div>
                        <div class="iq-progress-bar bg-warning-light mt-2">
                            <span class="bg-warning iq-progress progress-1" data-percent="100"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card card-block card-stretch card-height">
                    <div class="card-body">
                        <div class="top-block d-flex align-items-center justify-content-between">
                            <h5>Task</h5>
                            <span class="badge badge-success">All</span>
                        </div>
                        <h3><span class="counter"><?php echo $taskCount; ?></span></h3>
                        <div class="d-flex align-items-center justify-content-between mt-1">
                            <p class="mb-0">Total Tasks</p>
                            <span class="text-success">100%</span>
                        </div>
                        <div class="iq-progress-bar bg-success-light mt-2">
                            <span class="bg-success iq-progress progress-1" data-percent="100"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card card-block card-stretch card-height">
                    <div class="card-body">
                        <div class="top-block d-flex align-items-center justify-content-between">
                            <h5>Activity</h5>
                            <span class="badge badge-info">All</span>
                        </div>
                        <h3><span class="counter"><?php echo $activityCount; ?></span></h3>
                        <div class="d-flex align-items-center justify-content-between mt-1">
                            <p class="mb-0">Total Activities</p>
                            <span class="text-info">100%</span>
                        </div>
                        <div class="iq-progress-bar bg-info-light mt-2">
                            <span class="bg-info iq-progress progress-1" data-percent="100"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Wrapper End-->

<?php
include_once('Common/footer.php');
?>


