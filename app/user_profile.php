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
                                value=" <?php echo $row['name'];?>" >
                            </div>

                            <div class="form-group col-md-6">
                                <label for="mobno">Mobile Number:</label>
                                <input type="text" class="form-control" id="mobile_no" placeholder="Enter Mobile Number"
                                       maxlength="10" value=" <?php echo $row['telephone'];?>" >
                            </div>

                        </div>
                        <hr>
                        <h5 class="mb-3">Security</h5>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="uname">E mail:</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter E mail" readonly
                                       value=" <?php echo $row['email'];?>" >
                            </div>

                        </div>

                        <button type="button" class="btn btn-primary pull-right" onclick="save();">Update</button>
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
        var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

        if (document.getElementById('user_name').value == "") {
            myNotification({
                message: 'Name is required.'
            });
        } else if (document.getElementById('mobile_no').value == "") {
            myNotification({
                message: 'Mobile No is required.'
            });
        } else if (document.getElementById('email').value == "") {
            myNotification({
                message: 'E mail is required.'
            });
        }
        else if (!document.getElementById('email').value.match(validRegex)) {
            myNotification({
                message: 'E mail is not valid.'
            });
        }
        else if (document.getElementById('pass').value == "") {
            myNotification({
                message: 'Password is required.'
            });
        } else if (document.getElementById('pass').value.length < 5) {
            myNotification({
                message: 'Password contains at least 5 characters.'
            });
        }
        else if (document.getElementById('rpass').value == "") {
            myNotification({
                message: 'Repeat Password is required.'
            });
        } else if (document.getElementById('pass').value != document.getElementById('rpass').value) {
            myNotification({
                message: 'Password and Repeat Password should be same.'
            });
        } else {

            var urlCUser = '../backend/UserManager.php?RequstType=CheckUserEmail';
            urlCUser += '&email=' + encodeURIComponent(document.getElementById('email').value);
            var htmlobjCUser = $.ajax({url: urlCUser, async: false});
            if (htmlobjCUser.responseXML.getElementsByTagName("Result")[0].childNodes[0].nodeValue == "TRUE") {
                myNotification({
                    message: 'E-mail already exist.'
                });
            } else {

                var url = '../backend/UserManager.php?RequstType=SaveNewUser';
                url += '&user_name=' + encodeURIComponent(document.getElementById('user_name').value);
                url += '&mobile_no=' + encodeURIComponent(document.getElementById('mobile_no').value);
                url += '&email=' + encodeURIComponent(document.getElementById('email').value);
                url += '&password=' + encodeURIComponent(document.getElementById('pass').value);
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


