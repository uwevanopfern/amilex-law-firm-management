<?php error_reporting(E_ALL & ~E_NOTICE & E_WARNING & E_PARSE & E_ERROR); ?>
<?php include("include/header.php"); ?>
<?php include("include/Helper.php"); ?>

<?php


$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$permission = $_SESSION['permission'];

$object = new Helper();

?>
<div class="container" style="margin-right: 50px;width: 80%;">
    <div class="page-content">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="widget-header" style="background-color:  #ff9999;">
                <h4 class="widget-title">Add new expense</h4>
                <br><br><br>
                <hr>

                <?php

                if (isset($_POST['save'])) {

                    $expense_name = mysqli_real_escape_string($db, $_POST['expense_name']);
                    $amount = mysqli_real_escape_string($db, $_POST['amount']);
                    $transaction = mysqli_real_escape_string($db, $_POST['transaction']);
                    $desc = mysqli_real_escape_string($db, $_POST['desc']);
                    $category_insert = mysqli_real_escape_string($db, $_POST['category']);
                    $expense_date = mysqli_real_escape_string($db, $_POST['expense_date']);


                    if (empty($expense_name)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Expense name can not be empty</span>
                      </div>';
                    } elseif (empty($amount)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Amount can not be empty</span>
                      </div>';
                    } elseif (empty($transaction)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Transaction can not be empty</span>
                      </div>';
                    } elseif (empty($desc)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Description can not be empty</span>
                      </div>';
                    } elseif (empty($category_insert)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Date can not be empty</span>
                      </div>';
                    } elseif (empty($expense_date)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Date can not be empty</span>
                      </div>';
                    } else {

                        $select_transc_no = "SELECT * FROM expenses WHERE transaction_no = '" . $transaction . "'";

                        $result_by_selected_trans_no = mysqli_query($db, $select_transc_no);


                        $count_trans = mysqli_num_rows($result_by_selected_trans_no);

                        if ($count_trans != 0) {

                            echo '<div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <span><strong>Oops, </strong>Transaction number already taken, Try again!</span>
                              </div>';
                        } else {

                            $select_category_id = "SELECT * FROM expense_category WHERE name = '" . $category_insert . "'";

                            $result_category_id = mysqli_query($db, $select_category_id);
                            //Get expense amount due and balance of selected category name
                            while ($row_by_category_id = mysqli_fetch_array($result_category_id)) {
                                $category_id = $row_by_category_id['id'];
                                $amount_due = $row_by_category_id['amount_due'];
                                $balance = $row_by_category_id['balance'];
                                $new_balance = $balance - $amount;

                                if ($amount > $amount_due) {
                                    echo '<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <span><strong>Oops, </strong>Amount entered is greater than amount due</span>
                                          </div>';
                                } elseif ($amount > $new_balance) {
                                    echo '<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <span><strong>Oops, </strong>You have insufficient balance</span>
                                          </div>';
                                } else {

                                    if ($new_balance == 0) {

                                        $phone = "250782816597";
                                        $sentence = "Hello Abayo administration, amount due is reached on expense category of $category_insert";
                                        $message = str_replace(' ', '%20', $sentence);
                                        $object->sendSMSAlert($phone, $message);
                                    } else {

                                        $phone = "250782816597";
                                        $amount_due_format = number_format($amount_due) . " RWF";
                                        $new_balance_format = number_format($new_balance) . " RWF";
                                        $sentence = "New alert expense in your law firm of $expense_name with value of $amount Category: $category_insert, Amount due: $amount_due_format, Balance: $new_balance_format";
                                        $message = str_replace(' ', '%20', $sentence);
                                        $object->sendSMSAlert($phone, $message);

                                        $insert_expense = "INSERT INTO `expenses` (`name`, `amount`, `transaction_no`, `category`, `description`,`date_entered`) VALUES ('" . $expense_name . "', '" . $amount . "', '" . $transaction . "', '" . $category_insert . "', '" . $desc . "', '" . $expense_date . "')";

                                        $result_by_insert_expense = mysqli_query($db, $insert_expense);

                                        $set_amount = "UPDATE `expense_category` SET `balance` = '" . $new_balance . "' WHERE `expense_category`.`id` = $category_id";

                                        $result_status = mysqli_query($db, $set_amount);


                                        if ($result_by_insert_expense) {
                                            ?>
                                            <script type="text/javascript">
                                                window.location = "expenses.php";
                                            </script>
                                            <?php
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                ?>
                <form class="form-horizontal" role="form" method="POST">

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Name</label>

                        <div class="col-sm-8">
                            <input type="text" id="form-field-1" name="expense_name" placeholder="Name"
                                   class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Amount </label>

                        <div class="col-sm-8">
                            <input type="text" id="form-field-2" name="amount" placeholder="Amount"
                                   class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Transaction
                            No </label>

                        <div class="col-sm-8">
                            <?php

                            // $year_old = date('Y-m-d');
                            // $year = substr($year_old, 2,-6);
                            // $new_month =substr($year_old, 5,2);
                            // $final_month = substr($new_month, 0,-6);

                            $select_last_transaction = "SELECT * FROM `expenses` ORDER BY id DESC";
                            $result_selected_last_transaction = mysqli_query($db, $select_last_transaction);
                            $row_by_selected_last_transactions = mysqli_fetch_array($result_selected_last_transaction);
                            $last_tran_number = $row_by_selected_last_transactions['transaction_no'];
                            $last_tran_number++;
                            ?>
                            <input type="text" id="form-field-2" name="transaction"
                                   value="<?php echo $last_tran_number; ?>" readonly class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Description </label>

                        <div class="col-sm-8">
                            <textarea type="text" name="desc" id="desc" class="form-control"
                                      placeholder="Description"></textarea>
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
                                    $expense_category_name = $row_by_selected_expense_category['name'];
                                    ?>
                                    <option><?php echo $expense_category_name; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="timepicker1">Transaction
                            date</label>
                        <div class="col-sm-8">
                            <input type="date" name="expense_date" class="form-control"/>
                            &nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-9">
                            <button class="btn btn-info" type="submit" name="save">
                                <i class="ace-icon fa fa-save bigger-110"></i>
                                Save Expense
                            </button>

                            &nbsp; &nbsp; &nbsp;
                            <a href="expenses.php" class="btn" type="reset">
                                <i class="ace-icon fa fa-refresh bigger-110"></i>
                                Refresh
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.span -->
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="widget-header" style="background-color:  #ff9999;">
                <h4 class="widget-title">Add expense category</h4>
                <br><br><br>
                <?php

                if (isset($_POST['category'])) {

                    $name = mysqli_real_escape_string($db, $_POST['name']);
                    $description = mysqli_real_escape_string($db, $_POST['description']);


                    if (empty($name)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Name can not be empty</span>
                      </div>';
                    } elseif (empty($description)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Description can not be empty</span>
                      </div>';
                    } else {

                        $select_name = "SELECT * FROM expense_category WHERE name = '" . $name . "'";

                        $result_by_selected_name = mysqli_query($db, $select_name);


                        $count_name = mysqli_num_rows($result_by_selected_name);

                        if ($count_name != 0) {

                            echo '<div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <span><strong>Oops, </strong>Category name already exists, Try different name!</span>
                              </div>';
                        } else {

                            $insert_category = "INSERT INTO `expense_category` (`name`, `description`) VALUES ('" . $name . "', '" . $description . "')";

                            $result_by_insert_category = mysqli_query($db, $insert_category);


                            if ($result_by_insert_category) {
                                ?>
                                <script type="text/javascript">
                                    window.location = "expenses.php";
                                </script>
                                <?php
                            }
                        }
                    }
                }
                ?>

                <form class="form-horizontal" role="form" method="POST" style="margin-top: 50px;">
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Category name </label>

                        <div class="col-sm-8">
                            <input type="text" id="form-field-2" name="name" placeholder="Category name"
                                   class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Description </label>

                        <div class="col-sm-8">
                            <textarea type="text" name="description" id="description" class="form-control"
                                      placeholder="Description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-9">
                            <button class="btn btn-info" type="submit" name="category">
                                <i class="ace-icon fa fa-check bigger-110"></i>
                                Add category
                            </button>

                            &nbsp; &nbsp; &nbsp;
                            <a href="expenses.php" class="btn" type="reset">
                                <i class="ace-icon fa fa-undo bigger-110"></i>
                                Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.span -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <h3 class="header smaller lighter blue">Data results of your expenses</h3>

            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>
            <div class="table-header">
                Results for "expense of your cabinet"
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
                        <th>Name</th>
                        <th>Amount</th>
                        <th class="hidden-480">Category</th>

                        <th>
                            <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                            Date entered
                        </th>
                        <th class="hidden-480">Transaction number</th>
                        <th class="hidden-480">Amount due</th>
                        <th class="hidden-480">Balance</th>

                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php

                    $select_your_expenses = "SELECT * FROM expenses ORDER BY id DESC";

                    $result_by_your_expenses = mysqli_query($db, $select_your_expenses);

                    while ($row_by_your_expenses = mysqli_fetch_array($result_by_your_expenses)) {
                        $id = $row_by_your_expenses['id'];
                        $name = $row_by_your_expenses['name'];
                        $amount = $row_by_your_expenses['amount'];
                        $transaction_no = $row_by_your_expenses['transaction_no'];
                        $category = $row_by_your_expenses['category'];
                        $description = $row_by_your_expenses['description'];
                        $date_entered = $row_by_your_expenses['date_entered'];

                        $select_category_id = "SELECT * FROM expense_category WHERE name = '" . $category . "'";

                        $result_category_id = mysqli_query($db, $select_category_id);

                        while ($row_by_category_id = mysqli_fetch_array($result_category_id)) {
                            $category_id = $row_by_category_id['id'];
                            $amount_due = $row_by_category_id['amount_due'];
                            $balance = $row_by_category_id['balance'];

                            ?>
                            <tr>
                                <td class="center">
                                    <label class="pos-rel">
                                        <input type="checkbox" class="ace"/>
                                        <span class="lbl"></span>
                                    </label>
                                </td>

                                <td>
                                    <a href="#"><?php echo $name; ?></a>
                                </td>
                                <td>
                                    <span class="label label-sm label-success"><?php echo number_format($amount) . " RWF"; ?></span>
                                </td>
                                <td class="hidden-480"><span
                                            class="label label-sm label-danger"><?php echo $category; ?></span></td>
                                <td><?php echo $date_entered ?></td>

                                <td class="hidden-480">
                                    <span class="label label-sm label-info"><?php echo $transaction_no ?></span>
                                </td>
                                <td class="hidden-480">
                                    <span class="label label-sm label-info"><?php echo number_format($amount_due) . " RWF"; ?></span>
                                </td>
                                <td class="hidden-480">
                                    <span class="label label-sm label-danger"><?php echo number_format($balance) . " RWF"; ?></span>
                                </td>

                                <td>
                                    <div class="hidden-sm hidden-xs action-buttons">

                                        <a class="green" href="edit_expense.php?expense_id=<?php echo $id ?>"
                                           title="Edit this case">
                                            <i class="ace-icon fa fa-pencil-square-o bigger-130"></i>
                                            Edit
                                        </a>
                                    </div>

                                    <div class="hidden-md hidden-lg">
                                        <div class="inline pos-rel">
                                            <button class="btn btn-minier btn-yellow dropdown-toggle"
                                                    data-toggle="dropdown" data-position="auto">
                                                <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">

                                                <li>
                                                    <a href="edit_expense.php?expense_id=<?php echo $id ?>"
                                                       class="tooltip-success" data-rel="tooltip" title="Edit">
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
                        <?php }
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>


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