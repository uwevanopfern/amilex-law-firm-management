<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/20/2019
 * Time: 9:40 AM
 */

include("include/header.php");

include("include/Helper.php");


$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$permission = $_SESSION['permission'];

$object = new Helper();

?>
<div class="container" style="margin-right: 50px;width: 80%;">
    <div class="page-content">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="header smaller lighter blue">Data results of your expense category</h3>

                <div class="clearfix">
                    <div class="pull-right tableTools-container"></div>
                </div>


                <form class="contact-form" method="POST">
                    <div class="input-group col-md-6">
                        <select class="form-control input-lg" name="category" id="form-field-2">

                            <?php

                            $select_expense_category = "SELECT * FROM expense_category ORDER BY id DESC";
                            $result_selected_expense_category = mysqli_query($db, $select_expense_category);

                            while ($row_by_selected_expense_category = mysqli_fetch_array($result_selected_expense_category)) {
                                $expense_category_name = $row_by_selected_expense_category['name'];
                                ?>
                                <option><?php echo $expense_category_name; ?></option>
                            <?php } ?>

                        </select>

                        <span class="input-group-btn">
                            <button class="btn btn-info input-lg" type="submit" name="search">
                             <i class="ace-icon fa fa-search bigger-110"></i>
                            </button>

                            <span style="margin-left: 5px;">
                                <a href="expense_report_category.php" class="btn btn-default input-lg">
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
                            <th>Name</th>
                            <th>Amount</th>
                            <th class="hidden-480">Category</th>

                            <th>
                                <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                Transaction date
                            </th>
                            <th class="hidden-480">Transaction number</th>
                            <th class="hidden-480">Amount due</th>
                            <th class="hidden-480">Balance</th>
                        </tr>
                        </thead>


                        <?php

                        if (isset($_POST['search'])) {

                            $category_expense = mysqli_real_escape_string($db, $_POST['category']);


                            $select_category = "SELECT * FROM expenses WHERE category = '" . $category_expense . "' ORDER BY id DESC";
                            $result_expense_category = mysqli_query($db, $select_category);

                            while ($row_by_single = mysqli_fetch_array($result_expense_category)) {

                                $id = $row_by_single['id'];
                                $name = $row_by_single['name'];
                                $amount = $row_by_single['amount'];
                                $transaction_no = $row_by_single['transaction_no'];
                                $category = $row_by_single['category'];
                                $description = $row_by_single['description'];
                                $transaction_date_single = $row_by_single['date_entered'];

                                $select_category_id = "SELECT * FROM expense_category WHERE name = '" . $category . "'";

                                $result_category_id = mysqli_query($db, $select_category_id);

                                while ($row_by_category_id = mysqli_fetch_array($result_category_id)) {
                                    $category_id = $row_by_category_id['id'];
                                    $amount_due = $row_by_category_id['amount_due'];
                                    $balance = $row_by_category_id['balance'];

                                    ?>

                                    <tbody>
                                    <tr>

                                        <td><?php echo $name ?></td>
                                        <td><?php echo $amount ?></td>
                                        <td><?php echo $category ?></td>
                                        <td class="hidden-480"><?php echo $transaction_date_single ?></td>
                                        <td><?php echo $transaction_no ?></td>
                                        <td class="hidden-480">
                                            <span class="label label-sm label-info"><?php echo number_format($amount_due) . " RWF"; ?></span>
                                        </td>
                                        <td class="hidden-480">
                                            <span class="label label-sm label-danger"><?php echo number_format($balance) . " RWF"; ?></span>
                                        </td>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>


                            <?php
                        } else {
                            echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>No category selected</span>
                      </div>';


                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<?php include("include/footer.php"); ?>
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
    jQuery(function ($) {
        //initiate dataTables plugin
        var myTable =
            $('#dynamic-table')
            //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .DataTable({
                    bAutoWidth: false,
                    "aoColumns": [
                        {"bSortable": false},
                        null, null, null, null, null,
                        {"bSortable": false}
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
                });
        myTable.buttons().container().appendTo($('.tableTools-container'));

        //style the message box
        var defaultCopyAction = myTable.button(1).action();
        myTable.button(1).action(function (e, dt, button, config) {
            defaultCopyAction(e, dt, button, config);
            $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
        });


        var defaultColvisAction = myTable.button(0).action();
        myTable.button(0).action(function (e, dt, button, config) {

            defaultColvisAction(e, dt, button, config);


            if ($('.dt-button-collection > .dropdown-menu').length == 0) {
                $('.dt-button-collection')
                    .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
                    .find('a').attr('href', '#').wrap("<li />")
            }
            $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
        });

        ////

        setTimeout(function () {
            $($('.tableTools-container')).find('a.dt-button').each(function () {
                var div = $(this).find(' > div').first();
                if (div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
                else $(this).tooltip({container: 'body', title: $(this).text()});
            });
        }, 500);


        myTable.on('select', function (e, dt, type, index) {
            if (type === 'row') {
                $(myTable.row(index).node()).find('input:checkbox').prop('checked', true);
            }
        });
        myTable.on('deselect', function (e, dt, type, index) {
            if (type === 'row') {
                $(myTable.row(index).node()).find('input:checkbox').prop('checked', false);
            }
        });


        /////////////////////////////////
        //table checkboxes
        $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

        //select/deselect all rows according to table header checkbox
        $('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function () {
            var th_checked = this.checked;//checkbox inside "TH" table header

            $('#dynamic-table').find('tbody > tr').each(function () {
                var row = this;
                if (th_checked) myTable.row(row).select();
                else  myTable.row(row).deselect();
            });
        });

        //select/deselect a row when the checkbox is checked/unchecked
        $('#dynamic-table').on('click', 'td input[type=checkbox]', function () {
            var row = $(this).closest('tr').get(0);
            if (this.checked) myTable.row(row).deselect();
            else myTable.row(row).select();
        });


        $(document).on('click', '#dynamic-table .dropdown-toggle', function (e) {
            e.stopImmediatePropagation();
            e.stopPropagation();
            e.preventDefault();
        });


        //And for the first simple table, which doesn't have TableTools or dataTables
        //select/deselect all rows according to table header checkbox
        var active_class = 'active';
        $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function () {
            var th_checked = this.checked;//checkbox inside "TH" table header

            $(this).closest('table').find('tbody > tr').each(function () {
                var row = this;
                if (th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
                else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
            });
        });

        //select/deselect a row when the checkbox is checked/unchecked
        $('#simple-table').on('click', 'td input[type=checkbox]', function () {
            var $row = $(this).closest('tr');
            if ($row.is('.detail-row ')) return;
            if (this.checked) $row.addClass(active_class);
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

            if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) return 'right';
            return 'left';
        }


        /***************/
        $('.show-details-btn').on('click', function (e) {
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



