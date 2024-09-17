<?php
$pageTitle = 'Activity Add';

include_once('Common/header.php');
$is_activity = 1;
$is_activity_add = 1;
include_once('Common/menu.php');

if ($userType != 'A') { ?>
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
                    <h4 class="card-title">New Activity Information</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="new-user-info">
                    <form>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="user_name">Task Name:</label>
                                <select class="form-control mb-3" id="task_id">
                                    <option value="" selected="">Select Task</option>
                                    <?php
                                    $query = $db->prepare("SELECT taskId,task_name FROM tasks WHERE task_status = '1'");
                                    $query->execute();
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) { ?>

                                    <option value="<?php echo $row['taskId']; ?>"><?php echo $row['task_name']; ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="user_name">Activity Name:</label>
                                <input type="text" class="form-control" id="activity_name" placeholder="Enter Activity Name">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="mobno">Date Start:</label>
                                <input type="date" class="form-control" id="date_start" placeholder="Enter Date Start">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="mobno">Date Complete:</label>
                                <input type="date" class="form-control" id="date_complete" placeholder="Enter Date Complete">
                            </div>


                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="user_name">Activity Description:</label>
                                <input type="text" class="form-control" id="activity_description"
                                       placeholder="Enter Activity Description">
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary pull-right" onclick="save();">Add New Activity</button>
                        <a href="dashboard.php">
                            <button type="button" class="btn btn-danger pull-right">Close</button>
                        </a>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Wrapper End-->

<?php
include_once('Common/footer.php');
?>
<script type="text/javascript">
    function save() {
        if (document.getElementById('task_id').value == "") {
            myNotification({
                message: 'Task Name is required.'
            });
        } else if (document.getElementById('activity_name').value == "") {
            myNotification({
                message: 'Activity Name is required.'
            });
        }
        else if (document.getElementById('date_start').value == "") {
            myNotification({
                message: 'Date Start is required.'
            });
        }
        else if (document.getElementById('date_complete').value == "") {
            myNotification({
                message: 'Date Complete is required.'
            });
        }
        else if (document.getElementById('activity_description').value == "") {
            myNotification({
                message: 'Activity Description is required.'
            });
        } else {

            var urlCTask = '../backend/ActivityManager.php?RequstType=CheckActivityName';
            urlCTask += '&task_id=' + encodeURIComponent(document.getElementById('task_id').value);
            urlCTask += '&activity_name=' + encodeURIComponent(document.getElementById('activity_name').value);
            var htmlobjCTask = $.ajax({url: urlCTask, async: false});
            if (htmlobjCTask.responseXML.getElementsByTagName("Result")[0].childNodes[0].nodeValue == "TRUE") {
                myNotification({
                    message: 'Activity Name already exist.'
                });
            } else {

                var url = '../backend/ActivityManager.php?RequstType=SaveNewActivity';
                url += '&task_id=' + encodeURIComponent(document.getElementById('task_id').value);
                url += '&activity_name=' + encodeURIComponent(document.getElementById('activity_name').value);
                url += '&date_start=' + encodeURIComponent(document.getElementById('date_start').value);
                url += '&date_complete=' + encodeURIComponent(document.getElementById('date_complete').value);
                url += '&activity_description=' + encodeURIComponent(document.getElementById('activity_description').value);
                var htmlobj = $.ajax({url: url, async: false});
                if (htmlobj.responseXML.getElementsByTagName("Result")[0].childNodes[0].nodeValue == "TRUE") {
                    Swal.fire({
                        title: "Success",
                        text: htmlobj.responseXML.getElementsByTagName("Message")[0].childNodes[0].nodeValue,
                        icon: "success"
                    });
                    setTimeout(function () {
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
        }
    }
</script>


