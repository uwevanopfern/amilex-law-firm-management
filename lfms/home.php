<?php error_reporting(E_ALL & ~E_NOTICE & E_WARNING & E_PARSE & E_ERROR);?>
<?php session_start();?>
<?php include("include/header.php");?>

<?php


$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$permission = $_SESSION['permission'];

?>
<div class="container" style="margin-right:0px; width: 80%;">
    <div class="page-content">
        <div class="ace-settings-container" id="ace-settings-container">
            <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                <i class="ace-icon fa fa-cog bigger-130"></i>
            </div>

            <div class="ace-settings-box clearfix" id="ace-settings-box">
                <div class="pull-left width-50">
                    <!-- <div class="ace-settings-item">
                        <div class="pull-left">
                            <select id="skin-colorpicker" class="hide">
                                <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                                <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                            </select>
                        </div>
                        <span>&nbsp; Choose Skin</span>
                    </div> -->

                    <!-- <div class="ace-settings-item">
                        <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-breadcrumbs" autocomplete="off" />
                        <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                    </div> -->
                    <div class="ace-settings-item">
                        <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
                        <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
                    </div>

                    <div class="ace-settings-item">
                        <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar" autocomplete="off" />
                        <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                    </div>
                </div><!-- /.pull-left -->

                <div class="pull-left width-50">
                    <div class="ace-settings-item">
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
                        <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
                    </div>
                    
                    <div class="ace-settings-item">
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off" />
                        <label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
                    </div>
                </div><!-- /.pull-left -->
            </div><!-- /.ace-settings-box -->
        </div><!-- /.ace-settings-container -->

        <div class="page-header">
            <h1>
                Dashboard
                <small>

                    <i class="ace-icon fa fa-angle-double-right"></i>
                    <?php

                        $select_all = "SELECT * FROM case_infos";

                        $result_by_all = mysqli_query($db,$select_all);
                        $count_all = mysqli_num_rows($result_by_all);
                        ?>
                        Total cases <span style="color:#000;font-weight:bold;"><?php echo $count_all; ?></span>
                </small>
            </h1>
        </div><!-- /.page-header -->
        <div class="row">
            <div class="space-12"></div>
            <div class="col-sm-12 col-md-12 col-lg-12 infobox-container">

                <div class="infobox infobox-green">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-legal"></i>
                    </div>

                    <div class="infobox-data">
                        <?php

                        $new_status = 1;

                        $select_new_case = "SELECT * FROM case_infos WHERE status = '".$new_status."'";

                        $result_by_new_case = mysqli_query($db,$select_new_case);
                        $count_new_case = mysqli_num_rows($result_by_new_case);
                        ?>
                        <span class="infobox-data-number"><?php echo $count_new_case;?></span>
                        <div class="infobox-content">New Cases</div>
                    </div>
                </div>
                <div class="infobox infobox-pink">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-legal"></i>
                    </div>

                    <div class="infobox-data">
                        <?php

                        $hearing_status = 3;

                        $select_hearing_case = "SELECT * FROM case_infos WHERE status = '".$hearing_status."'";

                        $result_by_hearing_case = mysqli_query($db,$select_hearing_case);
                        $count_hearing_case = mysqli_num_rows($result_by_hearing_case);
                        ?>
                        <span class="infobox-data-number"><?php echo $count_hearing_case;?></span>
                        <div class="infobox-content">Hearing Cases</div>
                    </div>
                </div>

                <div class="infobox infobox-black">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-legal"></i>
                    </div>

                    <div class="infobox-data">
                        <?php

                        $adjournment_status = 4;

                        $select_adjournment_case = "SELECT * FROM case_infos WHERE status = '".$adjournment_status."'";

                        $result_by_adjournment_case = mysqli_query($db,$select_adjournment_case);
                        $count_adjournment_case = mysqli_num_rows($result_by_adjournment_case);
                        ?>
                        <span class="infobox-data-number"><?php echo $count_adjournment_case;?></span>
                        <div class="infobox-content">Adjournment Cases</div>
                    </div>
                </div>

                <div class="infobox infobox-blue">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-legal"></i>
                    </div>

                    <div class="infobox-data">
                        <?php

                        $won_status = 2;

                        $select_won_case = "SELECT * FROM case_infos WHERE status = '".$won_status."'";

                        $result_by_won_case = mysqli_query($db,$select_won_case);
                        $count_won_case = mysqli_num_rows($result_by_won_case);
                        ?>
                        <span class="infobox-data-number"><?php echo $count_won_case;?></span>
                        <div class="infobox-content">Won Cases</div>
                    </div>
                </div>

                <div class="infobox infobox-red">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-legal"></i>
                    </div>

                    <div class="infobox-data">
                        <?php

                        $lost_cases = 5;

                        $select_lost_case = "SELECT * FROM case_infos WHERE status = '".$lost_cases."'";

                        $result_by_lost_case = mysqli_query($db,$select_lost_case);
                        $count_lost_case = mysqli_num_rows($result_by_lost_case);
                        ?>
                        <span class="infobox-data-number"><?php echo $count_lost_case;?></span>
                        <div class="infobox-content">Lost Cases</div>
                    </div>
                </div>

                
                <div class="infobox infobox-red">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-file-archive-o"></i>
                    </div>

                    <div class="infobox-data">
                        <?php

                        $select_closed_case = "SELECT * FROM case_history";

                        $result_by_closed_case = mysqli_query($db,$select_closed_case);
                        $count_closed_case = mysqli_num_rows($result_by_closed_case);
                        ?>
                        <span class="infobox-data-number"><?php echo $count_closed_case;?></span>
                        <div class="infobox-content">Closed cases</div>
                    </div>
                </div>

                <div class="infobox infobox-orange2">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-money"></i>
                    </div>

                    <div class="infobox-data">
                        <?php

                        $select_billed_fee = "SELECT * FROM billed_fee";

                        $result_by__billed = mysqli_query($db,$select_billed_fee);
                        $count_billed = mysqli_num_rows($result_by__billed);
                        ?>
                        <span class="infobox-data-number"><?php echo $count_billed;?></span>
                        <div class="infobox-content">Billed fees</div>
                    </div>
                </div>

                <div class="infobox infobox-grey">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-money"></i>
                    </div>

                    <div class="infobox-data">
                        <?php

                        $select_unbilled = "SELECT * FROM unbilled_fee";

                        $result_by_unbilled = mysqli_query($db,$select_unbilled);
                        $count_unbilled = mysqli_num_rows($result_by_unbilled);
                        ?>
                        <span class="infobox-data-number"><?php echo $count_unbilled;?></span>
                        <div class="infobox-content">Unbilled fees</div>
                    </div>
                </div>
            </div>
       </div>
        <div class="row" style="margin-top: -50px;">
            <div class="col-md-12">
            <h1 style="font-size: 18px;margin-left: 300px; ">Enter new case bellow</h1><br>
            <?php

                if (isset($_POST['save'])) {

                    $case_subject = mysqli_real_escape_string($db,$_POST['case_subject']);
                    $case_number = mysqli_real_escape_string($db,$_POST['case_number']);
                    $urega = mysqli_real_escape_string($db,$_POST['urega']);
                    $category = mysqli_real_escape_string($db,$_POST['category']);
                    $leader = mysqli_real_escape_string($db,$_POST['leader']);
                    $file_number = mysqli_real_escape_string($db,$_POST['file_number']);
                    $instutition = mysqli_real_escape_string($db,$_POST['instutition']);
                    $date = mysqli_real_escape_string($db,$_POST['date']);

                    if (empty($case_subject)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Case subject can not be empty</span>
                      </div>';
                    }elseif (empty($urega)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Urega field can not be empty</span>
                      </div>';
                    }elseif (empty($instutition)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Instutition field can not be empty</span>
                      </div>';
                    }
                    elseif (empty($urega)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Urega field can not be empty</span>
                      </div>';
                    }
                    elseif (empty($category)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Category field can not be empty</span>
                      </div>';
                    }
                    elseif (empty($file_number)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Category field can not be empty</span>
                      </div>';
                    }
                    elseif (empty($leader)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Leader field can not be empty</span>
                      </div>';
                    }
                    elseif (empty($date)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Date can not be empty</span>
                      </div>';
                    }
                    else{

                    $insert_case = "INSERT INTO `case_infos` (`user_id`,`case_no`,`case_subject`,`file_number`, `urega`, `category`, `case_date`, `leader`,`instutition`) VALUES ('".$user_id."','".$case_number."','".$case_subject."', '".$file_number."','".$urega."', '".$category."','".$date."', '".$leader."', '".$instutition."')";

                    $result = mysqli_query($db,$insert_case);

                    $last_case_id = mysqli_insert_id($db);

                    if ($result) {
                        ?>
                            <script type="text/javascript">
                                window.location = "home.php";
                            </script>
                        <?php
                        }
                    }
                }  
                ?>
            <form class="form-horizontal" role="form" method="POST">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Case Subject </label>

                    <div class="col-sm-5">
                        <input type="text" id="form-field-1" name="case_subject" class="form-control" placeholder="Case Subject" required/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Case Number </label>

                    <div class="col-sm-5">
                        <input type="text" id="form-field-1" name="case_number" class="form-control" placeholder="Case Number" required/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> File Number </label>

                    <div class="col-sm-5">
                        <input type="text" id="form-field-1" name="file_number" class="form-control" placeholder="File number" required/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Choose Client </label>
                    <div class="col-sm-5">
                        <select class="form-control" name="urega" id="form-field-2">
                            <?php 

                            $select_applicant = "SELECT * FROM clients ORDER BY id DESC";
                            $result_by_applicant = mysqli_query($db,$select_applicant);

                            while ($row_applicant = mysqli_fetch_array($result_by_applicant)) {

                                $applicant_name = $row_applicant['names'];
                           
                        ?>
                            <option><?php echo $applicant_name?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Case category </label>
                    <div class="col-sm-5">
                        <select class="form-control" name="category" id="form-field-2">
                            <?php 

                            $select_categories = "SELECT * FROM category ORDER BY id DESC";
                            $result_by_categories = mysqli_query($db,$select_categories);

                            while ($row_categories= mysqli_fetch_array($result_by_categories)) {

                                $category_name = $row_categories['name'];
                           
                            ?>
                            <option><?php echo $category_name?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Lead counsel </label>

                    <div class="col-sm-5">
                        <input type="text" id="form-field-2" name="leader" placeholder="Lead counsel" class="form-control" required/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Institution </label>

                    <div class="col-sm-5">
                        <input type="text" id="form-field-2" name="instutition" placeholder="Institution" class="form-control" required/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="timepicker1">Opening case date</label>
                    <div class="col-sm-5">
                            <input id="timepicker1" type="date" name="date" class="form-control" required/>
                    &nbsp;&nbsp;
                    </div>
                
                    <div class="col-md-offset-3 col-md-9">
                            <button class="btn btn-info" type="submit" name="save">
                                <i class="ace-icon fa fa-check bigger-110"></i>
                                Add Case
                            </button>

                            &nbsp; &nbsp; &nbsp;
                            <a  href="home.php" class="btn" type="reset">
                                <i class="ace-icon fa fa-undo bigger-110"></i>
                                Reset
                            </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.page-content -->
</div>
<br>
<br>
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

<!--[if lte IE 8]>
  <script src="assets/js/excanvas.min.js"></script>
<![endif]-->
<script src="assets/js/jquery-ui.custom.min.js"></script>
<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="assets/js/jquery.easypiechart.min.js"></script>
<script src="assets/js/jquery.sparkline.index.min.js"></script>
<script src="assets/js/jquery.flot.min.js"></script>
<script src="assets/js/jquery.flot.pie.min.js"></script>
<script src="assets/js/jquery.flot.resize.min.js"></script>

<!-- ace scripts -->
<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function($) {
        $('.easy-pie-chart.percentage').each(function(){
            var $box = $(this).closest('.infobox');
            var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
            var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
            var size = parseInt($(this).data('size')) || 50;
            $(this).easyPieChart({
                barColor: barColor,
                trackColor: trackColor,
                scaleColor: false,
                lineCap: 'butt',
                lineWidth: parseInt(size/10),
                animate: ace.vars['old_ie'] ? false : 1000,
                size: size
            });
        })
    
        $('.sparkline').each(function(){
            var $box = $(this).closest('.infobox');
            var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
            $(this).sparkline('html',
                             {
                                tagValuesAttribute:'data-values',
                                type: 'bar',
                                barColor: barColor ,
                                chartRangeMin:$(this).data('min') || 0
                             });
        });
    
    
      //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
      //but sometimes it brings up errors with normal resize event handlers
      $.resize.throttleWindow = false;
    
      var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
      var data = [
        { label: "social networks",  data: 38.7, color: "#68BC31"},
        { label: "search engines",  data: 24.5, color: "#2091CF"},
        { label: "ad campaigns",  data: 8.2, color: "#AF4E96"},
        { label: "direct traffic",  data: 18.6, color: "#DA5430"},
        { label: "other",  data: 10, color: "#FEE074"}
      ]
      function drawPieChart(placeholder, data, position) {
          $.plot(placeholder, data, {
            series: {
                pie: {
                    show: true,
                    tilt:0.8,
                    highlight: {
                        opacity: 0.25
                    },
                    stroke: {
                        color: '#fff',
                        width: 2
                    },
                    startAngle: 2
                }
            },
            legend: {
                show: true,
                position: position || "ne", 
                labelBoxBorderColor: null,
                margin:[-30,15]
            }
            ,
            grid: {
                hoverable: true,
                clickable: true
            }
         })
     }
     drawPieChart(placeholder, data);
    
     /**
     we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
     so that's not needed actually.
     */
     placeholder.data('chart', data);
     placeholder.data('draw', drawPieChart);
    
    
      //pie chart tooltip example
      var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
      var previousPoint = null;
    
      placeholder.on('plothover', function (event, pos, item) {
        if(item) {
            if (previousPoint != item.seriesIndex) {
                previousPoint = item.seriesIndex;
                var tip = item.series['label'] + " : " + item.series['percent']+'%';
                $tooltip.show().children(0).text(tip);
            }
            $tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
        } else {
            $tooltip.hide();
            previousPoint = null;
        }
        
     });
    
        /////////////////////////////////////
        $(document).one('ajaxloadstart.page', function(e) {
            $tooltip.remove();
        });
    
    
    
    
        var d1 = [];
        for (var i = 0; i < Math.PI * 2; i += 0.5) {
            d1.push([i, Math.sin(i)]);
        }
    
        var d2 = [];
        for (var i = 0; i < Math.PI * 2; i += 0.5) {
            d2.push([i, Math.cos(i)]);
        }
    
        var d3 = [];
        for (var i = 0; i < Math.PI * 2; i += 0.2) {
            d3.push([i, Math.tan(i)]);
        }
        
    
        var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
        $.plot("#sales-charts", [
            { label: "Domains", data: d1 },
            { label: "Hosting", data: d2 },
            { label: "Services", data: d3 }
        ], {
            hoverable: true,
            shadowSize: 0,
            series: {
                lines: { show: true },
                points: { show: true }
            },
            xaxis: {
                tickLength: 0
            },
            yaxis: {
                ticks: 10,
                min: -2,
                max: 2,
                tickDecimals: 3
            },
            grid: {
                backgroundColor: { colors: [ "#fff", "#fff" ] },
                borderWidth: 1,
                borderColor:'#555'
            }
        });
    
    
        $('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('.tab-content')
            var off1 = $parent.offset();
            var w1 = $parent.width();
    
            var off2 = $source.offset();
            //var w2 = $source.width();
    
            if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
            return 'left';
        }
    
    
        $('.dialogs,.comments').ace_scroll({
            size: 300
        });
        
        
        //Android's default browser somehow is confused when tapping on label which will lead to dragging the task
        //so disable dragging when clicking on label
        var agent = navigator.userAgent.toLowerCase();
        if(ace.vars['touch'] && ace.vars['android']) {
          $('#tasks').on('touchstart', function(e){
            var li = $(e.target).closest('#tasks li');
            if(li.length == 0)return;
            var label = li.find('label.inline').get(0);
            if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
          });
        }
    
        $('#tasks').sortable({
            opacity:0.8,
            revert:true,
            forceHelperSize:true,
            placeholder: 'draggable-placeholder',
            forcePlaceholderSize:true,
            tolerance:'pointer',
            stop: function( event, ui ) {
                //just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
                $(ui.item).css('z-index', 'auto');
            }
            }
        );
        $('#tasks').disableSelection();
        $('#tasks input:checkbox').removeAttr('checked').on('click', function(){
            if(this.checked) $(this).closest('li').addClass('selected');
            else $(this).closest('li').removeClass('selected');
        });
    
    
        //show the dropdowns on top or bottom depending on window height and menu position
        $('#task-tab .dropdown-hover').on('mouseenter', function(e) {
            var offset = $(this).offset();
    
            var $w = $(window)
            if (offset.top > $w.scrollTop() + $w.innerHeight() - 100) 
                $(this).addClass('dropup');
            else $(this).removeClass('dropup');
        });
    
    })
</script>



            