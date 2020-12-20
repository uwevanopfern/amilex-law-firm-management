<?php error_reporting(E_ALL & ~E_NOTICE & E_WARNING & E_PARSE & E_ERROR); ?>
<?php include("include/header.php");
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/21/2019
 * Time: 6:13 PM
 */

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$permission = $_SESSION['permission'];


if (isset($_POST['delete_archive'])) {

    $archive_id = mysqli_real_escape_string($db, $_POST['delete_field']);

    $delete = "DELETE FROM archives WHERE id = '" . $archive_id . "'";
    $result = mysqli_query($db, $delete);

    ?>
    <script type="text/javascript">
        window.location = "add_archive.php";
    </script>

    <?php
}


?>
<div class="container" style="margin-right: 50px;width: 80%;">
    <div class="page-content">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class="widget-header" style="background-color:  #ff9999;">
                <h4 class="widget-title">Add new archive</h4>
                <br><br><br>
                <?php

                if (isset($_POST['add_archive'])) {

                    $name = mysqli_real_escape_string($db, $_POST['name']);
                    $date = mysqli_real_escape_string($db, $_POST['date']);
                    $archive_category = mysqli_real_escape_string($db, $_POST['archive_category']);

                    $file_name = $_FILES['document']['name'];
                    $file_tmp = $_FILES['document']['tmp_name'];

                    if (empty($name)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Archive Name can not be empty</span>
                      </div>';
                    } elseif (empty($file_name)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Document can not be empty</span>
                      </div>';
                    } elseif (empty($archive_category)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Please, select archive category!</span>
                      </div>';
                    } elseif (empty($date)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Date can not be empty</span>
                      </div>';
                    } else {

                        $select_name = "SELECT * FROM archives WHERE name = '" . $name . "'";

                        $result_by_selected_name = mysqli_query($db, $select_name);


                        $count_name = mysqli_num_rows($result_by_selected_name);

                        if ($count_name != 0) {

                            echo '<div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <span><strong>Oops, </strong>Product name already exists, Try different name!</span>
                              </div>';
                        } else {

                            move_uploaded_file($file_tmp, "archives/" . $file_name);
                            echo "Success";

                            $insert_archive = "INSERT INTO `archives` (`name`, `archive_category` , `document`, `date_uploaded`) VALUES ('" . $name . "', '" . $archive_category . "', '" . $file_name . "', '" . $date . "')";

                            $result_by_insert_archive = mysqli_query($db, $insert_archive);


                            if ($result_by_insert_archive) {
                                ?>
                                <script type="text/javascript">
                                    window.location = "add_archive.php";
                                </script>
                                <?php
                            }
                        }
                    }
                }
                ?>

                <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Archive Name</label>

                        <div class="col-sm-8">
                            <input type="text" id="form-field-1" name="name" placeholder="Enter Archive Name"
                                   class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Archive
                            category </label>
                        <div class="col-sm-8">
                            <select class="form-control" name="archive_category" id="form-field-2">

                                <?php

                                $archive_category = "SELECT * FROM archive_category ORDER BY id DESC";
                                $result_selected_archive_category = mysqli_query($db, $archive_category);

                                while ($row_by_selected_archive_category = mysqli_fetch_array($result_selected_archive_category)) {
                                    $archive_category_name = $row_by_selected_archive_category['category_name'];
                                    ?>
                                    <option><?php echo $archive_category_name; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Archive
                            document</label>

                        <div class="col-sm-8">
                            <input type="file" id="form-field-2" name="document" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="timepicker1">Date Entered</label>
                        <div class="col-sm-8">
                            <input type="date" name="date" class="form-control"/>
                            &nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-9">
                            <button class="btn btn-info" type="submit" name="add_archive">
                                <i class="ace-icon fa fa-file-archive-o bigger-110"></i>
                                Upload archive
                            </button>

                            &nbsp; &nbsp; &nbsp;
                            <a href="add_archive.php" class="btn" type="reset">
                                <i class="ace-icon fa fa-undo bigger-110"></i>
                                Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.span -->
        <br><br><br>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <br><br><br>
            <div class="widget-header" style="background-color:  #ff9999;">
                <h4 class="widget-title">Add new category archive</h4>
                <br><br><br>
                <?php

                if (isset($_POST['add_archive_category'])) {

                    $category_name = mysqli_real_escape_string($db, $_POST['category_name']);

                    if (empty($category_name)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Archive category name can not be empty</span>
                      </div>';
                    } else {

                        $select_name = "SELECT * FROM archive_category WHERE category_name = '" . $category_name . "'";
                        $result_by_selected_name = mysqli_query($db, $select_name);
                        $count_name = mysqli_num_rows($result_by_selected_name);
                        if ($count_name != 0) {

                            echo '<div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <span><strong>Oops, </strong>Archive category name already exists, Try different name!</span>
                              </div>';
                        } else {

                            $insert_archive_category = "INSERT INTO `archive_category` (`category_name`) VALUES ('" . $category_name . "')";
                            $result_by_insert_archive_category = mysqli_query($db, $insert_archive_category);
                            if ($result_by_insert_archive_category) {
                                ?>
                                <script type="text/javascript">
                                    window.location = "add_archive.php";
                                </script>
                                <?php
                            }
                        }
                    }
                }
                ?>

                <form class="form-horizontal" role="form" method="POST">
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Archive Name
                            Category</label>

                        <div class="col-sm-8">
                            <input type="text" id="form-field-1" name="category_name" placeholder="Enter Archive Name"
                                   class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-9">
                            <button class="btn btn-info" type="submit" name="add_archive_category">
                                <i class="ace-icon fa fa-save bigger-110"></i>
                                Add new category
                            </button>

                            &nbsp; &nbsp; &nbsp;
                            <a href="add_archive.php" class="btn" type="reset">
                                <i class="ace-icon fa fa-undo bigger-110"></i>
                                Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h3 class="header smaller lighter blue">Data results of your archives</h3>

            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>
            <div class="table-header">
                Edit archives
            </div>

            <!-- div.table-responsive -->

            <!-- div.dataTables_borderWrap -->
            <div>
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Document</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php

                    $select_archive = "SELECT * FROM archives ORDER BY id DESC LIMIT 5";

                    $result_by_archives = mysqli_query($db, $select_archive);

                    while ($row_by_your_archives = mysqli_fetch_array($result_by_archives)) {
                        $id = $row_by_your_archives['id'];
                        $name = $row_by_your_archives['name'];
                        $document = $row_by_your_archives['document'];
                        $category = $row_by_your_archives['archive_category'];
                        $date = $row_by_your_archives['date_uploaded'];


                        ?>
                        <tr>
                            <td><?php echo $name ?></td>
                            <td><?php echo $category ?></td>
                            <td>
                                <a href="archives/<?php echo $document ?>" target="_blank"><?php echo $document; ?></a>
                            </td>
                            <td><?php echo $date ?></td>

                            <td>
                                <form method="POST">
                                    <div class="hidden-sm hidden-xs action-buttons">
                                        <input type="hidden" value="<?php echo $id ?>" name="delete_field">
                                        <button type="submit" name="delete_archive">
                                            <i class="ace-icon fa fa-remove bigger-130"></i>
                                        </button>
                                    </div>

                                    <div class="hidden-md hidden-lg">
                                        <div class="inline pos-rel">
                                            <button class="btn btn-minier btn-yellow dropdown-toggle"
                                                    data-toggle="dropdown"
                                                    data-position="auto">
                                                <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">

                                                <div class="hidden-sm hidden-xs action-buttons">
                                                    <input type="hidden" value="<?php echo $id ?>" name="delete_field">
                                                    <button type="submit" name="delete_archive">
                                                        <i class="ace-icon fa fa-remove bigger-130"></i>
                                                    </button>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
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