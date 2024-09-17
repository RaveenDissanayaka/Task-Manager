<?php
$pageTitle = 'Tasks';

include_once('Common/header.php');
$is_employee_task = 1;
include_once('Common/menu.php');

if ($userType != 'E') { ?>
    <script>
        window.location.href = "employee_dashboard.php";
    </script>
    <?php

}
?>
<div class="content-page">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Tasks</h4>
                </div>
            </div>
            <div class="card-body">
                <?php
                $queryMain = $db->prepare("SELECT H.taskId,T.task_name,T.task_description FROM user_has_tasks AS H
INNER JOIN tasks AS T ON T.taskId = H.taskId
WHERE H.user_id = '$user_id' GROUP BY H.taskId");
                $queryMain->execute();
                while ($rowM = $queryMain->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="card card-widget task-card">
                    <div class="card-body">

                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="col-md-12">
                                    <h5 class="col-md-12 "><?php echo $rowM['task_name'] . ' - '.$rowM['task_description']; ?></h5>
                                    <div class="progress mb-3">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                    </div>
                                </div>
                            </div>

                            <div class="media align-items-center mt-md-0 mt-3" >
                                <a class="btn bg-primary" data-toggle="collapse" href="#collapseEdit<?php echo $rowM['taskId']; ?>"
                                   role="button" aria-expanded="false" aria-controls="collapseEdit1"><i
                                        class="ri-edit-circle-fill m-0"></i> Check</a>
                            </div>
                        </div>
                        <div class="collapse" id="collapseEdit<?php echo $rowM['taskId']; ?>">
                            <div class="card card-list task-card">

                                <div class="card-body">
                                    <?php
                                    $queryDetails = $db->prepare("SELECT H.user_task_id,H.user_task_status,A.* FROM user_has_tasks AS H
INNER JOIN activities AS A ON A.taskId = H.taskId AND  A.activityId = H.activityId
WHERE H.user_id = '$user_id' AND H.taskId = '".$rowM['taskId']."' ");
                                    $queryDetails->execute();
                                    while ($rowD = $queryDetails->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <div class="form-group mb-0">
                                                        <label for="exampleInputText2" class="h5"><?php echo $rowD['activity_name']; ?></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group mb-0">
                                                        <label for="exampleInputText3" class="h5"><?php echo $rowD['activity_description']; ?></label>

                                                    </div>

                                                </div><div class="col-lg-2">
                                                    <div class="form-group mb-0">
                                                        <label for="exampleInputText3" class="h5"><?php echo $rowD['date_start']; ?></label>

                                                    </div>

                                                </div><div class="col-lg-2">
                                                    <div class="form-group mb-0">
                                                        <label for="exampleInputText3" class="h5"><?php echo $rowD['date_complete']; ?></label>

                                                    </div>

                                                </div><div class="col-lg-2">
                                                    <div class="form-group mb-0">
                                                        <label for="exampleInputText3" class="h5">
                                                            <?php if ($rowD['user_task_status'] == 0) { ?>
                                                                <span class="badge badge-light-gray">Pending</span>
                                                            <?php } ?>

                                                            <?php if ($rowD['user_task_status'] == 1) { ?>
                                                                <span class="badge bg-primary">Start</span>
                                                            <?php } ?>

                                                            <?php if ($rowD['user_task_status'] == 2) { ?>
                                                                <span class="badge bg-gradient-cyan">Working</span>
                                                            <?php } ?>

                                                            <?php if ($rowD['user_task_status'] == 3) { ?>
                                                                <span class="badge bg-warning">Hold</span>
                                                            <?php } ?>

                                                            <?php if ($rowD['user_task_status'] == 4) { ?>
                                                                <span class="badge bg-success">Completed</span>
                                                            <?php } ?>

                                                        </label>

                                                    </div>

                                                </div><div class="col-lg-2">
                                                    <div class="form-group mb-0">
                                                        <label for="exampleInputText3" class="h5"></label>
                                                        <?php if ($rowD['user_task_status'] == 0) { ?>
                                                            <a class="btn btn-sm bg-primary" data-toggle="tooltip" data-placement="top"
                                                               title=""
                                                               data-original-title="Start" href="#"
                                                               onclick="changeStatus(<?php echo $rowD['user_task_id']; ?>,1);">Start</a>
                                                        <?php } ?>

                                                        <?php if ($rowD['user_task_status'] == 1) { ?>
                                                            <a class="btn btn-sm bg-gradient-cyan" data-toggle="tooltip" data-placement="top"
                                                               title=""
                                                               data-original-title="Working" href="#"
                                                               onclick="changeStatus(<?php echo $rowD['user_task_id']; ?>,2);">Working</a>
                                                        <?php } ?>

                                                        <?php if ($rowD['user_task_status'] == 2) { ?>
                                                            <a class="btn btn-sm bg-warning" data-toggle="tooltip" data-placement="top"
                                                               title=""
                                                               data-original-title="Hold" href="#"
                                                               onclick="changeStatus(<?php echo $rowD['user_task_id']; ?>,3);">Hold</a>

                                                            <a class="btn btn-sm bg-success" data-toggle="tooltip" data-placement="top"
                                                               title=""
                                                               data-original-title="Completed" href="#"
                                                               onclick="changeStatus(<?php echo $rowD['user_task_id']; ?>,4);">Completed</a>
                                                        <?php } ?>

                                                        <?php if ($rowD['user_task_status'] == 3) { ?>
                                                            <a class="btn btn-sm bg-gradient-cyan" data-toggle="tooltip" data-placement="top"
                                                               title=""
                                                               data-original-title="Working" href="#"
                                                               onclick="changeStatus(<?php echo $rowD['user_task_id']; ?>,2);">Working</a>

                                                            <a class="btn btn-sm bg-success" data-toggle="tooltip" data-placement="top"
                                                               title=""
                                                               data-original-title="Completed" href="#"
                                                               onclick="changeStatus(<?php echo $rowD['user_task_id']; ?>,4);">Completed</a>
                                                        <?php } ?>

                                                        <?php if ($rowD['user_task_status'] == 4) { ?>
                                                            <span class="badge bg-success">Completed</span>
                                                        <?php } ?>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>



                    </div>

                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<!-- Wrapper End-->

<?php
include_once('Common/footer.php');
?>
<script type="text/javascript">
    function changeStatus(activityID,status) {
        Swal.fire({
            title: "Are you sure?",
            text: "You want to change status?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, change it!"
        }).then((result) => {
            if (result.isConfirmed) {
            var url = '../backend/ActivityManager.php?RequstType=ChangeStatus';
            url += '&activity_id=' + encodeURIComponent(activityID);
            url += '&activity_status=' + encodeURIComponent(status);
            var htmlobj = $.ajax({url: url, async: false});

            if (htmlobj.responseXML.getElementsByTagName("Result")[0].childNodes[0].nodeValue == "TRUE") {
                Swal.fire({
                    title: "Success",
                    text: htmlobj.responseXML.getElementsByTagName("Message")[0].childNodes[0].nodeValue,
                    icon: "success"
                });
                setTimeout(function(){
                    location.reload();
                }, 2000);
            } else {
                Swal.fire({
                    title: "Warning",
                    text: htmlobj.responseXML.getElementsByTagName("Message")[0].childNodes[0].nodeValue,
                    icon: "warning"
                });
            }
        }
    });
    }
</script>
