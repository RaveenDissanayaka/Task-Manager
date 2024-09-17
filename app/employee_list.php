<?php
$pageTitle = 'Employee List';

include_once('Common/header.php');
$is_employee = 1;
$is_employee_list = 1;
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
                    <h4 class="card-title">Employee List</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table data-table table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Mobile No</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = $db->prepare("SELECT  user_id,name,email,telephone,user_status FROM users WHERE user_type = 'E'");
                        $query->execute();
                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) { ?>

                            <tr>
                                <td> <?php echo $row['user_id']; ?></td>
                                <td> <?php echo $row['name']; ?></td>
                                <td> <?php echo $row['email']; ?></td>
                                <td> <?php echo $row['telephone']; ?></td>
                                <td> <?php if ($row['user_status'] == 1) { ?>
                                        <span class="badge bg-success">active</span>
                                    <?php } else { ?>
                                        <span class="badge bg-danger-light">Inactive</span>
                                    <?php } ?></td>
                                <td>
                                    <div class="flex align-items-center list-user-action">
                                        <a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top"
                                           title=""
                                           data-original-title="View" href="#"
                                           onclick="viewRow(<?php echo $row['user_id']; ?>);"><i
                                                class="ri-file-paper-line mr-0"></i></a>
                                        <?php if ($row['user_status'] == 1) { ?>
                                            <a class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
                                               title=""
                                               data-original-title="Edit" href="#"
                                               onclick="editRow(<?php echo $row['user_id']; ?>);"><i
                                                    class="ri-pencil-line mr-0"></i></a>
                                            <a class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                                               title=""
                                               data-original-title="Delete" href="#"
                                               onclick="deleteRow(<?php echo $row['user_id']; ?>);"><i
                                                    class="ri-delete-bin-line mr-0"></i></a>
                                            <a class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top"
                                               title=""
                                               data-original-title="Reset Password" href="#"
                                               onclick="resetRow(<?php echo $row['user_id']; ?>);"><i
                                                    class="ri-key-fill mr-0"></i></a>
                                        <?php } else { ?>
                                            <a class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top"
                                               title=""
                                               data-original-title="Active" href="#"
                                               onclick="activeRow(<?php echo $row['user_id']; ?>);"><i
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
        $('#employeeViewModal').modal('show');
        var url = '../backend/EmployeeManager.php?RequstType=GetEmployee';
        url += '&employee_id=' + encodeURIComponent(id);
        var htmlobj = $.ajax({url: url, async: false});
        document.getElementById('employee_name').innerHTML = htmlobj.responseXML.getElementsByTagName("EmployeeName")[0].childNodes[0].nodeValue;
        document.getElementById('employee_email').innerHTML = htmlobj.responseXML.getElementsByTagName("EmployeeEmail")[0].childNodes[0].nodeValue;
        document.getElementById('employee_mobile').innerHTML = htmlobj.responseXML.getElementsByTagName("EmployeeTelephone")[0].childNodes[0].nodeValue;
        if(htmlobj.responseXML.getElementsByTagName("EmployeeStatus")[0].childNodes[0].nodeValue == 1) {
            document.getElementById("active_status").style.display= 'block';
            document.getElementById("delete_status").style.display= 'none';
        }else{
            document.getElementById("active_status").style.display= 'none';
            document.getElementById("delete_status").style.display= 'block';
        }
    }
    function editRow(id) {
        $('#employeeEditModal').modal('show');
        var url = '../backend/EmployeeManager.php?RequstType=GetEmployee';
        url += '&employee_id=' + encodeURIComponent(id);
        var htmlobj = $.ajax({url: url, async: false});
        document.getElementById('edit_employee_id').value = id;
        document.getElementById('edit_employee_name').value = htmlobj.responseXML.getElementsByTagName("EmployeeName")[0].childNodes[0].nodeValue;
        document.getElementById('edit_employee_email').value = htmlobj.responseXML.getElementsByTagName("EmployeeEmail")[0].childNodes[0].nodeValue;
        document.getElementById('edit_employee_mobile').value = htmlobj.responseXML.getElementsByTagName("EmployeeTelephone")[0].childNodes[0].nodeValue;


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
            var url = '../backend/EmployeeManager.php?RequstType=DeleteEmployee';
            url += '&user_id=' + encodeURIComponent(id);
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
            var url = '../backend/EmployeeManager.php?RequstType=ActiveEmployee';
            url += '&user_id=' + encodeURIComponent(id);
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
    function updateEmployee()
    {
        var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

        if (document.getElementById('edit_employee_name').value == "") {
            myNotification({
                message: 'Name is required.'
            });
        } else if (document.getElementById('edit_employee_mobile').value == "") {
            myNotification({
                message: 'Mobile No is required.'
            });
        } else if (document.getElementById('edit_employee_email').value == "") {
            myNotification({
                message: 'E mail is required.'
            });
        } else if (!document.getElementById('edit_employee_email').value.match(validRegex)) {
            myNotification({
                message: 'E mail is not valid.'
            });
        }else{
            var urlCUser = '../backend/EmployeeManager.php?RequstType=CheckEmployeeEmailWithID';
            urlCUser += '&employee_id=' + encodeURIComponent(document.getElementById('edit_employee_id').value);
            urlCUser += '&email=' + encodeURIComponent(document.getElementById('edit_employee_email').value);
            var htmlobjCUser = $.ajax({url: urlCUser, async: false});
            if (htmlobjCUser.responseXML.getElementsByTagName("Result")[0].childNodes[0].nodeValue == "TRUE") {
                myNotification({
                    message: 'E-mail already exist.'
                });
            }else{
                var url = '../backend/EmployeeManager.php?RequstType=UpdateEmployee';
                url += '&employee_id=' + encodeURIComponent(document.getElementById('edit_employee_id').value);
                url += '&employee_name=' + encodeURIComponent(document.getElementById('edit_employee_name').value);
                url += '&employee_email=' + encodeURIComponent(document.getElementById('edit_employee_email').value);
                url += '&employee_mobile=' + encodeURIComponent(document.getElementById('edit_employee_mobile').value);
                var htmlobj = $.ajax({url: url, async: false});

                if (htmlobj.responseXML.getElementsByTagName("Result")[0].childNodes[0].nodeValue == "TRUE") {
                    $('#employeeEditModal').modal('hide');
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
    function resetRow(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You want to reset employee password?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, reset it!"
        }).then((result) => {
            if (result.isConfirmed) {
            $('#passwordResetModal').modal('show');
            document.getElementById('password').value = "";
            document.getElementById('re_password').value = "";
            document.getElementById('employee_id').value = id;
        }
    });
    }
    function resetPassword()
    {
        if (document.getElementById('password').value == "") {
            myNotification({
                message: 'Password is required.'
            });
        }  else if (document.getElementById('password').value.length < 5) {
            myNotification({
                message: 'Password contains at least 5 characters.'
            });
        }else if (document.getElementById('re_password').value == "") {
            myNotification({
                message: 'Re type password is required.'
            });
        }else if (document.getElementById('password').value != document.getElementById('re_password').value) {
            myNotification({
                message: 'Password and Re type password should be same.'
            });
        }else{
            var url = '../backend/EmployeeManager.php?RequstType=ResetEmployeePassword';
            url += '&employee_id=' + encodeURIComponent(document.getElementById('employee_id').value);
            url += '&new_pass=' + encodeURIComponent(document.getElementById('password').value);
            var htmlobj = $.ajax({url: url, async: false});

            if (htmlobj.responseXML.getElementsByTagName("Result")[0].childNodes[0].nodeValue == "TRUE") {
                $('#passwordResetModal').modal('hide');
                Swal.fire({
                    title: "Success",
                    text: htmlobj.responseXML.getElementsByTagName("Message")[0].childNodes[0].nodeValue,
                    icon: "success"
                });

            } else {
                Swal.fire({
                    title: "Warning",
                    text: htmlobj.responseXML.getElementsByTagName("Message")[0].childNodes[0].nodeValue,
                    icon: "warning"
                });
            }
        }
    }
</script>

<!-- Password Reset Modal -->
<div class="modal fade" id="passwordResetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reset Employee Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" readonly class="form-control" id="employee_id" placeholder="Enter Password">
                <div class="form-group col-md-12">
                    <label for="user_name">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter Password">
                </div>
                <div class="form-group col-md-12">
                    <label for="user_name">Re type password</label>
                    <input type="password" class="form-control" id="re_password" placeholder="Re type password">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="resetPassword();">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Employee View Modal -->
<div class="modal fade" id="employeeViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Employee Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" readonly class="form-control" id="user_id" placeholder="Enter Password">
                <div class="form-group col-md-12">
                    <label style="font-size: 14px;" for="employee_name">Name : </label>
                    <b><label id="employee_name"></label></b>
                </div>
                <div class="form-group col-md-12">
                    <label style="font-size: 14px;" for="employee_name">E-mail : </label>
                    <b><label id="employee_email"></label></b>
                </div>
                <div class="form-group col-md-12">
                    <label style="font-size: 14px;" for="employee_name">Mobile No : </label>
                    <b><label id="employee_mobile"></label></b>
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


<!-- Employee Edit Modal -->
<div class="modal fade" id="employeeEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Employee Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" readonly class="form-control" id="edit_employee_id" placeholder="Enter Password">
                <div class="form-group col-md-12">
                    <label style="font-size: 14px;" for="user_name">Name : </label>
                    <input type="text" class="form-control" id="edit_employee_name" placeholder="Enter Name">
                </div>
                <div class="form-group col-md-12">
                    <label style="font-size: 14px;" for="user_name">E-mail : </label>
                    <input type="text" class="form-control" id="edit_employee_email" placeholder="Enter E-mail">
                </div>
                <div class="form-group col-md-12">
                    <label style="font-size: 14px;" for="user_name">Mobile No : </label>
                    <input type="text" class="form-control" id="edit_employee_mobile" placeholder="Enter Mobile No">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateEmployee();">Save</button>
            </div>
        </div>
    </div>
</div>
