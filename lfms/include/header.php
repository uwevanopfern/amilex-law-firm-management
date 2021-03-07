<?php session_start();?>
<?php include "include/connection.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <title>LFMS</title>

    <meta name="description" content="overview &amp; stats"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css"/>

    <!-- page specific plugin styles -->

    <!-- text fonts -->
    <link rel="stylesheet" href="assets/css/fonts.googleapis.com.css"/>

    <!-- ace styles -->
    <link rel="stylesheet" href="assets/css/ace.min.css" class="ace-maican-stylesheet" id="main-ace-style"/>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet"/>
    <![endif]-->
    <link rel="stylesheet" href="assets/css/ace-skins.min.css"/>
    <link rel="stylesheet" href="assets/css/ace-rtl.min.css"/>
    <link rel="shortcut icon" href="images/favicon.ico">

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="assets/css/ace-ie.min.css"/>
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="assets/js/ace-extra.min.js"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="no-skin">
<div id="navbar" class="navbar navbar-default ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
            <a href="home.php" class="navbar-brand" style="margin-top:4px;">
                <small>
                    <span style="color:#fff;font-weight:bold;font-family:century gothic;font-size:30px;">LFMS</span>
                </small>
            </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">

                <?php
if (isset($_SESSION['user_id'])) {

    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    $permission = $_SESSION['permission'];
    ?>
                    <li class="purple dropdown-modal">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#" style="background-color: #007399;">
                            <i class="ace-icon fa fa-bell icon-animated-bell"></i>
                            <span class="badge badge-important" style="background-color: #000;">Latest Activities</span>
                        </a>

                        <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-calendar-check-o"></i>

                                <?php

    $select_all = "SELECT * FROM calendar";

    $result_by_all = mysqli_query($db, $select_all);
    $count_all = mysqli_num_rows($result_by_all);
    ?>
                                Total data on calendar :
                                <span style="font-weight: bold;font-size: 18px;"><?php echo $count_all; ?>

                                    </span>
                            </li>

                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar navbar-pink">

                                    <?php

    $today = date('Y-m-d');
    $date = strtotime("+10 day");
    $ten_days = date('Y-m-d', $date);

    $select_case = "SELECT * FROM calendar WHERE its_date between '" . $today . "' AND '" . $ten_days . "' ORDER BY its_date ASC";

    $result_by_case = mysqli_query($db, $select_case);
    while ($row_by_case = mysqli_fetch_array($result_by_case)) {
        $calendar_id = $row_by_case['id'];
        $case_user_id = $row_by_case['user_id'];
        $case_dossier = $row_by_case['dossier'];
        $case_case_date = $row_by_case['its_date'];

        $select_user = "SELECT * FROM users WHERE id = '" . $case_user_id . "'";
        $result_by_selected_user = mysqli_query($db, $select_user);
        while ($row_by_selected_user = mysqli_fetch_array($result_by_selected_user)) {
            $selected_username = $row_by_selected_user['username'];

            ?>
                                            <li>
                                                <a href="view_case.php?dossier_id=<?php echo $calendar_id; ?>">
                                                    <i class="btn btn-xs btn-primary fa fa-user"></i>
                                                    <?php echo "<span class='label label-sm label-primary'>" . $selected_username . "</span>" . ' has added new data on calendar which has date of ' . "<span class='label label-sm label-default'>" . $case_case_date . "</span>"; ?>
                                                </a>
                                            </li>
                                        <?php }
    }?>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="light-blue dropdown-modal">
                        <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                            <img class="nav-user-photo" src="images/a.jpg" alt="Username"/>
                            <span class="user-info">
                                    <small>Welcome,</small>
                                <?php echo $username; ?>
                                </span>

                            <i class="ace-icon fa fa-caret-down"></i>
                        </a>

                        <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                            <?php

    $selectSuperAdmin = "SELECT `permission` FROM users WHERE `id` = $user_id";
    $result = mysqli_query($db, $selectSuperAdmin);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $permission = $row['permission'];

        if ($permission == 1) {

            ?>
                                    <li>
                                        <a href="super_admin_page.php">
                                            <i class="ace-icon fa fa-user"></i>
                                            Super Admin
                                        </a>
                                    </li>
                                <?php }
    }?>
                            <?php

    $selectSuperAdmin = "SELECT `permission` FROM users WHERE `id` = $user_id";
    $result = mysqli_query($db, $selectSuperAdmin);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $permission = $row['permission'];

        if ($permission == 2 or $permission == 1) {

            ?>

                                    <li>
                                        <a href="super_lawyer_page.php">
                                            <i class="ace-icon fa fa-user"></i>
                                            Manage Users
                                        </a>
                                    </li>
                                <?php }
    }?>

                            <li>
                                <a href="profile.php">
                                    <i class="ace-icon fa fa-user"></i>
                                    Profile
                                </a>
                            </li>

                            <li class="divider"></li>

                            <li>
                                <a href="logout.php">
                                    <i class="ace-icon fa fa-power-off"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php
} else {
    ?>
                    <li>
                        <a href="#">
                            <i class="ace-icon fa fa-question-circle"></i>
                            What is LFMS
                        </a>
                    </li>
                    <li>
                        <a href="index.php">
                            <i class="ace-icon fa fa-sign-in"></i>
                            Login
                        </a>
                    </li>
                <?php }?>
            </ul>
        </div>
    </div><!-- /.navbar-container -->
