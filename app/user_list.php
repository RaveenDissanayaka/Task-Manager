<?php
$pageTitle = 'User List';

include_once('Common/header.php');
$is_user = 1;
$is_user_list = 1;
include_once('Common/menu.php');

?>
<div class="content-page">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">User List</h4>
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
                        $query = $db->prepare("SELECT  user_id,name,email,telephone,user_status FROM users WHERE user_type = 'A'");
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
        $('#userViewModal').modal('show');
        var url = '../backend/UserManager.php?RequstType=GetUser';
        url += '&user_id=' + encodeURIComponent(id);
        var htmlobj = $.ajax({url: url, async: false});
        document.getElementById('user_name').innerHTML = htmlobj.responseXML.getElementsByTagName("UserName")[0].childNodes[0].nodeValue
        document.getElementById('user_email').innerHTML = htmlobj.responseXML.getElementsByTagName("UserEmail")[0].childNodes[0].nodeValue
        document.getElementById('user_mobile').innerHTML = htmlobj.responseXML.getElementsByTagName("UserTelephone")[0].childNodes[0].nodeValue
    }
    function editRow(id) {

    }
    function resetRow(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You want to reset user password?",
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
            document.getElementById('user_id').value = id;
        }
    });
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
            var url = '../backend/UserManager.php?RequstType=DeleteUser';
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
            var url = '../backend/UserManager.php?RequstType=ActiveUser';
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
            var url = '../backend/UserManager.php?RequstType=ResetUserPassword';
            url += '&user_id=' + encodeURIComponent(document.getElementById('user_id').value);
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
                <h5 class="modal-title" id="exampleModalLabel">Reset User Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" readonly class="form-control" id="user_id" placeholder="Enter Password">
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

<!-- User View Modal -->
<div class="modal fade" id="userViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View User Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" readonly class="form-control" id="user_id" placeholder="Enter Password">
                <div class="form-group col-md-12">
                    <label style="font-size: 14px;" for="user_name">Name : </label>
                    <b><label id="user_name"></label></b>
                </div>
                <div class="form-group col-md-12">
                    <label style="font-size: 14px;" for="user_name">E-mail : </label>
                    <b><label id="user_email"></label></b>
                </div>
                <div class="form-group col-md-12">
                    <label style="font-size: 14px;" for="user_name">Mobile No : </label>
                    <b><label id="user_mobile"></label></b>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>