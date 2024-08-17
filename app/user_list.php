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
                        $query = $db->prepare("SELECT  user_id,name,email,telephone,user_status FROM users ");
                        $query->execute();
                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) { ?>

                            <tr>
                                <td> <?php echo $row['user_id']; ?></td>
                                <td> <?php echo $row['name']; ?></td>
                                <td> <?php echo $row['email']; ?></td>
                                <td> <?php echo $row['telephone']; ?></td>
                                <td> <?php if ($row['user_status'] == 1) {?>
                                        <span class="badge bg-success">active</span>
                                    <?php  } else {?>
                                        <span class="badge bg-danger-light">Inactive</span>
                                    <?php  } ?></td>
                                <td>
                                    <div class="flex align-items-center list-user-action">
                                        <a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top"
                                           title=""
                                           data-original-title="View" href="#"><i class="ri-file-paper-line mr-0"></i></a>
                                        <a class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
                                           title=""
                                           data-original-title="Edit" href="#"><i class="ri-pencil-line mr-0"></i></a>
                                        <a class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                                           title=""
                                           data-original-title="Delete" href="#"><i class="ri-delete-bin-line mr-0"></i></a>
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

</script>


