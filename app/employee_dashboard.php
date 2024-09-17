<?php
$pageTitle = 'Dashboard';

include_once('Common/header.php');
$is_employee_dashboard = 1;
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

        <div class="row">

        </div>
    </div>
</div>

<!-- Wrapper End-->

<?php
include_once('Common/footer.php');
?>


