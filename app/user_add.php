<?php
$pageTitle = 'User Add';

include_once('Common/header.php');
$is_user = 1;
$is_user_add = 1;
include_once('Common/menu.php');

?>
<div class="content-page">
    <div class="container-fluid">

        
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">New User Information</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="fname">First Name:</label>
                                    <input type="text" class="form-control" id="fname" placeholder="First Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lname">Last Name:</label>
                                    <input type="text" class="form-control" id="lname" placeholder="Last Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="add1">Street Address 1:</label>
                                    <input type="text" class="form-control" id="add1" placeholder="Street Address 1">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="add2">Street Address 2:</label>
                                    <input type="text" class="form-control" id="add2" placeholder="Street Address 2">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="cname">Company Name:</label>
                                    <input type="text" class="form-control" id="cname" placeholder="Company Name">
                                </div>
                                <div class="form-group col-sm-12">
                                    <label>Country:</label>
                                    <select name="type" class="selectpicker form-control" data-style="py-0">
                                        <option>Select Country</option>
                                        <option>Caneda</option>
                                        <option>Noida</option>
                                        <option >USA</option>
                                        <option>India</option>
                                        <option>Africa</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="mobno">Mobile Number:</label>
                                    <input type="text" class="form-control" id="mobno" placeholder="Mobile Number">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="altconno">Alternate Contact:</label>
                                    <input type="text" class="form-control" id="altconno" placeholder="Alternate Contact">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pno">Pin Code:</label>
                                    <input type="text" class="form-control" id="pno" placeholder="Pin Code">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="city">Town/City:</label>
                                    <input type="text" class="form-control" id="city" placeholder="Town/City">
                                </div>
                            </div>
                            <hr>
                            <h5 class="mb-3">Security</h5>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="uname">User Name:</label>
                                    <input type="text" class="form-control" id="uname" placeholder="User Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pass">Password:</label>
                                    <input type="password" class="form-control" id="pass" placeholder="Password">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="rpass">Repeat Password:</label>
                                    <input type="password" class="form-control" id="rpass" placeholder="Repeat Password ">
                                </div>
                            </div>
                            <div class="checkbox">
                                <label><input class="mr-2" type="checkbox">Enable Two-Factor-Authentication</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Add New User</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Wrapper End-->

<?php
include_once('Common/footer.php');
?>


