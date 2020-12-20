<?php error_reporting(E_ALL & ~E_NOTICE & E_WARNING & E_PARSE & E_ERROR);?>
<?php include("include/header.php");?>

<?php


$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$permission = $_SESSION['permission'];

?>
<div class="container" style="margin-right: 50px;width: 80%;">
    <div class="page-content">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <?php

                if (isset($_POST['add'])) {

                    $paid_by = mysqli_real_escape_string($db,$_POST['paid_by']);
                    $paid_to = mysqli_real_escape_string($db,$_POST['paid_to']);
                    $transaction = mysqli_real_escape_string($db,$_POST['transaction']);
                    $the_date = mysqli_real_escape_string($db,$_POST['the_date']);
                    $reference = mysqli_real_escape_string($db,$_POST['reference']);
                    $credit_rwf = mysqli_real_escape_string($db,$_POST['credit_rwf']);
                    $debit_rwf = mysqli_real_escape_string($db,$_POST['debit_rwf']);
                    $credit_usd = mysqli_real_escape_string($db,$_POST['credit_usd']);
                    $debit_usd = mysqli_real_escape_string($db,$_POST['debit_usd']);


                    if (empty($paid_by)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Paid by field can not be empty</span>
                      </div>';
                    }elseif (empty($paid_to)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Paid to field can not be empty</span>
                      </div>';
                    }
                    elseif (empty($transaction)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Transaction can not be empty</span>
                      </div>';
                    }
                    elseif (empty($the_date)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Date can not be empty</span>
                      </div>';
                    }

                    else{

                        $insert_transaction = "INSERT INTO `cashflow` (`paid_by`, `paid_to`, `transaction`, `date`, `reference`, `credited_rwf`, `debited_rwf`, `credited_usd`, `debited_usd`) VALUES ('".$paid_by."', '".$paid_to."', '".$transaction."', '".$the_date."', '".$reference."', '".$credit_rwf."', '".$debit_rwf."', '".$credit_usd."', '".$debit_usd."')";

                        $result_by_transaction = mysqli_query($db,$insert_transaction);


                        if ($result_by_transaction) {
                            ?>
                                <script type="text/javascript">
                                    window.location = "cashflow.php";
                                </script>
                            <?php
                        }
                    }    
                }

                ?>


            <form class="form-horizontal" role="form" method="POST">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="widget-header"  style="background-color:  #ff9999;">
                        <h4 class="widget-title">Cashflow Management</h4>
                        <br><br><br><br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Paid by</label>

                            <div class="col-sm-8">
                                <input type="text" id="form-field-1" name="paid_by" placeholder="Paid by" class="form-control"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Paid to </label>

                            <div class="col-sm-8">
                                <input type="text" id="form-field-2" name="paid_to" placeholder="Paid to" class="form-control"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Transaction </label>

                            <div class="col-sm-8">
                                <input type="text" id="form-field-2" name="transaction" placeholder="Transaction" class="form-control"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="timepicker1">Date</label>
                            <div class="col-sm-8">
                                    <input type="date" name="the_date" class="form-control" />
                            &nbsp;&nbsp;
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="widget-header"  style="background-color:  #ff9999;">
                        <br><br><br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Reference</label>

                            <div class="col-sm-8">
                                <input type="text" id="form-field-1" name="reference" placeholder="Reference" class="form-control"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Credited Rwf </label>

                            <div class="col-sm-8">
                                <input type="text" id="form-field-2" name="credit_rwf" placeholder="Credited Rwf" class="form-control"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Debited Rwf </label>

                            <div class="col-sm-8">
                                <input type="text" id="form-field-2" name="debit_rwf" placeholder="Debited Rwf" class="form-control"/>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Credited USD </label>

                            <div class="col-sm-8">
                                <input type="text" id="form-field-2" name="credit_usd" placeholder="Credited USD" class="form-control"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Debited USD </label>

                            <div class="col-sm-8">
                                <input type="text" id="form-field-2" name="debit_usd" placeholder="Debited USD" class="form-control"/>
                            </div>
                        </div>

                    </div>
                </div>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-9">
                            <button class="btn btn-info" type="submit" name="add">
                                <i class="ace-icon fa fa-money bigger-110"></i>
                                Add Transaction
                            </button>
                            <a  href="cashflow.php" class="btn" type="reset">
                                <i class="ace-icon fa fa-undo bigger-110"></i>
                                Reset
                            </a>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
                <h3 class="header smaller lighter blue">Monthly data results of Cashflow</h3>

                <div class="clearfix">
                    <div class="pull-right tableTools-container"></div>
                </div>
                <div class="table-header">
                    <div class="row">
                        <div class="col-md-6">
                            <?php

                              $select_credited_rwf = "SELECT sum(credited_rwf) FROM cashflow";
                              $result_by_credited_rwf= mysqli_query($db,$select_credited_rwf);
                              $row_credited_rwfy = mysqli_fetch_row($result_by_credited_rwf);
                              $sum_credited_rwf = $row_credited_rwfy[0];
                           
                                
                            ?>

                            <p>
                                
                                <span class="label label-sm label-success">Credited Rwf : <?php echo number_format($sum_credited_rwf)." RWF";?></span> 
                            </p>

                            <?php

                              $select_debited_rwf = "SELECT sum(debited_rwf) FROM cashflow";
                              $result_by_debited_rwf = mysqli_query($db,$select_debited_rwf);
                              $row_debited_rwf = mysqli_fetch_row($result_by_debited_rwf);
                              $sum_debited_rwf = $row_debited_rwf[0];
                           
                                
                            ?>
                            <p>
                                
                                <span class="label label-sm label-secondary">Debited Rwf : <?php echo number_format($sum_debited_rwf)." RWF";?></span> 
                            </p>

                            <p>
                                
                                <span class="label label-sm label-danger">Closing Balance Rwf : <?php

                                 $closing_balance_rwf = $sum_credited_rwf - $sum_debited_rwf;
                                 echo number_format($closing_balance_rwf)." RWF";?>
                                     
                                 </span> 
                            </p>
                        </div>
                        <div class="col-md-6">
                            <?php

                              $select_credited_usd = "SELECT sum(credited_usd) FROM cashflow";
                              $result_by_credited_usd = mysqli_query($db,$select_credited_usd);
                              $row_credited_usd = mysqli_fetch_row($result_by_credited_usd);
                              $sum_of_credited_usd = $row_credited_usd[0];
                           
                                
                            ?>

                            <p>
                                
                                <span class="label label-sm label-success">Credited USD : <?php echo number_format($sum_of_credited_usd)." USD";?></span> 
                            </p>

                            <?php

                              $select_debited_usd = "SELECT sum(debited_usd) FROM cashflow";
                              $result_by_debited_usd = mysqli_query($db,$select_debited_usd);
                              $row_debited_usd = mysqli_fetch_row($result_by_debited_usd);
                              $sum_of_debited_usd = $row_debited_usd[0];
                           
                                
                            ?>
                            <p>
                                
                                <span class="label label-sm label-secondary">Debited USD : <?php echo number_format($sum_of_debited_usd)." USD";?></span> 
                            </p>

                            <p>
                                
                                <span class="label label-sm label-danger">Closing Balance USD : <?php 

                                $closing_balance_ussd = $sum_of_credited_usd - $sum_of_debited_usd;
                                echo number_format($closing_balance_ussd)." USD";?></span> 
                            </p>
                        </div>
                    </div>
                </div>

                <div>
                    <form method="POST">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>Start Date</label>
                                <input type="date" name="start_date" class="form-control input-lg">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>End Date</label>
                                <input type="date" name="end_date" class="form-control input-lg">
                            </div>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-info" type="submit" style="margin-top: 27px;" name="search_by_date" value="Search">

                            <a href="cashflow.php" class="btn btn-default" style="margin-top: 27px;"><i class="fa fa-refresh"></i> Refresh</a>
                        </div>
                    </div>
                </div>
            </form>
            <div style="margin-left: 12px;">
                <form action="export_cashflow_excel.php" method="POST">
                    <button type="submit" name="export_excel" class="btn btn-info"> <i class="fa fa-file-excel-o"></i> Export Excel</button>
                </form>
            </div>
            <br>
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Paid By</th>
                            <th>Paid To</th>
                            <th class="hidden-480">Reference</th>

                            <th>
                                <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                Transaction Date
                            </th>
                            <th class="hidden-480">Credited RWF</th>
                            <th class="hidden-480">Debited RWF</th>
                            <th class="hidden-480">Credited USD</th>
                            <th class="hidden-480">Debited USD</th>
                            <th class="hidden-480">Action</th>
                        </tr>
                    </thead>
                    <?php

                        if (isset($_POST['search_by_date'])) {

                            $start_date = $_POST['start_date'];
                            $end_date = $_POST['end_date'];


                                if (empty($start_date)) {
                                    echo '<div class ="col-xs-10 col-sm-10 col-md-4">
                                    <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <span><strong>Oops, </strong>First date can not be empty</span>
                                  </div>
                                  </div>';
                                }elseif (empty($end_date)) {
                                        echo '<div class ="col-xs-10 col-sm-10 col-md-4">
                                        <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <span><strong>Oops, </strong>Second date can not be empty</span>
                                      </div>
                                      </div>';
                                }else{

                                $select_single = "SELECT * FROM cashflow WHERE date between '".$start_date."' AND '".$end_date."'";

                                $result_by_date = mysqli_query($db,$select_single);
                                
                                while ($row_by_single = mysqli_fetch_array($result_by_date)) {

                                    $id_date         = $row_by_single['id'];
                                    $paid_by_date       = $row_by_single['paid_by'];
                                    $paid_to_date   = $row_by_single['paid_to'];
                                    $transaction_date   = $row_by_single['transaction'];
                                    $date_date      = $row_by_single['date'];
                                    $reference_date     = $row_by_single['reference'];
                                    $credited_rwf_date    = $row_by_single['credited_rwf'];
                                    $debited_rwf_date       = $row_by_single['debited_rwf'];
                                    $credited_usd_date       = $row_by_single['credited_usd'];
                                    $debited_usd_date      = $row_by_single['debited_usd'];

                                ?>

                    <tbody>
                        <tr>
                            <tr>
                            <td>
                                <a href="#"><?php echo $paid_by_date;?></a>
                            </td>
                            <td>
                                <a href="#"><?php echo $paid_to_date;?></a>
                            </td>
                            <td>
                                <a href="#"><?php echo $reference_date;?></a>
                            </td>
                            <td><?php echo $date_date;?></td>
                            <td class="hidden-480"><span class="label label-sm label-danger"><?php echo number_format($credited_rwf_date);?></span></td>
                            <td><span class="label label-sm label-default"><?php echo number_format($debited_rwf_date);?></span></td>

                            <td class="hidden-480">
                                <span class="label label-sm label-info"><?php echo number_format($credited_usd_date);?></span>
                            </td>

                            <td><span class="label label-sm label-success"><?php echo number_format($debited_usd_date);?></span></td>
                            <td>
                                <a class="green" href="edit_cashflow.php?cashflow_id=<?php echo $id_date?>" title="Edit this case">
                                    <i class="ace-icon fa fa-pencil-square-o bigger-130"></i>
                                    Edit
                                </a>
                            </td>
                        </tr>
                    </tbody>
                        <?php 
                        }
                        }
                        }
                        else
                        {

                        $select = "SELECT * FROM cashflow ORDER BY date DESC";

                        $result = mysqli_query($db,$select);

                        while ($row = mysqli_fetch_array($result)) {
                            $id         = $row['id'];
                            $paid_by       = $row['paid_by'];
                            $paid_to   = $row['paid_to'];
                            $transaction   = $row['transaction'];
                            $date      = $row['date'];
                            $reference     = $row['reference'];
                            $credited_rwf       = $row['credited_rwf'];
                            $debited_rwf       = $row['debited_rwf'];
                            $credited_usd       = $row['credited_usd'];
                            $debited_usd       = $row['debited_usd'];
                        
                    ?>


                    <tbody>
                        <tr>
                            <td>
                                <a href="#"><?php echo $paid_by;?></a>
                            </td>
                            <td>
                                <a href="#"><?php echo $paid_to;?></a>
                            </td>
                            <td>
                                <a href="#"><?php echo $reference;?></a>
                            </td>
                            <td><?php echo $date;?></td>
                            <td class="hidden-480"><span class="label label-sm label-danger"><?php echo number_format($credited_rwf);?></span></td>
                            <td><span class="label label-sm label-default"><?php echo number_format($debited_rwf);?></span></td>

                            <td class="hidden-480">
                                <span class="label label-sm label-info"><?php echo number_format($credited_usd);?></span>
                            </td>

                            <td><span class="label label-sm label-success"><?php echo number_format($debited_usd);?></span></td>
                            <td>
                                <a class="green" href="edit_cashflow.php?cashflow_id=<?php echo $id?>" title="Edit this case">
                                    <i class="ace-icon fa fa-pencil-square-o bigger-130"></i>
                                    Edit
                                </a>
                            </td>
                        </tr>
                        <?php }}?>
                    </tbody>
                </table>
            </div>
            </div>
        <br>
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



            