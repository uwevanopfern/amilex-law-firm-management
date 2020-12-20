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
        <div class="row">
            <div class="col-xs-12">
                <h3 class="header smaller lighter blue">Data results of your cases</h3>

                <div class="clearfix">
                    <div class="pull-right tableTools-container"></div>
                </div>


                <form class="contact-form" method="POST">
                    <div class="input-group col-md-6">
                        <select class="form-control input-lg" name="new_category" id="form-field-2">
                            <?php 

                            $select_categories = "SELECT * FROM category";
                            $result_by_categories = mysqli_query($db,$select_categories);

                            while ($row_categories= mysqli_fetch_array($result_by_categories)) {

                                $category_name = $row_categories['name'];
                           
                            ?>
                            <option><?php echo $category_name?></option>
                            <?php }?>
                        </select>

                        <span class="input-group-btn">
                            <button class="btn btn-info input-lg" type="submit" name="search">
                             <i class="ace-icon fa fa-search bigger-110"></i>
                            </button>

                            <span style="margin-left: 5px;">
                                <a href="case_by_cat.php" class="btn btn-default input-lg">
                                 <i class="ace-icon fa fa-refresh bigger-110"></i>
                                 Refresh
                                </a>
                            </span>
                            
                        </span>
                    </div>
                </form>
                <br>

                <!-- div.table-responsive -->

                <!-- div.dataTables_borderWrap -->
                <div>
                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Case number</th>
                                <th>File number</th>
                                <th>Client</th>
                                <th class="hidden-480">Category</th>
                                <th class="hidden-480">Institution</th>
                                <th class="hidden-480">Lead counsel</th>
                                <th><i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>Open Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        
                        <?php

                            if (isset($_POST['search'])) {
                                
                                $category = mysqli_real_escape_string($db,$_POST['new_category']);

                                // $select_case_id = "SELECT * FROM `status` WHERE `name` = '".$category."'";

                                // $result_by_selected_id = mysqli_query($db,$select_case_id);

                                // $row_by_selected_id = mysqli_fetch_array($result_by_selected_id);
                                // $selected_case_id   = $row_by_selected_id['id'];

                                $select_case_category = "SELECT * FROM case_infos WHERE category = '".$category."' ORDER BY id DESC";

                                $result_by_your_case_category = mysqli_query($db,$select_case_category);

                                while ($row_by_your_case_category = mysqli_fetch_array($result_by_your_case_category)) {
                                    $case_id_cat    = $row_by_your_case_category['id'];
                                    $case_no_cat    = $row_by_your_case_category['case_no'];
                                    $file_number_cat    = $row_by_your_case_category['file_number'];
                                    $instutition_cat    = $row_by_your_case_category['instutition'];
                                    $urega_cat     = $row_by_your_case_category['urega'];
                                    $category_cat     = $row_by_your_case_category['category'];
                                    $date_cat      = $row_by_your_case_category['case_date'];
                                    $closed_date_cat      = $row_by_your_case_category['closed_date'];
                                    $leader_cat     = $row_by_your_case_category['leader'];
                            
                        ?>

                        <tbody>
                            <tr>

                                <td><?php echo $case_no_cat?></td>
                                <td><?php echo $file_number_cat?></td>
                                <td><?php echo $urega_cat?></td>
                                <td class="hidden-480"><?php echo $category_cat?></td>
                                <td><?php echo $instutition_cat?></td>
                                <td class="hidden-480">
                                    <span class="label label-sm label-info"><?php echo $leader_cat?></span>
                                </td>
                                <td><?php echo $date_cat?></td>
                                <td>
                                    <div class="hidden-sm hidden-xs action-buttons">

                                        <a class="green" href="print_case.php?case_id=<?php echo $case_id_cat?>" title="Edit this case">
                                            <i class="ace-icon fa fa-print bigger-130"></i>
                                            Print
                                        </a>
                                    </div>

                                    <div class="hidden-md hidden-lg">
                                        <div class="inline pos-rel">
                                            <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">

                                                <li>
                                                    <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
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


                        <?php    
                        }
                            else
                            {



                                $select_your_case = "SELECT * FROM case_infos ORDER BY id DESC";

                                $result_by_your_case = mysqli_query($db,$select_your_case);

                                while ($row_by_your_case = mysqli_fetch_array($result_by_your_case)) {
                                    $case_id    = $row_by_your_case['id'];
                                    $case_no    = $row_by_your_case['case_no'];
                                    $file_number    = $row_by_your_case['file_number'];
                                    $instutition    = $row_by_your_case['instutition'];
                                    $urega      = $row_by_your_case['urega'];
                                    $category   = $row_by_your_case['category'];
                                    $date       = $row_by_your_case['case_date'];
                                    $closed      = $row_by_your_case['closed_date'];
                                    $leader     = $row_by_your_case['leader'];
                            
                        ?>
                        <tbody>
                            <tr>
                                <td>
                                    <a href="#"><?php echo $case_no?></a>
                                </td>
                                <td>
                                    <a href="#"><?php echo $file_number?></a>
                                </td>
                                <td><?php echo $urega?></td>
                                <td class="hidden-480"><?php echo $category?></td>
                                <td><?php echo $instutition?></td>
                                <td><?php echo $leader?></td>

                                <td class="hidden-480">
                                    <span class="label label-sm label-info"><?php echo $date?></span>
                                </td>

                                <td>
                                    <div class="hidden-sm hidden-xs action-buttons">

                                        <a class="green" href="print_case.php?case_id=<?php echo $case_id?>" title="Edit this case">
                                            <i class="ace-icon fa fa-print bigger-130"></i>
                                            Print
                                        </a>
                                    </div>

                                    <div class="hidden-md hidden-lg">
                                        <div class="inline pos-rel">
                                            <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">

                                                <li>
                                                    <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
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
                            <?php }}?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<?php include("include/footer.php");?>
                                <!-- basic scripts -->

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



            