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
                        <button type="button" class="btn btn-warning pull-right" onclick="resetPassword();">Reset Password</button>
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

    function resetPassword(id) {
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
            document.getElementById('re_password').value = "";
            document.getElementById('user_id').value = id;
        }
    });
    }
</script>


