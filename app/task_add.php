<?php
$pageTitle = 'Task Add';

include_once('Common/header.php');
$is_task = 1;
$is_task_add = 1;
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
                    <h4 class="card-title">New Task Information</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="new-user-info">
                    <form>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="user_name">Task Name:</label>
                                <input type="text" class="form-control" id="task_name" placeholder="Enter Task Name">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="mobno">Closing Date:</label>
                                <input type="date" class="form-control" id="closing_date" placeholder="Closing Date">
                            </div>


                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="user_name">Task Description:</label>
                                <input type="text" class="form-control" id="task_description"
                                       placeholder="Enter Task Description">
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary pull-right" onclick="save();">Add New Task</button>
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
        if (document.getElementById('task_name').value == "") {
            myNotification({
                message: 'Task Name is required.'
            });
        } else if (document.getElementById('closing_date').value == "") {
            myNotification({
                message: 'Closing Date is required.'
            });
        } else {

            var urlCTask = '../backend/TaskManager.php?RequstType=CheckTaskName';
            urlCTask += '&task_name=' + encodeURIComponent(document.getElementById('task_name').value);
            var htmlobjCTask = $.ajax({url: urlCTask, async: false});
            if (htmlobjCTask.responseXML.getElementsByTagName("Result")[0].childNodes[0].nodeValue == "TRUE") {
                myNotification({
                    message: 'Task Name already exist.'
                });
            } else {

                var url = '../backend/TaskManager.php?RequstType=SaveNewTask';
                url += '&task_name=' + encodeURIComponent(document.getElementById('task_name').value);
                url += '&closing_date=' + encodeURIComponent(document.getElementById('closing_date').value);
                url += '&task_description=' + encodeURIComponent(document.getElementById('task_description').value);
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


