<?php
$pageTitle = 'Tasks';

include_once('Common/header.php');
$is_employee_task = 1;
include_once('Common/menu.php');

if ($userType != 'E') { ?>
    <script>
        window.location.href = "dashboard.php";
    </script>
    <?php

}
?>
<div class="content-page">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Tasks</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="card card-widget task-card">
                    <div class="card-body">


                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="mb-2">Design landing page of webkit</h5>
                                    <div class="media align-items-center">
                                        <div class="btn bg-body mr-3"><i class="ri-align-justify mr-2"></i>5/10</div>

                                    </div>
                                </div>
                            </div>
                            <div class="media align-items-center mt-md-0 mt-3">
                                <a class="btn bg-secondary-light" data-toggle="collapse" href="#collapseEdit1"
                                   role="button" aria-expanded="false" aria-controls="collapseEdit1"><i
                                        class="ri-edit-box-line m-0"></i></a>
                            </div>
                        </div>
                        <div class="collapse" id="collapseEdit1">
                            <div class="card card-list task-card">
                                <div class="card-body">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-0">
                                                        <label for="exampleInputText2" class="h5">Memebers</label>
                                                        <select name="type" class="selectpicker form-control"
                                                                data-style="py-0">
                                                            <option>Memebers</option>
                                                            <option>Kianna Septimus</option>
                                                            <option>Jaxson Herwitz</option>
                                                            <option>Ryan Schleifer</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-0">
                                                        <label for="exampleInputText3" class="h5">Due Dates*</label>
                                                        <input type="date" class="form-control" id="exampleInputText3"
                                                               value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



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
<script type="text/javascript">

</script>
