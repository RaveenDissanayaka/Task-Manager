<?php
$pageTitle = 'Task List';

include_once('Common/header.php');
$is_task = 1;
$is_task_list = 1;
include_once('Common/menu.php');

?>
<div class="content-page">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Task List</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table data-table table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Task Name</th>
                            <th>Closing Date</th>
                            <th>Task Description</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = $db->prepare("SELECT  taskId,task_name,closing_date,task_description,task_status FROM tasks ");
                        $query->execute();
                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) { ?>

                            <tr>
                                <td> <?php echo $row['taskId']; ?></td>
                                <td> <?php echo $row['task_name']; ?></td>
                                <td> <?php echo $row['closing_date']; ?></td>
                                <td> <?php echo $row['task_description']; ?></td>
                                <td> <?php if ($row['task_status'] == 1) { ?>
                                        <span class="badge bg-success">active</span>
                                    <?php } else { ?>
                                        <span class="badge bg-danger-light">Inactive</span>
                                    <?php } ?></td>
                                <td>
                                    <div class="flex align-items-center list-user-action">
                                        <a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top"
                                           title=""
                                           data-original-title="View" href="#"
                                           onclick="viewRow(<?php echo $row['taskId']; ?>);"><i
                                                class="ri-file-paper-line mr-0"></i></a>
                                        <?php if ($row['task_status'] == 1) { ?>
                                            <a class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
                                               title=""
                                               data-original-title="Edit" href="#"
                                               onclick="editRow(<?php echo $row['taskId']; ?>);"><i
                                                    class="ri-pencil-line mr-0"></i></a>
                                            <a class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                                               title=""
                                               data-original-title="Delete" href="#"
                                               onclick="deleteRow(<?php echo $row['taskId']; ?>);"><i
                                                    class="ri-delete-bin-line mr-0"></i></a>

                                        <?php } else { ?>
                                            <a class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top"
                                               title=""
                                               data-original-title="Active" href="#"
                                               onclick="activeRow(<?php echo $row['taskId']; ?>);"><i
                                                    class="ri-account-box-fill mr-0"></i></a>
                                        <?php } ?>
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
    </div>
</div>

<!-- Wrapper End-->

<?php
include_once('Common/footer.php');
?>
<script type="text/javascript">
    function viewRow(id) {
        $('#taskViewModal').modal('show');
        var url = '../backend/TaskManager.php?RequstType=GetTask';
        url += '&task_id=' + encodeURIComponent(id);
        var htmlobj = $.ajax({url: url, async: false});
        document.getElementById('task_name').innerHTML = htmlobj.responseXML.getElementsByTagName("TaskName")[0].childNodes[0].nodeValue;
        document.getElementById('closing_date').innerHTML = htmlobj.responseXML.getElementsByTagName("ClosingDate")[0].childNodes[0].nodeValue;
        document.getElementById('task_description').innerHTML = htmlobj.responseXML.getElementsByTagName("TaskDascription")[0].childNodes[0].nodeValue;
        if(htmlobj.responseXML.getElementsByTagName("TaskStatus")[0].childNodes[0].nodeValue == 1) {
             document.getElementById("active_status").style.display= 'block';
          document.getElementById("delete_status").style.display= 'none';
        }else{
             document.getElementById("active_status").style.display= 'none';
            document.getElementById("delete_status").style.display= 'block';
        }
    }
    function editRow(id) {
        $('#taskEditModal').modal('show');
        var url = '../backend/TaskManager.php?RequstType=GetTask';
        url += '&task_id=' + encodeURIComponent(id);
        var htmlobj = $.ajax({url: url, async: false});
        document.getElementById('edit_task_id').value = id;
        document.getElementById('edit_task_name').value = htmlobj.responseXML.getElementsByTagName("TaskName")[0].childNodes[0].nodeValue;
        document.getElementById('edit_closing_date').value = htmlobj.responseXML.getElementsByTagName("ClosingDate")[0].childNodes[0].nodeValue;
        document.getElementById('edit_task_description').value = htmlobj.responseXML.getElementsByTagName("TaskDascription")[0].childNodes[0].nodeValue;

    }

    function deleteRow(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You want to delete this record?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
            var url = '../backend/TaskManager.php?RequstType=DeleteTask';
            url += '&task_id=' + encodeURIComponent(id);
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
    function activeRow(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You want to active this record?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, active it!"
        }).then((result) => {
            if (result.isConfirmed) {
            var url = '../backend/TaskManager.php?RequstType=ActiveTask';
            url += '&task_id=' + encodeURIComponent(id);
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
    function updateTask()
    {

        if (document.getElementById('edit_task_name').value == "") {
            myNotification({
                message: 'Task Name is required.'
            });
        } else if (document.getElementById('edit_closing_date').value == "") {
            myNotification({
                message: 'Closing Date is required.'
            });
        }  else{
            var urlCUser = '../backend/TaskManager.php?RequstType=CheckTaskNameWithID';
            urlCUser += '&task_id=' + encodeURIComponent(document.getElementById('edit_task_id').value);
            urlCUser += '&task_name=' + encodeURIComponent(document.getElementById('edit_task_name').value);
            var htmlobjCUser = $.ajax({url: urlCUser, async: false});
            if (htmlobjCUser.responseXML.getElementsByTagName("Result")[0].childNodes[0].nodeValue == "TRUE") {
                myNotification({
                    message: 'Task Name already exist.'
                });
            }else{
                var url = '../backend/TaskManager.php?RequstType=UpdateTask';
                url += '&task_id=' + encodeURIComponent(document.getElementById('edit_task_id').value);
                url += '&task_name=' + encodeURIComponent(document.getElementById('edit_task_name').value);
                url += '&closing_date=' + encodeURIComponent(document.getElementById('edit_closing_date').value);
                url += '&task_description=' + encodeURIComponent(document.getElementById('edit_task_description').value);
                var htmlobj = $.ajax({url: url, async: false});

                if (htmlobj.responseXML.getElementsByTagName("Result")[0].childNodes[0].nodeValue == "TRUE") {
                    $('#userEditModal').modal('hide');
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
        }
    }

</script>


<!-- Task View Modal -->
<div class="modal fade" id="taskViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Task Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group col-md-12">
                    <label style="font-size: 14px;" for="user_name">Task Name : </label>
                    <b><label id="task_name"></label></b>
                </div>
                <div class="form-group col-md-12">
                    <label style="font-size: 14px;" for="user_name">Closing Date : </label>
                    <b><label id="closing_date"></label></b>
                </div>
                <div class="form-group col-md-12">
                    <label style="font-size: 14px;" for="user_name">Task Description : </label>
                    <b><label id="task_description"></label></b>
                </div>
                <div class="form-group col-md-12">
                    <label style="font-size: 14px;" for="user_name">Status : </label>
                    <span style="display: none;" id="active_status" class="badge bg-success col-md-2">Active</span>
                    <span style="display: none;" id="delete_status" class="badge bg-danger-light col-md-2">Inactive</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Task Edit Modal -->
<div class="modal fade" id="taskEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Task Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" readonly class="form-control" id="edit_task_id" placeholder="Enter Password">
                <div class="form-group col-md-12">
                    <label style="font-size: 14px;" for="user_name">Task Name : </label>
                    <input type="text" class="form-control" id="edit_task_name" placeholder="Enter Task Name">
                </div>
                <div class="form-group col-md-12">
                    <label style="font-size: 14px;" for="user_name">Closing Date : </label>
                    <input type="date" class="form-control" id="edit_closing_date" placeholder="Enter Closing Date">
                </div>
                <div class="form-group col-md-12">
                    <label style="font-size: 14px;" for="user_name">Task Description : </label>
                    <input type="text" class="form-control" id="edit_task_description" placeholder="Enter Task Description" >
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateTask();">Save</button>
            </div>
        </div>
    </div>
</div>