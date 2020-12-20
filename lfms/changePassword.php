<?php error_reporting(E_ALL & ~E_NOTICE & E_WARNING & E_PARSE & E_ERROR);?>
<?php include("include/connection.php");?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Change Password </title>

        <meta name="description" content="User login page" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

        <!-- text fonts -->
        <link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

        <!-- ace styles -->
        <link rel="stylesheet" href="assets/css/ace.min.css" />

        <!--[if lte IE 9]>
            <link rel="stylesheet" href="assets/css/ace-part2.min.css" />
        <![endif]-->
        <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

        <!--[if lte IE 9]>
          <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
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
                        <i class="ace-icon fa fa-key green"></i>
                        <span class="red">Change Password</span>
                    </h1>
                    <h4 class="blue" id="id-company-text">&copy; AmiLex</h4>
                </div>

                <div class="space-6"></div>

                <div class="position-relative">
                    <div id="login-box" class="login-box visible widget-box no-border">
                        <div class="widget-body">
                            <div class="widget-main">
                                <h5 class="header blue lighter bigger">
                                    <i class="ace-icon fa fa-sign-in green"></i>
                                    Change your password and login
                                </h5>

                                <div class="space-6"></div>
                                <?php
                                    if(isset($_GET['token']) && !empty($_GET['email'])){
                                        $email = $_GET['email'];
                                        $token = $_GET['token'];
                                        $token = str_shuffle($token);
                                        $token = substr($token, 0,10);
                                    
                                    }
                                    if (isset($_POST['update'])) {
                                    
                                        $password = mysqli_real_escape_string($db,sha1($_POST['password']));
                                        $password_again = mysqli_real_escape_string($db,sha1($_POST['password_again']));
                                    
                                        if (empty($_POST['password']) && empty($_POST['password_again'])) {
                                            $message = '<div class="alert alert-danger text-center">
                                                <span><strong>Oops, </strong>fields can not be empty .</span>
                                            </div>';
                                        }elseif (strlen($_POST['password']) < 6) {
                                             $message = '<div class="alert alert-danger text-center">
                                                <span><strong>Oops, </strong>password must be 6 characters .</span>
                                            </div>';
                                        }elseif (strlen($_POST['password']) != strlen($_POST['password_again'])) {
                                            $message = '<div class="alert alert-danger text-center">
                                                <span><strong>Oops, </strong>password do not match .</span>
                                            </div>';
                                        }else{

                                            $sms = $email;
                                            $sms2 =  $token;
                                            //UPDATE `singer` SET `password` = '$password' AND `token` = '$token' WHERE = `email` ='$email'
                                            //UPDATE `singer` SET `password` = 'bluestone%33@' WHERE `singer`.`id` = 2;
                                            $update = "UPDATE `users` SET `password` = '$password', `token` = '".$token."' WHERE `users`.`email` = '".$email."'";

                                            $result = mysqli_query($db, $update);
                                         
                                            if ($result) {
                                                $message = '<div class="alert alert-success text-center">
                                                        <span><strong>Password</strong> was resetting with success</span>
                                                    </div>';

                                                $emailSMS = "<span style='font-size:13px;color:#604020;'>change done on this email : ".  $sms."</span>";
                                                $tokenSMS = "<span style='font-size:13px;color:#604020;'>change done on this token : ".  $sms2."</span>";
                                             }else{
                                                 $message = '<div class="alert alert-danger text-center">
                                                        <span><strong>Oops, </strong>Failed to change password, Try again!! .</span>
                                                    </div>';

                                            }

                                        }
                                        
                                    } 
                                ?>
                                <form method="POST">
                                    <?php echo $message;?>                   
                                    <?php echo $emailSMS;?><br>
                                    <?php echo $tokenSMS;?>
                                    <fieldset>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input type="password" name="password" class="form-control" placeholder="New Password" />
                                                <i class="ace-icon fa fa-user"></i>
                                            </span>
                                        </label>

                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input type="password" name="password_again" class="form-control" placeholder="Confirm New Password" />
                                                <i class="ace-icon fa fa-lock"></i>
                                            </span>
                                        </label>

                                        <div class="space"></div>

                                        <div class="clearfix">

                                            <button type="submit" name="update" class="width-35 pull-right btn btn-sm btn-primary">
                                                <i class="ace-icon fa fa-key"></i>
                                                <span class="bigger-110">Change</span>
                                            </button>
                                        </div>

                                        <div class="space-4"></div>



                                       <div class="toolbar center">
                    <a href="index.php" data-target="#login-box" class="back-to-login-link" style="color:#fff;">
                        <i class="ace-icon fa fa-arrow-left"></i>
                    <span>Back to login</span>
                    </a>
                    </div>                      

                                    </fieldset>
                                </form>
                            </div>
                        </div><!-- /.widget-body -->
                    </div><!-- /.login-box -->
            </div>                     
        </div>  
    </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="assets/js/statist.js"></script>
    <script src="assets/js/tooldesign.js"></script>
    <script src="assets/js/apps.js"></script>
</html>