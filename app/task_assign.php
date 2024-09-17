<?php
$pageTitle = 'Task Assign';

include_once('Common/header.php');
$is_task_assign = 1;
include_once('Common/menu.php');

?>
<div class="content-page">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Task Assign to Employee</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="user_name">Employee Name:</label>
                        <select class="form-control mb-3" id="employee_id">
                            <option value="" selected="">Select Employee</option>
                            <?php
                            $query = $db->prepare("SELECT user_id,name,email FROM users WHERE user_type = 'E' AND user_status = '1' ORDER BY name");
                            $query->execute();
                            while ($row = $query->fetch(PDO::FETCH_ASSOC)) { ?>

                                <option
                                    value="<?php echo $row['user_id']; ?>"><?php echo $row['name'] . ' - ' . $row['email']; ?></option>
                            <?php }
                            ?>
                        </select>


                        <div class="table-responsive">
                            <table id="tasksTable" class="table ">
                                <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>Task Name</th>
                                    <th>Closing Date</th>
                                    <th>Task Description</th>
                                    <th>Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $query = $db->prepare("SELECT  taskId,task_name,closing_date,task_description,task_status
FROM tasks WHERE task_status = '1'
ORDER BY task_name");
                                $query->execute();
                                while ($row = $query->fetch(PDO::FETCH_ASSOC)) { ?>

                                    <tr>
                                        <td><input type="checkbox"/></td>
                                        <td id="<?php echo $row['taskId']; ?>"> <?php echo $row['task_name']; ?></td>
                                        <td> <?php echo $row['closing_date']; ?></td>
                                        <td> <?php echo $row['task_description']; ?></td>

                                        <td>
                                            <div class="flex align-items-center list-user-action">
                                                <a class="btn btn-sm btn-primary" data-toggle="tooltip"
                                                   data-placement="top"
                                                   title=""
                                                   data-original-title="View Activities" href="#"
                                                   onclick="viewActivities(<?php echo $row['taskId']; ?>);"><i
                                                        class="ri-file-paper-line mr-0"></i></a>

                                            </div>
                                        </td>
                                    </tr>
                                <?php }
                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary pull-right" onclick="assignTask();">Assign Task</button>
                <a href="dashboard.php">
                    <button type="button" class="btn btn-danger pull-right">Close</button>
                </a>
            </div>
        </div>
    </div>

    <!-- Wrapper End-->

    <?php
    include_once('Common/footer.php');
    ?>
    <script type="text/javascript">
        function assignTask() {
            if (document.getElementById('employee_id').value == "") {
                myNotification({
                    message: 'Employee Name is required.'
                });
            }else{
                var table = document.getElementById("tasksTable");

                if(table.rows.length == 1){
                    myNotification({
                        message: 'No task available.'
                    });
                }else{
                    var selectedRows = 0;
                    for (var i = 1; i < table.rows.length; i++) {
                        if(table.rows[i].cells[0].childNodes[0].checked == true){
                            selectedRows++;
                        }

                    }
                    if(selectedRows ==0){
                        myNotification({
                            message: 'Please select at least one task.'
                        });
                    }else{

                        for (var j = 1; j < table.rows.length; j++) {
                            if(table.rows[j].cells[0].childNodes[0].checked == true){
                                var url = '../backend/TaskManager.php?RequstType=AssignTask';
                                url += '&employee_id=' + encodeURIComponent(document.getElementById('employee_id').value);
                                url += '&task_id=' + encodeURIComponent(table.rows[j].cells[1].id);
                                var htmlobj = $.ajax({url: url, async: false});
                            }

                        }

                        Swal.fire({
                            title: "Success",
                            text: 'Tasks assign successfully',
                            icon: "success"
                        });
                        setTimeout(function(){
                            location.reload();
                        }, 2000);
                    }
                }


            }
        }
        function viewActivities(taskId) {
            $('#activitiesViewModal').modal('show');
            var url = '../backend/ActivityManager.php?RequstType=GetActivityList';
            url += '&task_id=' + encodeURIComponent(taskId);
            var htmlobj = $.ajax({url: url, async: false});
            document.getElementById('edit_task_name').value = htmlobj.responseXML.getElementsByTagName("TaskName")[0].childNodes[0].nodeValue;
        }
    </script>

    <!-- Activities View Modal -->
    <div class="modal fade" id="activitiesViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Activities</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modelBodyTable">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

