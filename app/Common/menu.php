<!-- Wrapper Start -->
<div class="wrapper">

    <div class="iq-sidebar  sidebar-default ">
        <div class="iq-sidebar-logo d-flex align-items-center">
            <a href="../app/dashboard.php" class="header-logo">
                <!--                <img src="../assets/images/logo.svg" alt="logo">-->
                <h3 class="logo-title light-logo">Task Manager</h3>
            </a>
            <div class="iq-menu-bt-sidebar ml-0">
                <i class="las la-bars wrapper-menu"></i>
            </div>
        </div>
        <div class="data-scrollbar" data-scroll="1">
            <nav class="iq-sidebar-menu">
                <ul id="iq-sidebar-toggle" class="iq-menu">


                    <li class="">

                        <ul id="otherpage" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li <?php if ($is_dashboard == 1) { ?>      class="active" <?php } ?> >
                                <a href="../app/dashboard.php" class="svg-icon">
                                    <svg class="svg-icon" width="25" height="25" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                    <span class="ml-4">Dashboard  </span>
                                </a>
                            </li>

                            <li <?php if ($is_user == 1) { ?>      class="active" <?php } ?> >
                                <a href="#user" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                    <svg class="svg-icon" width="25" height="25" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span class="ml-4">User</span>
                                    <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                    <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                                </a>
                                <ul id="user" class="iq-submenu collapse" data-parent="#otherpage">
                                    <li <?php if ($is_user_add == 1) { ?>      class="active" <?php } ?>>
                                        <a href="../app/user_add.php">
                                            <i class="las la-minus"></i><span>User Add</span>
                                        </a>
                                    </li>
                                    <li <?php if ($is_user_list == 1) { ?>      class="active" <?php } ?>>
                                        <a href="../app/user_list.php">
                                            <i class="las la-minus"></i><span>User List</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li <?php if ($is_employee == 1) { ?>      class="active" <?php } ?>>
                                <a href="#employee" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                    <svg class="svg-icon" width="25" height="25" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span class="ml-4">Employee</span>
                                    <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                    <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                                </a>
                                <ul id="employee" class="iq-submenu collapse" data-parent="#otherpage">

                                    <li <?php if ($is_employee_add == 1) { ?>      class="active" <?php } ?>>
                                        <a href="../app/employee_add.php">
                                            <i class="las la-minus"></i><span>Employee Add</span>
                                        </a>
                                    </li>
                                    <li <?php if ($is_employee_list == 1) { ?>      class="active" <?php } ?>>
                                        <a href="../app/employee_list.php">
                                            <i class="las la-minus"></i><span>Employee List</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li <?php if ($is_task == 1) { ?>      class="active" <?php } ?>>
                                <a href="#task" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                    <svg class="svg-icon" width="25" height="25" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                                        <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                    </svg>
                                    <span class="ml-4">Task</span>
                                    <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                    <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                                </a>
                                <ul id="task" class="iq-submenu collapse" data-parent="#otherpage">

                                    <li <?php if ($is_task_add == 1) { ?>      class="active" <?php } ?>>
                                        <a href="../app/task_add.php">
                                            <i class="las la-minus"></i><span>Task Add</span>
                                        </a>
                                    </li>
                                    <li <?php if ($is_task_list == 1) { ?>      class="active" <?php } ?>>
                                        <a href="../app/task_list.php">
                                            <i class="las la-minus"></i><span>Task List</span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="../app/user-list.html">
                                            <i class="las la-minus"></i><span>Task Assign</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="">
                                <a href="#activity" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                    <svg class="svg-icon" id="p-dash14" width="20" height="20"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <rect x="3" y="3" width="7" height="7"></rect>
                                        <rect x="14" y="3" width="7" height="7"></rect>
                                        <rect x="14" y="14" width="7" height="7"></rect>
                                        <rect x="3" y="14" width="7" height="7"></rect>
                                    </svg>
                                    <span class="ml-4">Activity</span>
                                    <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                    <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                                </a>
                                <ul id="activity" class="iq-submenu collapse" data-parent="#otherpage">

                                    <li class="">
                                        <a href="../app/user-add.html">
                                            <i class="las la-minus"></i><span>Activity Add</span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="../app/user-list.html">
                                            <i class="las la-minus"></i><span>Activity List</span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="../app/user-list.html">
                                            <i class="las la-minus"></i><span>Activity Allocate</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li <?php if ($is_profile == 1) { ?>      class="active" <?php } ?> >
                                <a href="../app/user_profile.php" class="svg-icon">
                                    <svg class="svg-icon" id="p-dash10" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline>
                                    </svg>
                                    <span class="ml-4">User Profile  </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <div class="pt-5 pb-2"></div>
        </div>
    </div>

    <div class="iq-top-navbar">
        <div class="iq-navbar-custom">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                    <i class="ri-menu-line wrapper-menu"></i>
                    <a href="../../backend/index.html" class="header-logo">
                        <h4 class="logo-title text-uppercase">Webkit</h4>

                    </a>
                </div>
                <div class="navbar-breadcrumb">
                    <h5><?php echo $pageTitle ?></h5>
                </div>
                <div class="d-flex align-items-center">
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-label="Toggle navigation">
                        <i class="ri-menu-3-line"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto navbar-list align-items-center">


                            <li class="nav-item nav-icon nav-item-icon dropdown">
                                <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-bell">
                                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                    </svg>
                                    <span class="bg-primary "></span>
                                </a>
                                <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <div class="card shadow-none m-0">
                                        <div class="card-body p-0 ">
                                            <div class="cust-title p-3">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <h5 class="mb-0">Notifications</h5>
                                                    <a class="badge badge-primary badge-card" href="#">3</a>
                                                </div>
                                            </div>
                                            <div class="px-3 pt-0 pb-0 sub-card">
                                                <a href="#" class="iq-sub-card">
                                                    <div class="media align-items-center cust-card py-3 border-bottom">
                                                        <div class="">
                                                            <img class="avatar-50 rounded-small"
                                                                 src="../assets/images/user/01.jpg" alt="01">
                                                        </div>
                                                        <div class="media-body ml-3">
                                                            <div
                                                                class="d-flex align-items-center justify-content-between">
                                                                <h6 class="mb-0">Emma Watson</h6>
                                                                <small class="text-dark"><b>12 : 47 pm</b></small>
                                                            </div>
                                                            <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="iq-sub-card">
                                                    <div class="media align-items-center cust-card py-3 border-bottom">
                                                        <div class="">
                                                            <img class="avatar-50 rounded-small"
                                                                 src="../assets/images/user/02.jpg" alt="02">
                                                        </div>
                                                        <div class="media-body ml-3">
                                                            <div
                                                                class="d-flex align-items-center justify-content-between">
                                                                <h6 class="mb-0">Ashlynn Franci</h6>
                                                                <small class="text-dark"><b>11 : 30 pm</b></small>
                                                            </div>
                                                            <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="iq-sub-card">
                                                    <div class="media align-items-center cust-card py-3">
                                                        <div class="">
                                                            <img class="avatar-50 rounded-small"
                                                                 src="../assets/images/user/03.jpg" alt="03">
                                                        </div>
                                                        <div class="media-body ml-3">
                                                            <div
                                                                class="d-flex align-items-center justify-content-between">
                                                                <h6 class="mb-0">Kianna Carder</h6>
                                                                <small class="text-dark"><b>11 : 21 pm</b></small>
                                                            </div>
                                                            <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <a class="right-ic btn btn-primary btn-block position-relative p-2" href="#"
                                               role="button">
                                                View All
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item nav-icon dropdown caption-content">
                                <a href="#" class="search-toggle dropdown-toggle  d-flex align-items-center"
                                   id="dropdownMenuButton4"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="../assets/images/user/user-2.jpg" class="img-fluid rounded-circle"
                                         alt="user">
                                    <div class="caption ml-3">
                                        <h6 class="mb-0 line-height">
                                            <?php

                                            $user_id = $_SESSION['userid'];
                                            $query = $db->prepare("SELECT  name,email,telephone FROM users WHERE (user_id=:user_id)");
                                            $query->execute(array(':user_id' => $user_id));
                                            $row = $query->fetch(PDO::FETCH_ASSOC);
                                                echo $row['name'];

                                            ?>

                                            <i class="las la-angle-down ml-2"></i></h6>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right border-none"
                                    aria-labelledby="dropdownMenuButton">
                                    <li class="dropdown-item d-flex svg-icon">
                                        <svg class="svg-icon mr-0 text-primary" id="h-01-p" width="20"
                                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <a href="../app/user_profile.php">My Profile</a>
                                    </li>

                                    <li class="dropdown-item  d-flex svg-icon border-top">
                                        <svg class="svg-icon mr-0 text-primary" id="h-05-p" width="20"
                                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        <a href="#" onclick="logout();">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>