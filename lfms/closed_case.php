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
                <h3 class="header smaller lighter blue">Data results</h3>

                <div class="clearfix">
                    <div class="pull-right tableTools-container"></div>
                </div>
                <div class="table-header">
                    Search cases by given start and end of dates

                </div>
                <span class="label label-danger">Average Closure Time : 
                    <?php
                        
                            $select_average = "SELECT * FROM case_history ORDER BY id DESC";

                            $result_by_average = mysqli_query($db,$select_average);

                            $count_avg = mysqli_num_rows($result_by_average);
                           
                            $sum = 0;

                            while ($row_by_your_average = mysqli_fetch_array($result_by_average)) {

                                $open_date_avg      = $row_by_your_average['open_date'];
                                $closed_date_avg    = $row_by_your_average['closed_date'];

                                $date1_avg=date_create("$open_date_avg");
                                $date2_avg=date_create("$closed_date_avg");
                                $diff_avg=date_diff($date1_avg,$date2_avg);

                                $real_avg = $diff_avg->format("%a");
                                $sum += $real_avg;   

                        }
                        echo ($sum/$count_avg) . " Days";

                    ?>
                </span>

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

                            <a href="closed_case.php" class="btn btn-default" style="margin-top: 27px;"><i class="fa fa-refresh"></i> Refresh</a>
                        </div>
                    </div>
            </form>

            <div style="margin-left: 12px;">
                <form action="export_closed_case_excel.php" method="POST">
                    <button type="submit" name="export_excel" class="btn btn-info"> <i class="fa fa-file-excel-o"></i> Export Excel</button>
                </form>
            </div>
            <br>


                <div>
                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Case No</th>
                                <th>Case subject</th>
                                <th>Category</th>
                                <th>File No</th>
                                <th>Lead Counsel</th>
                                <th>Institution</th>
                                <th>Opened Date</th>
                                <th>Closed Date</th>
                                <th>Time Spent</th>
                            </tr>
                        </thead>

                        <tbody>
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

                                $select_case_date = "SELECT * FROM case_history WHERE closed_date between '".$start_date."' AND '".$end_date."'";

                                $result_by_date = mysqli_query($db,$select_case_date);

                                while ($row_by_your_history_all = mysqli_fetch_array($result_by_date)) {
                                        $id_selection         = $row_by_your_history_all['id'];
                                        $case_no_selection       = $row_by_your_history_all['case_no'];
                                        $case_subject_selection   = $row_by_your_history_all['case_subject'];
                                        $file_number_selection   = $row_by_your_history_all['file_number'];
                                        $urega_selection      = $row_by_your_history_all['urega'];
                                        $category_selection      = $row_by_your_history_all['category'];
                                        $open_date_selection      = $row_by_your_history_all['open_date'];
                                        $closed_date_selection      = $row_by_your_history_all['closed_date'];
                                        $leader_selection      = $row_by_your_history_all['leader'];
                                        $institution_selection     = $row_by_your_history_all['institution'];


                                        $date_one_selected = date_create("$open_date_selection");
                                        $date_two_selected = date_create("$closed_date_selection");
                                        $diff_selected = date_diff($date_one_selected,$date_two_selected);
                                    
                            ?>
                        <tbody>
                            <tr>
                                <td><?php echo $urega_selection;?></td>
                                <td><?php echo $case_no_selection;?></td>
                                <td>
                                    <a href="#"><?php echo $case_subject_selection;?></a>
                                </td>
                                <td><?php echo $category_selection;?></td>
                                <td class="hidden-480"><?php echo $file_number_selection;?></td>
                                <td><?php echo $leader_selection?></td>
                                <td><?php echo $institution_selection?></td>
                                <td><span class="label label-sm label-info"><?php echo $open_date_selection?></span></td>
                                <td><span class="label label-sm label-danger"><?php echo $closed_date_selection?></span></td>
                                <td><span class="label label-sm label-default"><?php echo $diff_selected->format("%a days");?></span></td>
                            </tr>
                        </tbody>
                        <?php 
                        }
                        }
                        }
                        else
                        {
                            

                            $select_history = "SELECT * FROM case_history ORDER BY id DESC";

                            $result_by_history = mysqli_query($db,$select_history);

                            while ($row_by_your_history = mysqli_fetch_array($result_by_history)) {
                                $id         = $row_by_your_history['id'];
                                $case_no       = $row_by_your_history['case_no'];
                                $case_subject   = $row_by_your_history['case_subject'];
                                $file_number   = $row_by_your_history['file_number'];
                                $urega      = $row_by_your_history['urega'];
                                $category      = $row_by_your_history['category'];
                                $open_date      = $row_by_your_history['open_date'];
                                $closed_date      = $row_by_your_history['closed_date'];
                                $leader      = $row_by_your_history['leader'];
                                $institution     = $row_by_your_history['institution'];

                                $date1=date_create("$open_date");
                                $date2=date_create("$closed_date");
                                $diff=date_diff($date1,$date2);
                            ?>
                            <tr>
                                <td><?php echo $urega;?></td>
                                <td><?php echo $case_no;?></td>
                                <td>
                                    <a href="#"><?php echo $case_subject;?></a>
                                </td>
                                <td><?php echo $category;?></td>
                                <td class="hidden-480"><?php echo $file_number;?></td>
                                <td><?php echo $leader?></td>
                                <td><?php echo $institution?></td>
                                <td><span class="label label-sm label-info"><?php echo $open_date?></span></td>
                                <td><span class="label label-sm label-danger"><?php echo $closed_date?></span></td>
                                <td><span class="label label-sm label-default"><?php echo $diff->format("%a days");?></span></td>
                            </tr>
                            <?php }}?>
                        </tbody>
                    </table>
                </div>
        </div>
       
        
    </div>
</div>
<br>
<br><?php include("include/footer.php");?>
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