<?php
$pageTitle = 'User Profile';

include_once('Common/header.php');
$is_profile = 1;
include_once('Common/menu.php');

?>
<div class="content-page">
    <div class="container-fluid">


        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">User Profile</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="new-user-info">
                    <form>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="user_name">Name:</label>
                                <input type="text" class="form-control" id="user_name" placeholder="Enter Name"
                                value="<?php echo $row['name'];?>" >
                            </div>

                            <div class="form-group col-md-6">
                                <label for="mobno">Mobile Number:</label>
                                <input type="text" class="form-control" id="mobile_no" placeholder="Enter Mobile Number"
                                       maxlength="10" value="<?php echo $row['telephone'];?>" onkeypress="return numbersOnly(event)">
                            </div>

                        </div>
                        <hr>
                        <h5 class="mb-3">Security</h5>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="uname">E mail:</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter E mail" readonly
                                       value="<?php echo $row['email'];?>" >
                            </div>

                        </div>

                        <button type="button" class="btn btn-primary pull-right" onclick="update();">Update</button>
                        <button type="button" class="btn btn-warning pull-right" onclick="resetPass();">Reset Password</button>
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
    function update() {

        if (document.getElementById('user_name').value == "") {
            myNotification({
                message: 'Name is required.'
            });
        } else if (document.getElementById('mobile_no').value == "") {
            myNotification({
                message: 'Mobile No is required.'
            });

        } else {

                var url = '../backend/UserManager.php?RequstType=UpdateUserProfile';
                url += '&user_name=' + encodeURIComponent(document.getElementById('user_name').value);
                url += '&mobile_no=' + encodeURIComponent(document.getElementById('mobile_no').value);
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

    function resetPass(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You want to reset password?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, reset it!"
        }).then((result) => {
            if (result.isConfirmed) {
            $('#passwordResetModal').modal('show');
            document.getElementById('password').value = "";
            document.getElementById('new_password').value = "";
            document.getElementById('re_password').value = "";
            document.getElementById('user_id').value = id;
        }
    });
    }
    function resetPassword()
    {
        if (document.getElementById('password').value == "") {
            myNotification({
                message: 'Existing Password is required.'
            });
        } else if (document.getElementById('new_password').value == "") {
            myNotification({
                message: 'New Password is required.'
            });
        }  else if (document.getElementById('new_password').value.length < 5) {
            myNotification({
                message: 'New Password contains at least 5 characters.'
            });
        }else if (document.getElementById('re_password').value == "") {
            myNotification({
                message: 'Re type password is required.'
            });
        }else if (document.getElementById('new_password').value != document.getElementById('re_password').value) {
            myNotification({
                message: 'New Password and Re type password should be same.'
            });
        }else{
            var url = '../backend/UserManager.php?RequstType=ResetUserPasswordByUser';
            url += '&password=' + encodeURIComponent(document.getElementById('password').value);
            url += '&new_pass=' + encodeURIComponent(document.getElementById('new_password').value);
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
                <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group col-md-12">
                    <label for="user_name">Existing Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter Existing Password">
                </div>
                <div class="form-group col-md-12">
                    <label for="user_name">New Password</label>
                    <input type="password" class="form-control" id="new_password" placeholder="Enter New Password">
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