</div>

<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
        try {
            ace.settings.loadState('main-container')
        } catch (e) {
        }
    </script>

    <div id="sidebar" class="sidebar responsive ace-save-state">
        <script type="text/javascript">
            try {
                ace.settings.loadState('sidebar')
            } catch (e) {
            }
        </script>

        <ul class="nav nav-list">
            <li class="active">
                <a href="home.php">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text"> Dashboard </span>
                </a>

                <b class="arrow"></b>
            </li>

            <?php

$select_all_permission = "SELECT * FROM permission WHERE `user_id` = '" . $user_id . "'";
$result_all_permission = mysqli_query($db, $select_all_permission);
while ($row_all = mysqli_fetch_array($result_all_permission)) {
    $permission_all = $row_all['permissions'];

    if ($permission_all == 2) {

        ?>

                    <li class="">
                        <a href="super_lawyer_page.php">
                            <i class="menu-icon fa fa-user"></i>
                            <span class="menu-text"> Manage Users </span>
                        </a>
                    </li>

                <?php } elseif ($permission_all == 3) {
        ?>

                    <li class="">
                        <a href="my_case.php">
                            <i class="menu-icon fa fa-legal"></i>
                            <span class="menu-text"> Manage Cases </span>
                        </a>
                    </li>
                <?php } elseif ($permission_all == 5) {
        ?>
                    <li class="">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-group"></i>
                            <span class="menu-text"> Clients </span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="">
                                <a href="new_client.php">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Add new client
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="">
                                <a href="applicant_reports.php">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Clients report
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="">
                                <a href="retainers.php">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Monitize retainers
                                </a>

                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>
                    <?php
} elseif ($permission_all == 4) {
        ?>

                    <li class="">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-balance-scale"></i>
                            <span class="menu-text"> Stock</span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="">
                                <a href="add_stock.php">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Add stock
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="">
                                <a href="stock_report.php">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Reports
                                </a>

                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>
                    <?php
} elseif ($permission_all == 6) {
        ?>

                    <li class="">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-money"></i>
                            <span class="menu-text"> Expenses</span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="">
                                <a href="expenses.php">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Add expense
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="">
                                <a href="expense_report.php">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Reports by dates
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="">
                                <a href="expense_report_category.php">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Reports by category
                                </a>

                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>
                    <?php
} elseif ($permission_all == 7) {
        ?>

                    <li class="">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-dollar"></i>
                            <span class="menu-text"> Bills </span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="">
                                <a href="billed_fee.php">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Billed fee
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="">
                                <a href="unbilled_fee.php">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Unbilled fee
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <li class="">
                                <a href="cashflow.php">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Cashflow
                                </a>

                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>
                    <?php
} elseif ($permission_all == 8) {
        ?>

                    <li class="">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-list"></i>
                            <span class="menu-text"> Case reports </span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="">
                                <a href="case_by_cat.php">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Report by category
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="">
                                <a href="case_by_date.php">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Report by given date
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="">
                                <a href="closed_case.php">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Report of closed cases
                                </a>

                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>

                    <li class="">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-file-archive-o"></i>
                            <span class="menu-text"> Archives </span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="">
                                <a href="add_archive.php">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Add new archive
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="">
                                <a href="archive_report_by_dates.php">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Archive reports by dates
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="">
                                <a href="archive_report_by_cat.php">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Archive reports by categories
                                </a>

                                <b class="arrow"></b>
                            </li>

                        </ul>
                    </li>

                <?php } elseif ($permission_all == 9) {
        ?>

                    <li class="">
                        <a href="calendar.php">
                            <i class="menu-icon fa fa-calendar-check-o"></i>
                            <span class="menu-text"> Calendar </span>
                        </a>
                    </li>

                <?php } elseif ($permission_all == 10) {
        ?>

                    <li class="">
                        <a href="tasks.php">
                            <i class="menu-icon fa fa-tasks"></i>
                            <span class="menu-text"> Tasks Management </span>
                        </a>
                    </li>

                <?php }
}?>

           <li class="">
                <a href="news.php">
                    <i class="menu-icon fa fa-newspaper-o"></i>
                    <span class="menu-text"> News portal </span>
                </a>
            </li>
    </div>
    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->

<!-- basic scripts -->


</body>
</html>
