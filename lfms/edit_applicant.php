<?php error_reporting(E_ALL & ~E_NOTICE & E_WARNING & E_PARSE & E_ERROR);?>
<?php include("include/header.php");?>

<?php


$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$permission = $_SESSION['permission'];

?>

<?php 

 if (isset($_GET['applicant_id'])) {
            
    $applicant_id = mysqli_real_escape_string($db,$_GET['applicant_id']);
}
?>
<div class="container" style="margin-right: 50px;width: 80%;">
    <div class="page-content">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="widget-header"  style="background-color:  #ff9999;">
                <h2 class="widget-title">Edit client information</h2>
                <br><br><br>
                
                <?php 
                //UPDATE `case_infos` SET `urega` = 'Muhire Kananga', `uregwa` = 'Kanana', `status` = '2' WHERE `case_infos`.`id` = 5;

                if (isset($_POST['update'])) {


                    $total_amount  = mysqli_real_escape_string($db,$_POST['total_amount']);
                    $paid_amount  = mysqli_real_escape_string($db,$_POST['paid_amount']);
                    $today_date  = mysqli_real_escape_string($db,$_POST['today_date']);

                    $select = "SELECT * FROM clients  WHERE id = '".$applicant_id."'";
                    $result = mysqli_query($db,$select);

                    $row = mysqli_fetch_array($result);
                    $all_amount = $row['total_amount'];
                    $last_paid = $row['amount_paid'];
                    $client_username = $row['names'];
                    $client_mobile = $row['phone'];
                    $new_paid  = $paid_amount + $last_paid;

                    $update = "UPDATE `clients` SET `amount_paid` = '".$new_paid."',`total_amount` = '".$total_amount."' WHERE `clients`.`id` = '".$applicant_id."'";
                    $result_update = mysqli_query($db,$update);


                    if ($result_update) {
                        ?>
                            <script type="text/javascript">
                                window.location = "edit_applicant.php?applicant_id=<?php echo $applicant_id?>";
                            </script>
                        <?php
                    }
                    
                }

                ?>
                <?php

                    $select_applicant = "SELECT * FROM clients WHERE id = '".$applicant_id."'";

                    $result_by_applicant = mysqli_query($db,$select_applicant);

                    while ($row_by_applicant = mysqli_fetch_array($result_by_applicant)) {

                        $paid    = $row_by_applicant['amount_paid'];
                        $amount    = $row_by_applicant['total_amount'];
                        $phone    = $row_by_applicant['phone'];

                        $balance = $amount - $paid;

                    
                ?>
                <form class="form-horizontal" role="form" method="POST">
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Total amount </label>

                        <div class="col-sm-8">
                            <input type="text" id="form-field-2" name="total_amount" placeholder="Total amount" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Paid amount </label>

                        <div class="col-sm-8">
                            <input type="text" id="form-field-2" name="paid_amount" placeholder="Paid amount" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="timepicker1">Payment Date</label>
                        <div class="col-sm-8">
                                <input type="date" name="today_date" class="form-control" />
                        &nbsp;&nbsp;
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="submit" name="update">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Update Account
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <a  href="applicant_reports.php" class="btn" type="reset">
                                    <i class="ace-icon fa fa-arrow-left bigger-110"></i>
                                    Back
                                </a>
                        </div>
                    </div>
                </form>
                <?php }?>
            </div>
        </div><!-- /.span -->
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="widget-header"  style="background-color:  #ff9999;">
                <h2 class="widget-title">Instalments Record</h2>
                <br><br><br>
                
                <?php

                if (isset($_POST['add_instalment'])) {


                    $amount_due  = mysqli_real_escape_string($db,$_POST['amount_due']);
                    $due_date  = mysqli_real_escape_string($db,$_POST['due_date']);
                    $instalment  = mysqli_real_escape_string($db,$_POST['instalment']);

                    $select = "SELECT * FROM clients  WHERE id = '".$applicant_id."'";
                    $result = mysqli_query($db,$select);

                    $row = mysqli_fetch_array($result);
                    $all_amount = $row['total_amount'];
                    $last_paid = $row['amount_paid'];
                    $client_username = $row['names'];
                    $client_mobile = $row['phone'];


                    $insert_client_info = "INSERT INTO `client_payment_info` (`client_id`,`client_name`, `client_phone`, `total_amount`, `amount_due`, `due_date`,`instalment`) VALUES ('".$applicant_id."','".$client_username."', '".$client_mobile."', '".$all_amount."', '".$amount_due."', '".$due_date."', '".$instalment."')";

                    $result_by_insert_client_info = mysqli_query($db,$insert_client_info);


                    if ($result_by_insert_client_info) {
                        ?>
                            <script type="text/javascript">
                                window.location = "edit_applicant.php?applicant_id=<?php echo $applicant_id?>";
                            </script>
                        <?php
                    }
                    
                }

                ?>
                <?php

                    $select_applicant = "SELECT * FROM clients WHERE id = '".$applicant_id."'";

                    $result_by_applicant = mysqli_query($db,$select_applicant);

                    while ($row_by_applicant = mysqli_fetch_array($result_by_applicant)) {

                        $paid    = $row_by_applicant['amount_paid'];
                        $amount    = $row_by_applicant['total_amount'];
                        $phone    = $row_by_applicant['phone'];

                        $balance = $amount - $paid;

                    
                ?>
                <form class="form-horizontal" role="form" method="POST">
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Amount Due </label>

                        <div class="col-sm-8">
                            <input type="text" id="form-field-2" name="amount_due" placeholder="Amount Due" class="form-control" required="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="timepicker1">Due Date</label>
                        <div class="col-sm-8">
                                <input type="date" name="due_date" class="form-control" />
                        &nbsp;&nbsp;
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Instalment </label>
                        <div class="col-sm-8">
                            <select class="form-control" name="instalment" id="form-field-2">
                                <?php 

                                    $select_instalment = "SELECT * FROM instalments";
                                    $result_selected_instalment = mysqli_query($db,$select_instalment);

                                    while ($row_by_selected_instalment = mysqli_fetch_array($result_selected_instalment)) {
                                       $instalment_name = $row_by_selected_instalment['name'];
                                    ?>
                                       <option><?php echo $instalment_name;?></option>
                                    <?php }?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="submit" name="add_instalment">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Add Instalment
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <a  href="edit_applicant.php?applicant_id=<?php echo $applicant_id;?>" class="btn" type="reset">
                                    <i class="ace-icon fa fa-arrow-left bigger-110"></i>
                                    Reset
                                </a>
                        </div>
                    </div>
                </form>
                <?php }?>
            </div>
        </div><!-- /.span -->

        <div class="col-xs-12 col-sm-12 col-md-12">
                <h3 class="header smaller lighter blue">Instalments History</h3>

                <div class="clearfix">
                    <div class="pull-right tableTools-container"></div>
                </div>

                <div class="table-header">
                   <p>
                        
                        <span class="label label-sm label-success">Expected Amount : <?php echo number_format($amount)." RWF";?></span> 
                    </p>

                    <p>
                        
                        <span class="label label-sm label-default">Paid Amount : <?php echo number_format($paid)." RWF";?></span> 
                    </p>

                    <p>
                        
                        <span class="label label-sm label-danger">Balance : <?php echo number_format($balance)." RWF";?></span> 
                    </p>


                </div>

                <!-- div.table-responsive -->

                <!-- div.dataTables_borderWrap -->
                <div>
                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Client Name</th>
                                <th>Instalments</th>
                                <th>Amount Due</th>
                                <th>Balance</th>
                                <th class="hidden-480">Due Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php

                                $select_your_clients = "SELECT * FROM client_payment_info WHERE client_id = '".$applicant_id."' ORDER BY id DESC";

                                $result_by_your_clients = mysqli_query($db,$select_your_clients);

                                while ($row_by_your_clients = mysqli_fetch_array($result_by_your_clients)) {
                                    $id         = $row_by_your_clients['id'];
                                    $client_id         = $row_by_your_clients['client_id'];
                                    $client_name       = $row_by_your_clients['client_name'];
                                    $client_phone   = $row_by_your_clients['client_phone'];
                                    $total_amount   = $row_by_your_clients['total_amount'];
                                    $amount_due      = $row_by_your_clients['amount_due'];
                                    $paid_instalment_amount = $row_by_your_clients['last_paid'];
                                    $due_date     = $row_by_your_clients['due_date'];
                                    $instalment       = $row_by_your_clients['instalment'];
                                    $status     = $row_by_your_clients['status'];

                                    $balance = $amount_due - $paid_instalment_amount;
                            ?>
                            <tr>

                                <td><?php echo $client_name;?></td>
                                <td><?php echo $instalment;?></td>
                                <td class="hidden-480"><span class="label label-sm label-default"><?php echo number_format($amount_due) . " RWF";?></span>
                                </td>
                                <td class="hidden-480"><span class="label label-sm label-danger"><?php echo number_format($balance) . " RWF";?></span>
                                </td>
                                <td><?php echo $due_date;?></td>
                                <td><?php echo $status?></td>
                                <td>
                                    <div class="hidden-sm hidden-xs action-buttons">

                                        <a class="green" href="edit_instalment.php?instalment_id=<?php echo $id?>" title="Edit this case">
                                            <i class="ace-icon fa fa-pencil-square-o bigger-130"></i>
                                            Edit
                                        </a>

                                    </div>

                                    <div class="hidden-md hidden-lg">
                                        <div class="inline pos-rel">
                                            <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">

                                                <li>
                                                    <a href="edit_instalment.php?instalment_id=<?php echo $id?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                        <span class="green">
                                                            <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
        </div>
        <div class="hr hr16 dotted"></div>
        <div class="col-xs-12 col-sm-12 col-md-12">
           <div class="main-content">
                <div class="main-content-inner">
                    <div class="page-content">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="space-6"></div>
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <div class="widget-box transparent">
                                            <div class="widget-header widget-header-large">
                                                <h3 class="widget-title grey lighter">
                                                    <i class="ace-icon fa fa-users green"></i>
                                                    Full information
                                                </h3>
                                            </div>

                                            <div class="widget-body">
                                                <div class="widget-main padding-24">
                                                    <div class="row">
                                                        <?php 

                                                            $select_info = "SELECT * FROM clients WHERE id = '".$applicant_id."'";

                                                        

                                                            $result_by_info = mysqli_query($db,$select_info);

                                                            $row_by_info = mysqli_fetch_array($result_by_info);
                                                            $info_id = $row_by_info['id'];
                                                            $info_name = $row_by_info['names'];
                                                            $info_address = $row_by_info['address'];
                                                            $info_phone = $row_by_info['phone'];
                                                            $info_email = $row_by_info['email'];
                                                            $info_national_id = $row_by_info['national_id'];
                                                            $info_total_amount = $row_by_info['total_amount'];
                                                            $info_amount_paid = $row_by_info['amount_paid'];
                                                            $info_second_klient_name = $row_by_info['second_klient_name'];
                                                            $info_second_klient_info = $row_by_info['second_klient_info'];
                                                            $info_third_klient_name = $row_by_info['third_klient_name'];
                                                            $info_third_klient_info = $row_by_info['third_klient_info'];
                                                            $info_advocat = $row_by_info['advocat'];
                                                            $info_opposing = $row_by_info['opposing'];
                                                            $info_quality = $row_by_info['quality'];
                                                            $info_opening_date = $row_by_info['opening_date'];
                                                            $info_excepted_date = $row_by_info['excepted_date'];
                                                            

                                                        ?>
                                                        <div class="col-sm-6">
                                                            <div class="row">
                                                                <div class="col-xs-11 label label-lg label-info arrowed-in arrowed-right">
                                                                    <b>Basic Information</b>
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <ul class="list-unstyled spaced">
                                                                    <li>
                                                                        <i class="ace-icon fa fa-caret-right blue"></i>
                                                                        Name : 
                                                                        <span class='label label-sm label-secondary'>
                                                                            <?php echo $info_name;?>
                                                                        </span>
                                                                    </li>

                                                                    <li>
                                                                        <i class="ace-icon fa fa-caret-right blue"></i>
                                                                        Address : 
                                                                        <span class='label label-sm label-secondary'>
                                                                            <?php echo $info_address;?>
                                                                        </span>
                                                                    </li>

                                                                    <li>
                                                                        <i class="ace-icon fa fa-caret-right blue"></i>
                                                                        Mobile : 
                                                                        <span class='label label-sm label-secondary'>
                                                                            <?php echo $info_phone;?>
                                                                        </span>
                                                                    </li>

                                                                    <li>
                                                                        <i class="ace-icon fa fa-caret-right blue"></i>
                                                                        Email : 
                                                                        <span class='label label-sm label-secondary'>
                                                                            <?php echo $info_email;?>
                                                                        </span>
                                                                    </li>

                                                                    <li>
                                                                        <i class="ace-icon fa fa-caret-right blue"></i>
                                                                        Client ID : 
                                                                        <span class='label label-sm label-secondary'>
                                                                            <?php echo $info_national_id;?>
                                                                        </span>
                                                                    </li>

                                                                    <li>
                                                                        <i class="ace-icon fa fa-caret-right blue"></i>
                                                                        Opening case date : 
                                                                        <span class='label label-sm label-secondary'>
                                                                            <?php echo $info_opening_date;?>
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div><!-- /.col -->

                                                        <div class="col-sm-6">
                                                            <div class="row">
                                                                <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
                                                                    <b>Further Information</b>
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <ul class="list-unstyled  spaced">

                                                                    <li>
                                                                        <i class="ace-icon fa fa-caret-right green"></i>
                                                                        Second client information : 
                                                                        <span class='label label-sm label-secondary'>
                                                                            <?php echo $info_second_klient_info;?>
                                                                        </span>
                                                                    </li>

                                                                    <li>
                                                                        <i class="ace-icon fa fa-caret-right green"></i>
                                                                        Lead counsel :
                                                                        <span class='label label-sm label-secondary'>
                                                                            <?php echo $info_advocat;?>
                                                                        </span>
                                                                    </li>

                                                                    <li>
                                                                        <i class="ace-icon fa fa-caret-right green"></i>
                                                                        Opposing party :
                                                                        <span class='label label-sm label-secondary'>
                                                                            <?php echo $info_opposing;?>
                                                                        </span>
                                                                    </li>

                                                                    <li>
                                                                        <i class="ace-icon fa fa-caret-right green"></i>
                                                                        Option quality :
                                                                        <span class='label label-sm label-secondary'>
                                                                            <?php echo $info_quality;?>
                                                                        </span>
                                                                    </li>

                                                                    <li>
                                                                        <i class="ace-icon fa fa-caret-right green"></i>
                                                                        Total Amount : 
                                                                        <span class='label label-sm label-secondary'>
                                                                            <?php echo $info_total_amount;?>
                                                                        </span>
                                                                    </li>

                                                                    <li>
                                                                        <i class="ace-icon fa fa-caret-right green"></i>
                                                                        Amount Paid : 
                                                                        <span class='label label-sm label-secondary'>
                                                                            <?php echo $info_amount_paid;?>
                                                                        </span>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </div><!-- /.col -->
                                                    </div><!-- /.row -->


                                                    <div class="space"></div>

                                                    <div class="hr hr8 hr-double hr-dotted"></div>

                                                    <div class="space-6"></div>
                                                    
                                                    <div class="well">
                                                        <a href="edit_client_infos.php?client_id=<?php echo $info_id?>" class="tooltip-success" data-rel="tooltip" title="Edit"
                                                            style="font-size: 16px;">
                                                            <span class="green">
                                                                <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                            </span>
                                                            Edit client information
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- PAGE CONTENT ENDS -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.page-content -->
                </div>
            </div><!-- /.main-content -->
        </div><!-- /.span -->
    </div>
</div>
<br>
<br>
<?php include("include/footer.php");?>
<!--[if !IE]> -->
<script src="assets/js/jquery-2.1.4.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="assets/js/dataTables.buttons.min.js"></script>
<script src="assets/js/buttons.flash.min.js"></script>
<script src="assets/js/buttons.html5.min.js"></script>
<script src="assets/js/buttons.print.min.js"></script>
<script src="assets/js/buttons.colVis.min.js"></script>
<script src="assets/js/dataTables.select.min.js"></script>

<!-- ace scripts -->
<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function($) {
        //initiate dataTables plugin
        var myTable = 
        $('#dynamic-table')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        .DataTable( {
            bAutoWidth: false,
            "aoColumns": [
              { "bSortable": false },
              null, null,null, null, null,
              { "bSortable": false }
            ],
            "aaSorting": [],
            
            
            //"bProcessing": true,
            //"bServerSide": true,
            //"sAjaxSource": "http://127.0.0.1/table.php"   ,
    
            //,
            //"sScrollY": "200px",
            //"bPaginate": false,
    
            //"sScrollX": "100%",
            //"sScrollXInner": "120%",
            //"bScrollCollapse": true,
            //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
            //you may want to wrap the table inside a "div.dataTables_borderWrap" element
    
            //"iDisplayLength": 50
    
    
            select: {
                style: 'multi'
            }
        } );
        myTable.buttons().container().appendTo( $('.tableTools-container') );
        
        //style the message box
        var defaultCopyAction = myTable.button(1).action();
        myTable.button(1).action(function (e, dt, button, config) {
            defaultCopyAction(e, dt, button, config);
            $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
        });
        
        
        var defaultColvisAction = myTable.button(0).action();
        myTable.button(0).action(function (e, dt, button, config) {
            
            defaultColvisAction(e, dt, button, config);
            
            
            if($('.dt-button-collection > .dropdown-menu').length == 0) {
                $('.dt-button-collection')
                .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
                .find('a').attr('href', '#').wrap("<li />")
            }
            $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
        });
    
        ////
    
        setTimeout(function() {
            $($('.tableTools-container')).find('a.dt-button').each(function() {
                var div = $(this).find(' > div').first();
                if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
                else $(this).tooltip({container: 'body', title: $(this).text()});
            });
        }, 500);
        
        
        
        
        
        myTable.on( 'select', function ( e, dt, type, index ) {
            if ( type === 'row' ) {
                $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
            }
        } );
        myTable.on( 'deselect', function ( e, dt, type, index ) {
            if ( type === 'row' ) {
                $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
            }
        } );
    
    
    
    
        /////////////////////////////////
        //table checkboxes
        $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
        
        //select/deselect all rows according to table header checkbox
        $('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
            var th_checked = this.checked;//checkbox inside "TH" table header
            
            $('#dynamic-table').find('tbody > tr').each(function(){
                var row = this;
                if(th_checked) myTable.row(row).select();
                else  myTable.row(row).deselect();
            });
        });
        
        //select/deselect a row when the checkbox is checked/unchecked
        $('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
            var row = $(this).closest('tr').get(0);
            if(this.checked) myTable.row(row).deselect();
            else myTable.row(row).select();
        });
    
    
    
        $(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
            e.stopImmediatePropagation();
            e.stopPropagation();
            e.preventDefault();
        });
        
        
        
        //And for the first simple table, which doesn't have TableTools or dataTables
        //select/deselect all rows according to table header checkbox
        var active_class = 'active';
        $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
            var th_checked = this.checked;//checkbox inside "TH" table header
            
            $(this).closest('table').find('tbody > tr').each(function(){
                var row = this;
                if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
                else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
            });
        });
        
        //select/deselect a row when the checkbox is checked/unchecked
        $('#simple-table').on('click', 'td input[type=checkbox]' , function(){
            var $row = $(this).closest('tr');
            if($row.is('.detail-row ')) return;
            if(this.checked) $row.addClass(active_class);
            else $row.removeClass(active_class);
        });
    
        
    
        /********************************/
        //add tooltip for small view action buttons in dropdown menu
        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        
        //tooltip placement on right or left
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('table')
            var off1 = $parent.offset();
            var w1 = $parent.width();
    
            var off2 = $source.offset();
            //var w2 = $source.width();
    
            if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
            return 'left';
        }
        
        
        
        
        /***************/
        $('.show-details-btn').on('click', function(e) {
            e.preventDefault();
            $(this).closest('tr').next().toggleClass('open');
            $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
        });
        /***************/
        
        
        
        
        
        /**
        //add horizontal scrollbars to a simple table
        $('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
          {
            horizontal: true,
            styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
            size: 2000,
            mouseWheelLock: true
          }
        ).css('padding-top', '12px');
        */
    
    
    })
</script>