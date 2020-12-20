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
        <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
            <div class="widget-header" style="background-color:  #ff9999;">
                <h4 class="widget-title">Add new task</h4>
                <br><br><br>
                <hr>

                <?php

                if (isset($_POST['add_new_task'])) {

                    $task = mysqli_real_escape_string($db, $_POST['task']);
                    $tasked_to = mysqli_real_escape_string($db, $_POST['tasked_to']);
                    $phone = mysqli_real_escape_string($db, $_POST['phone']);
                    $open_date = mysqli_real_escape_string($db, $_POST['open_date']);
                    $expected_date = mysqli_real_escape_string($db, $_POST['expected_date']);
                    $observation = mysqli_real_escape_string($db, $_POST['observation']);


                    if (empty($task)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Task name can not be empty</span>
                      </div>';
                    } elseif (empty($tasked_to)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Field tasked to can not be empty</span>
                      </div>';
                    } elseif (empty($phone)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Phone of the person can not be empty</span>
                      </div>';
                    } elseif (empty($open_date)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Open Date can not be empty</span>
                      </div>';
                    } elseif (empty($expected_date)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Expected date can not be empty</span>
                      </div>';
                    } else {

                        $insert_tasks = "INSERT INTO `tasks` (`task`, `tasked_to`, `phone`, `open_date`, `ecd`, `observation`) VALUES ('$task', '$tasked_to', '$phone', '$open_date', '$expected_date', '$observation')";

                        $result_by_insertion = mysqli_query($db, $insert_tasks);

                        $phone_format = "25$phone";
                        $sentence = "Hello dear $tasked_to, you have assigned to the new tasks of $task with expected completion time of $expected_date";
                        $message = str_replace(' ', '%20', $sentence);
                        $object->sendSMSAlert($phone_format, $message);


                        if ($result_by_insertion) {
                            ?>
                            <script type="text/javascript">
                                window.location = "tasks.php";
                            </script>
                            <?php
                        }
                    }
                }
                ?>
                <form class="form-horizontal" method="POST">

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Task </label>

                        <div class="col-sm-8">
                            <input type="text" id="form-field-2" name="task" placeholder="Task" class="form-control"
                                   required=""/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Tasked To </label>

                        <div class="col-sm-8">
                            <input type="text" id="form-field-2" name="tasked_to" placeholder="Tasked To"
                                   class="form-control" required=""/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Telephone  </label>

                        <div class="col-sm-8">
                            <input type="text" id="form-field-2" name="phone" placeholder="Telephone"
                                   class="form-control" required=""/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="timepicker1">Date</label>
                        <div class="col-sm-8">
                            <input type="date" name="open_date" class="form-control" required=""/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="timepicker1">Expected completion date</label>
                        <div class="col-sm-8">
                            <input type="date" name="expected_date" class="form-control" required=""/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Observation </label>

                        <div class="col-sm-8">
                            <input type="text" id="form-field-2" name="observation" placeholder="Observation"
                                   class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-9">
                            <button class="btn btn-info" type="submit" name="add_new_task">
                                <i class="ace-icon fa fa-tasks bigger-110"></i>
                                Add Task
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h3 class="header smaller lighter blue">Data results</h3>

            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>
            <div class="table-header">
                Tasks Management Report
            </div>

            <!-- div.table-responsive -->

            <!-- div.dataTables_borderWrap -->
            <div>
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Task</th>
                        <th>Tasked To</th>
                        <th>Person phone</th>
                        <th>Date</th>
                        <th>Expected completion date</th>
                        <th>Completion date</th>
                        <th>Observation</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php

                    $select = "SELECT * FROM tasks ORDER BY ecd ASC";

                    $result = mysqli_query($db, $select);

                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row['id'];
                        $task = $row['task'];
                        $tasked_to = $row['tasked_to'];
                        $phone = $row['phone'];
                        $open_date = $row['open_date'];
                        $ecd = $row['ecd'];
                        $cd = $row['cd'];
                        $observation = $row['observation'];

                        ?>
                        <tr>

                            <td><?php echo $task; ?></td>
                            <td><?php echo $tasked_to; ?></td>
                            <td><?php echo $phone; ?></td>
                            <td><span class="label label-sm label-success"><?php echo $open_date; ?></span></td>
                            <td class="hidden-480"><span class="label label-sm label-default"><?php echo $ecd; ?></span>
                            </td>
                            <td><span class="label label-sm label-info"><?php echo $cd; ?></span></td>

                            <td class="hidden-480">
                                <?php echo $observation; ?>
                            </td>
                            <td>
                                <a class="green" href="edit_tasks.php?tasks_id=<?php echo $id ?>"
                                   title="Edit this case">
                                    <i class="ace-icon fa fa-pencil-square-o bigger-130"></i>
                                    Edit
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<br>
<br><?php include("include/footer.php"); ?>
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