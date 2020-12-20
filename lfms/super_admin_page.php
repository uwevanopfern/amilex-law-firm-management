<?php error_reporting(E_ALL & ~E_NOTICE & E_WARNING & E_PARSE & E_ERROR); ?>
<?php include("include/header.php"); ?>

<?php

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$permission = $_SESSION['permission'];

?>
<div class="container" style="margin-right: 0px;width: 87%;">
    <div class="page-content">
        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="widget-header" style="background-color:  #ff9999;">
                <h4 class="widget-title">Add New Managing Partner</h4>
                <br><br><br>
                <?php

                if (isset($_POST['add'])) {

                    $name = mysqli_real_escape_string($db, $_POST['name']);
                    $email = mysqli_real_escape_string($db, $_POST['email']);
                    $password = mysqli_real_escape_string($db, sha1($_POST['password']));

                    $permission = 2;


                    $insert = "INSERT INTO `users` (`email`, `username`, `password`,permission) VALUES ('" . $email . "', '" . $name . "', '" . $password . "', '" . $permission . "')";

                    $result = mysqli_query($db, $insert);


                    if ($result) {
                        ?>
                        <script type="text/javascript">
                            window.location = "super_admin_page.php";
                        </script>
                        <?php
                    }


                }
                ?>

                <form class="form-horizontal" role="form" method="POST">
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Lawyer Name</label>

                        <div class="col-sm-8">
                            <input type="text" id="form-field-1" name="name" placeholder="Lawyer Name"
                                   class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Lawyer Email </label>

                        <div class="col-sm-8">
                            <input type="email" id="form-field-2" name="email" placeholder="Lawyer Email"
                                   class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Lawyer
                            Password </label>

                        <div class="col-sm-8">
                            <input type="password" id="form-field-2" name="password" placeholder="Lawyer Password"
                                   class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-9">
                            <button class="btn btn-info" type="submit" name="add">
                                <i class="ace-icon fa fa-check bigger-110"></i>
                                Add Lawyer
                            </button>
                            <div class="hr hr16 dotted"></div>
                            <a href="super_admin_page.php" class="btn" type="reset">
                                <i class="ace-icon fa fa-undo bigger-110"></i>
                                Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.span -->
        <div class="col-xs-12 col-sm-12 col-md-5">
            <h3 class="header smaller lighter blue">Data results of your users</h3>

            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>

            <!-- div.table-responsive -->

            <!-- div.dataTables_borderWrap -->
            <div>
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="center">
                            <label class="pos-rel">
                                <input type="checkbox" class="ace"/>
                                <span class="lbl"></span>
                            </label>
                        </th>
                        <th>Lawyer Name</th>
                        <th>Lawyer Email</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php

                    $select_your_users = "SELECT * FROM users ORDER BY id DESC";

                    $result_by_your_users = mysqli_query($db, $select_your_users);

                    while ($row_by_your_users = mysqli_fetch_array($result_by_your_users)) {
                        $id = $row_by_your_users['id'];
                        $username = $row_by_your_users['username'];
                        $password = $row_by_your_users['password'];
                        $permission = $row_by_your_users['permission'];
                        $status = $row_by_your_users['status'];
                        $email = $row_by_your_users['email'];

                        ?>
                        <tr>
                            <td class="center">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace"/>
                                    <span class="lbl"></span>
                                </label>
                            </td>

                            <td>
                                <a href="#"><?php echo $username; ?></a>
                            </td>
                            <td><?php echo $email; ?></td>

                            <td>
                                <div class="hidden-sm hidden-xs action-buttons">
                                    <form method="POST">
                                        <input type="hidden" name="get_id_employee" value="<?php echo $id; ?>">
                                        <button type="submit" name="delete">
                                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                        </button>
                                    </form>

                                    <?php

                                    if (isset($_POST['delete'])) {

                                        $employee_id = $_POST['get_id_employee'];

                                        $delete_else_block = "DELETE FROM users WHERE id = '" . $employee_id . "'";
                                        $result_delete_block = mysqli_query($db, $delete_else_block);

                                        ?>
                                        <script type="text/javascript">
                                            window.location = "super_lawyer_page.php";
                                        </script>

                                        <?php
                                    }
                                    ?>
                                </div>

                                <div class="hidden-md hidden-lg">
                                    <div class="inline pos-rel">
                                        <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown"
                                                data-position="auto">
                                            <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                            <form method="POST">
                                                <input type="hidden" name="get_id_employee" value="<?php echo $id; ?>">
                                                <button type="submit" name="delete">
                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                </button>
                                            </form>

                                            <?php

                                            if (isset($_POST['delete'])) {

                                                $employee_id = $_POST['get_id_employee'];

                                                $delete_else_block = "DELETE FROM users WHERE id = '" . $employee_id . "'";
                                                $result_delete_block = mysqli_query($db, $delete_else_block);

                                                ?>
                                                <script type="text/javascript">
                                                    window.location = "super_lawyer_page.php";
                                                </script>

                                                <?php
                                            }
                                            ?>

                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="widget-header" style="background-color:  #ff9999;">
                <h4 class="widget-title">Set maximum amount on expense category</h4>
                <br><br><br>
                <?php

                if (isset($_POST['add'])) {

                    $name = mysqli_real_escape_string($db, $_POST['name']);
                    $email = mysqli_real_escape_string($db, $_POST['email']);
                    $password = mysqli_real_escape_string($db, sha1($_POST['password']));

                    $permission = 2;


                    $insert = "INSERT INTO `users` (`email`, `username`, `password`,permission) VALUES ('" . $email . "', '" . $name . "', '" . $password . "', '" . $permission . "')";

                    $result = mysqli_query($db, $insert);


                    if ($result) {
                        ?>
                        <script type="text/javascript">
                            window.location = "super_admin_page.php";
                        </script>
                        <?php
                    }


                }
                ?>
                <?php

                if (isset($_POST['set_price'])) {

                    $amount = mysqli_real_escape_string($db, $_POST['amount']);
                    $category_id = mysqli_real_escape_string($db, $_POST['category']);

                    echo $category_id;

                    //Update column
                    //UPDATE `expenses` SET `maximum_amount` = '6000' WHERE `expenses`.`id` = 1;
                    $set_amount = "UPDATE `expense_category` SET `amount_due` = '" .$amount. "' , `balance` = '" .$amount. "' WHERE `expense_category`.`id` = $category_id";

                    $result_status = mysqli_query($db, $set_amount);

                    if ($result_status) {
                        ?>
                        <script type="text/javascript">
                            window.location = "super_admin_page.php";
                        </script>
                        <?php
                    }
                }

                ?>

                <form class="form-horizontal" role="form" method="POST">
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Maximum
                            amount</label>

                        <div class="col-sm-8">
                            <input type="text" id="form-field-1" name="amount" placeholder="Enter maximum amount"
                                   class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Expense
                            category </label>
                        <div class="col-sm-8">
                            <select class="form-control" name="category" id="form-field-2">

                                <?php

                                $select_expense_category = "SELECT * FROM expense_category ORDER BY id DESC";
                                $result_selected_expense_category = mysqli_query($db, $select_expense_category);

                                while ($row_by_selected_expense_category = mysqli_fetch_array($result_selected_expense_category)) {
                                    $expense_id = $row_by_selected_expense_category['id'];
                                    $expense_category_name = $row_by_selected_expense_category['name'];
                                    ?>
                                    <option value="<?php echo $expense_id; ?>"><?php echo $expense_category_name; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-9">
                            <button class="btn btn-info" type="submit" name="set_price">
                                <i class="ace-icon fa fa-save bigger-110"></i>
                                Set price
                            </button>
                            <div class="hr hr16 dotted"></div>
                            <a href="super_admin_page.php" class="btn" type="reset">
                                <i class="ace-icon fa fa-undo bigger-110"></i>
                                Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.span -->


    </div>
</div>
<br>
<br>
<?php include("include/footer.php"); ?>
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