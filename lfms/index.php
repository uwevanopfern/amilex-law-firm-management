<?php error_reporting(E_ALL & ~E_NOTICE & E_WARNING & E_PARSE & E_ERROR); ?>
<?php session_start(); ?>
<?php include("include/connection.php"); ?>
<?php

function sendAlert()
{

    include("include/connection.php");

    $headers = "From: LFMS<info@lfmsystem.com>" . "\r\n" .

        $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n";

    $recipients = "uweaime@gmail.com,pihabimana@gmail.com,uwizeyimana@amilex.rw,irazirikana014@amilex.rw,pihabimana@amilex.rw";

    $today = date('Y-m-d');
    $date = strtotime("+10 day");
    $ten_days = date('Y-m-d', $date);

    $select_from_calendar = "SELECT * FROM calendar WHERE its_date between '" . $today . "' AND '" . $ten_days . "' ORDER BY its_date ASC";

    $result_from_calendar = mysqli_query($db, $select_from_calendar);
    if (mysqli_num_rows($result_from_calendar) > 0) {

        $output .= '
          <table border="1" cellspacing="0" cellpadding="3">
              <tr>
                  <th>#</th>
                  <th>Dossier</th>
                  <th>Institution</th>
                  <th>Status</th>
                  <th>Nature</th>
                  <th>Date</th>
                  <th>Lead Counsel</th
                  <th>Observation</th>
              </tr>
         ';

        $initial = 1;

        while ($row_by_calendar = mysqli_fetch_array($result_from_calendar)) {

            $dossier = $row_by_calendar['dossier'];
            $institution = $row_by_calendar['institution'];
            $status = $row_by_calendar['status'];
            $nature = $row_by_calendar['nature'];
            $its_date = $row_by_calendar['its_date'];
            $lead_counsel = $row_by_calendar['lead_counsel'];
            $observation = $row_by_calendar['observation'];

            $initial = 1;
            $initial_number++;

            $output .= '
                  <tr>
                      <td>' . $initial_number . '</td>
                      <td>' . $dossier . '</td>
                      <td>' . $institution . '</td>
                      <td>' . $status . '</td>
                      <td>' . $nature . '</td>
                      <td>' . $its_date . '</td>
                      <td>' . $lead_counsel . '</td>
                      <td>' . $observation . '</td>
                  </tr>
             ';
        }

        $output .= '</table>';

    } else {

        $output .= '<p style="font-size:18px;">No available cases on calendar in the next 10 days</p>';
    }


    mail($recipients, 'Latest cases on calendar in next 10 Days ', $output, $headers);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <title>Login - Case </title>

    <meta name="description" content="User login page"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css"/>

    <!-- text fonts -->
    <link rel="stylesheet" href="assets/css/fonts.googleapis.com.css"/>

    <!-- ace styles -->
    <link rel="stylesheet" href="assets/css/ace.min.css"/>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="assets/css/ace-part2.min.css"/>
    <![endif]-->
    <link rel="stylesheet" href="assets/css/ace-rtl.min.css"/>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="assets/css/ace-ie.min.css"/>
    <![endif]-->

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-layout">
<div class="main-container">
    <div class="main-content">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="login-container">
                    <div class="center">
                        <h1>
                            <i class="ace-icon fa fa-file green"></i>
                            <span class="white">Law Firm</span>
                            <span class="white" id="id-text2">  Management System</span>
                        </h1>
                        <h4 class="blue" id="id-company-text">&copy; Amilex</h4>
                    </div>

                    <div class="space-6"></div>

                    <div class="position-relative">
                        <div id="login-box" class="login-box visible widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header blue lighter bigger">
                                        <i class="ace-icon fa fa-sign-in green"></i>
                                        Please Enter Your Information
                                    </h4>

                                    <div class="space-6"></div>
                                    <?php
                                    if (isset($_POST['login'])) {

                                        $email = mysqli_real_escape_string($db, $_POST['email']);
                                        $password = mysqli_real_escape_string($db, sha1($_POST['password']));


                                        $login = "SELECT * FROM users WHERE email='$email' AND password='$password'";
                                        $result = mysqli_query($db, $login);
                                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                                        if (mysqli_num_rows($result) == 1) {

                                            $user_id = $row['id'];
                                            $username = $row['username'];
                                            $email = $row['email'];
                                            $password = $row['password'];
                                            $institution = $row['permission'];


                                            $_SESSION['user_id'] = $user_id;
                                            $_SESSION['username'] = $username;
                                            $_SESSION['email'] = $email;
                                            $_SESSION['password'] = $password;
                                            $_SESSION['permission'] = $permission;

                                            sendAlert();

                                            ?>

                                            <script type="text/javascript">
                                                window.location = "home.php";
                                            </script>

                                            <?php
                                        } else {
                                            echo '<div class="alert alert-danger">
						                                    <span><strong><p style="font-size:13px;">Oops, </strong>Username or password incorrect.</span></p>
						                                  </div>';
                                        }
                                    }
                                    ?>
                                    <form method="POST">
                                        <fieldset>
                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" name="email" class="form-control"
                                                                   placeholder="Email"/>
															<i class="ace-icon fa fa-user"></i>
														</span>
                                            </label>

                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" name="password" class="form-control"
                                                                   placeholder="Password"/>
															<i class="ace-icon fa fa-lock"></i>
														</span>
                                            </label>

                                            <div class="space"></div>

                                            <div class="clearfix">
                                                <label class="inline">
                                                    <input type="checkbox" class="ace"/>
                                                    <span class="lbl"> Remember Me</span>
                                                </label>

                                                <button type="submit" name="login"
                                                        class="width-35 pull-right btn btn-sm btn-primary">
                                                    <i class="ace-icon fa fa-key"></i>
                                                    <span class="bigger-110">Login</span>
                                                </button>
                                            </div>

                                            <div class="space-4"></div>
                                        </fieldset>
                                    </form>
                                </div><!-- /.widget-main -->

                                <div class="toolbar clearfix">
                                    <div>
                                        <a href="#" data-target="#forgot-box" class="forgot-password-link">
                                            I forgot my password
                                            <i class="ace-icon fa fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div><!-- /.widget-body -->
                        </div><!-- /.login-box -->

                        <div id="forgot-box" class="forgot-box widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header red lighter bigger">
                                        <i class="ace-icon fa fa-key"></i>
                                        Retrieve Password
                                    </h4>

                                    <div class="space-6"></div>
                                    <p>
                                        Enter your email and to receive instructions
                                    </p>

                                    <?php

                                    if (isset($_POST['recover'])) {

                                        $email = mysqli_real_escape_string($db, $_POST['email']);

                                        $data = $db->query("SELECT id FROM users WHERE email = '$email'");

                                        if ($data->num_rows > 0) {
                                            $str = "123456789qwertyuiopasdfghjklzxcvbnm";
                                            $str = str_shuffle($str);
                                            $str = substr($str, 0, 12);
                                            $url = "http://amilex.rw/lfms/changePassword.php?token=$str&email=$email";

                                            $from = "From: LFMS<info@lfmsystem.com>" . "\r\n" .
                                                $from .= 'MIME-Version: 1.0' . "\r\n";
                                            $from .= 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n";

                                            mail($email, "RESET YOUR PASSWORD", "To reset your password  please visit : $url", $from);

                                            $message = '<div class="alert alert-success" role="alert">
							                              Check link sent on this email<br><strong> ' . $email . ' <br></strong
							                              >with token of <strong> ' . $str . '</strong><br>And reset your password</div>';

                                        } else {
                                            $message = '<div class="alert alert-danger" role="alert">
							                              <strong>Oops!</strong> email does not exist, try again!</div>';

                                        }
                                    }
                                    ?>
                                    <form method="POST">
                                        <fieldset>
                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" name="email" class="form-control"
                                                                   placeholder="Email"/>
															<i class="ace-icon fa fa-envelope"></i>
														</span>
                                            </label>

                                            <div class="clearfix">
                                                <button type="submit" name="recover"
                                                        class="width-35 pull-right btn btn-sm btn-danger">
                                                    <i class="ace-icon fa fa-lightbulb-o"></i>
                                                    <span class="bigger-110">Send!</span>
                                                </button>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div><!-- /.widget-main -->

                                <div class="toolbar center">
                                    <a href="#" data-target="#login-box" class="back-to-login-link">
                                        <i class="ace-icon fa fa-arrow-left"></i>
                                        Back to login
                                    </a>
                                </div>
                            </div><!-- /.widget-body -->
                        </div><!-- /.forgot-box -->
                    </div><!-- /.position-relative -->
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.main-content -->
</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->
<script src="assets/js/jquery-2.1.4.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
<script type="text/javascript">
    if ('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
</script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function ($) {
        $(document).on('click', '.toolbar a[data-target]', function (e) {
            e.preventDefault();
            var target = $(this).data('target');
            $('.widget-box.visible').removeClass('visible');//hide others
            $(target).addClass('visible');//show target
        });
    });


</script>
</body>
</html>
