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
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="widget-header"  style="background-color:  #ff9999;">
                <h4 class="widget-title">Add new client</h4>
                <br><br><br>
                <?php

                if (isset($_POST['add_new_client'])) {

                    $client_name = mysqli_real_escape_string($db,$_POST['client_name']);
                    $client_address = mysqli_real_escape_string($db,$_POST['client_address']);
                    $phone = mysqli_real_escape_string($db,$_POST['phone']);
                    $email = mysqli_real_escape_string($db,$_POST['email']);
                    $id_client = mysqli_real_escape_string($db,$_POST['id_client']);
                    $second_client_info = mysqli_real_escape_string($db,$_POST['second_client_info']);
                    $advocat_name = mysqli_real_escape_string($db,$_POST['advocat_name']);
                    $opposing_party = mysqli_real_escape_string($db,$_POST['opposing_party']);
                    $quality = mysqli_real_escape_string($db,$_POST['quality']);
                    $opening_case_date = mysqli_real_escape_string($db,$_POST['opening_case_date']);
                    $expected_date = mysqli_real_escape_string($db,$_POST['expected_date']);


                    if (empty($client_name)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Client name can not be empty</span>
                      </div>';
                    }elseif (empty($client_address)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Client address field can not be empty</span>
                      </div>';
                    }
                    elseif (empty($advocat_name)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Advocat name can not be empty</span>
                      </div>';
                    }
                    elseif (empty($opposing_party)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Opposing party can not be empty</span>
                      </div>';
                    }
                     elseif (empty($quality)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Please select quality</span>
                      </div>';
                    }
                    elseif (empty($opening_case_date)) {
                        echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><strong>Oops, </strong>Date can not be empty</span>
                      </div>';
                    }
                    else{

                        $select_phone = "SELECT * FROM clients WHERE phone = '".$phone."'";

                        $result_by_selected_phone = mysqli_query($db,$select_phone);

                        $select_phone_rows = mysqli_num_rows($result_by_selected_phone);

                        if ($select_phone_rows == 1) {
                           echo '<div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <span><strong>Oops, </strong>Phone number is already exist, Try new one</span>
                              </div>';
                        }else{

                            $insert_client = "INSERT INTO `clients` (`names`, `address`, `phone`, `email`, `national_id`,`total_amount`, `amount_paid`,`second_klient_info`,`advocat`,`opposing`,`quality`,`opening_date`,`excepted_date`) VALUES ('".$client_name."', '".$client_address."', '".$phone."', '".$email."', '".$id_client."', '0','0','".$second_client_info."','".$advocat_name."', '".$opposing_party."', '".$quality."', '".$opening_case_date."', '0')";

                            $result_by_insert_client = mysqli_query($db,$insert_client);

                            if ($result_by_insert_client) {
                                ?>
                                    <script type="text/javascript">
                                        window.location = "applicant_reports.php";
                                    </script>
                                <?php
                                }
                            }
                        }
                    }  
                ?>

                <form class="form-horizontal" role="form" method="POST">
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Client names</label>

                        <div class="col-sm-8">
                            <input type="text" id="form-field-1" name="client_name" placeholder="Client names" class="form-control" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Client address </label>

                        <div class="col-sm-8">
                            <input type="text" id="form-field-2" name="client_address" placeholder="Client address" class="form-control" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Phone number </label>

                        <div class="col-sm-8">
                            <input type="text" id="form-field-2" name="phone" placeholder="Phone number" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Email address </label>

                        <div class="col-sm-8">
                            <input type="email" id="form-field-2" name="email" placeholder="Email address" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> National ID No </label>

                        <div class="col-sm-8">
                            <input type="text" id="form-field-2" name="id_client" placeholder="National ID No" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Second client information </label>

                        <div class="col-sm-8">
                            <textarea  type="text" name="second_client_info" id="second_client_info" class="form-control" placeholder="Second client information"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Lead counsel </label>

                        <div class="col-sm-8">
                            <input type="text" id="form-field-2" name="advocat_name" placeholder="Lead counsel" class="form-control" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Opposing party </label>

                        <div class="col-sm-8">
                            <textarea  type="text" name="opposing_party" id="opposing_party" class="form-control" placeholder="Opposing party" required></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Select quality </label>
                    <div class="col-sm-8">
                        <select class="form-control" name="quality" id="form-field-2">
                                <option>Applicant</option>
                                <option>Defendant</option>
                                <option>Intervention</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="timepicker1">Opening case</label>
                    <div class="col-sm-8">
                            <input type="date" name="opening_case_date" class="form-control"/>
                    &nbsp;&nbsp;
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-offset-3 col-md-9">
                            <button class="btn btn-info" type="submit" name="add_new_client">
                                <i class="ace-icon fa fa-user bigger-110"></i>
                                Add Client
                            </button>

                            &nbsp; &nbsp; &nbsp;
                            <a  href="new_client.php" class="btn" type="reset">
                                <i class="ace-icon fa fa-undo bigger-110"></i>
                                Reset
                            </a>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
             <div class="widget-header"  style="background-color:  #ff9999;">
                <h4 class="widget-title">Add retainers</h4>
                <br><br><br>
                
                <?php 
                //UPDATE `case_infos` SET `urega` = 'Muhire Kananga', `uregwa` = 'Kanana', `status` = '2' WHERE `case_infos`.`id` = 5;

                if (isset($_POST['retainers'])) {

                    $retainer_name  = mysqli_real_escape_string($db,$_POST['retainer_name']);
                    $file_number  = mysqli_real_escape_string($db,$_POST['file_number']);
                    $contract_amount  = mysqli_real_escape_string($db,$_POST['contract_amount']);
                    $payment_method  = mysqli_real_escape_string($db,$_POST['payment_method']);
                    $start_date  = mysqli_real_escape_string($db,$_POST['start_date']);
                    $end_date  = mysqli_real_escape_string($db,$_POST['end_date']);
                    $lead  = mysqli_real_escape_string($db,$_POST['lead']); 


                    $insert_query = "INSERT INTO `retainers` (`name`, `file_number`, `amount`, `method`, `start_date`, `end_date`, `lead`, `status`) VALUES ('".$retainer_name."', '".$file_number."', '".$contract_amount."', '".$payment_method."', '".$start_date."', '".$end_date."', '".$lead."', 'In force')";


                    $result_by_retainer = mysqli_query($db,$insert_query);

                    if ($result_by_retainer) {
                        ?>
                            <script type="text/javascript">
                                window.location = "new_client.php";
                            </script>
                        <?php
                        }
                }

                ?>
                <form class="form-horizontal" role="form" method="POST">
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Client name </label>

                        <div class="col-sm-8">
                            <input type="text" id="form-field-2" name="retainer_name" placeholder="Enter client name" class="form-control" required="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> File Number </label>

                        <div class="col-sm-8">
                            <input type="text" id="form-field-2" name="file_number" placeholder="Enter file number" class="form-control" required="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Contract Amount </label>

                        <div class="col-sm-8">
                            <input type="text" id="form-field-2" name="contract_amount" placeholder="Enter contract amount" class="form-control" required="" />
                        </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Payment Method </label>
                    <div class="col-sm-8">
                        <select class="form-control" name="payment_method" id="form-field-2">
                                <option>Monthly</option>
                                <option>Yearly</option>
                        </select>
                    </div>
                </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="timepicker1">Start Date</label>
                        <div class="col-sm-8">
                                <input type="date" name="start_date" class="form-control" required=""/>
                        &nbsp;&nbsp;
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="timepicker1">End Date</label>
                        <div class="col-sm-8">
                                <input type="date" name="end_date" class="form-control" required=""/>
                        &nbsp;&nbsp;
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Lead Counsel </label>

                        <div class="col-sm-8">
                            <input type="text" id="form-field-2" name="lead" placeholder="Lead Counsel" class="form-control" required="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="submit" name="retainers">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Add Retainers
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <a  href="new_client.php" class="btn" type="reset">
                                    <i class="ace-icon fa fa-arrow-left bigger-110"></i>
                                    Back
                                </a>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.span -->
        </div>
    </div>
</div>
<br>
<br>
<?php include("include/footer.php");?>
<!-- /.main-container -->

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

        <!--[if lte IE 8]>
          <script src="assets/js/excanvas.min.js"></script>
        <![endif]-->
        <script src="assets/js/jquery-ui.custom.min.js"></script>
        <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
        <script src="assets/js/chosen.jquery.min.js"></script>
        <script src="assets/js/spinbox.min.js"></script>
        <script src="assets/js/bootstrap-datepicker.min.js"></script>
        <script src="assets/js/bootstrap-timepicker.min.js"></script>
        <script src="assets/js/moment.min.js"></script>
        <script src="assets/js/daterangepicker.min.js"></script>
        <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
        <script src="assets/js/bootstrap-colorpicker.min.js"></script>
        <script src="assets/js/jquery.knob.min.js"></script>
        <script src="assets/js/autosize.min.js"></script>
        <script src="assets/js/jquery.inputlimiter.min.js"></script>
        <script src="assets/js/jquery.maskedinput.min.js"></script>
        <script src="assets/js/bootstrap-tag.min.js"></script>

        <!-- ace scripts -->
        <script src="assets/js/ace-elements.min.js"></script>
        <script src="assets/js/ace.min.js"></script>

        <!-- inline scripts related to this page -->
        <script type="text/javascript">
            jQuery(function($) {
                $('#id-disable-check').on('click', function() {
                    var inp = $('#form-input-readonly').get(0);
                    if(inp.hasAttribute('disabled')) {
                        inp.setAttribute('readonly' , 'true');
                        inp.removeAttribute('disabled');
                        inp.value="This text field is readonly!";
                    }
                    else {
                        inp.setAttribute('disabled' , 'disabled');
                        inp.removeAttribute('readonly');
                        inp.value="This text field is disabled!";
                    }
                });
            
            
                if(!ace.vars['touch']) {
                    $('.chosen-select').chosen({allow_single_deselect:true}); 
                    //resize the chosen on window resize
            
                    $(window)
                    .off('resize.chosen')
                    .on('resize.chosen', function() {
                        $('.chosen-select').each(function() {
                             var $this = $(this);
                             $this.next().css({'width': $this.parent().width()});
                        })
                    }).trigger('resize.chosen');
                    //resize chosen on sidebar collapse/expand
                    $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
                        if(event_name != 'sidebar_collapsed') return;
                        $('.chosen-select').each(function() {
                             var $this = $(this);
                             $this.next().css({'width': $this.parent().width()});
                        })
                    });
            
            
                    $('#chosen-multiple-style .btn').on('click', function(e){
                        var target = $(this).find('input[type=radio]');
                        var which = parseInt(target.val());
                        if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
                         else $('#form-field-select-4').removeClass('tag-input-style');
                    });
                }
            
            
                $('[data-rel=tooltip]').tooltip({container:'body'});
                $('[data-rel=popover]').popover({container:'body'});
            
                autosize($('textarea[class*=autosize]'));
                
                $('textarea.limited').inputlimiter({
                    remText: '%n character%s remaining...',
                    limitText: 'max allowed : %n.'
                });
            
                $.mask.definitions['~']='[+-]';
                $('.input-mask-date').mask('99/99/9999');
                $('.input-mask-phone').mask('(999) 999-9999');
                $('.input-mask-eyescript').mask('~9.99 ~9.99 999');
                $(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
            
            
            
                $( "#input-size-slider" ).css('width','200px').slider({
                    value:1,
                    range: "min",
                    min: 1,
                    max: 8,
                    step: 1,
                    slide: function( event, ui ) {
                        var sizing = ['', 'input-sm', 'input-lg', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
                        var val = parseInt(ui.value);
                        $('#form-field-4').attr('class', sizing[val]).attr('placeholder', '.'+sizing[val]);
                    }
                });
            
                $( "#input-span-slider" ).slider({
                    value:1,
                    range: "min",
                    min: 1,
                    max: 12,
                    step: 1,
                    slide: function( event, ui ) {
                        var val = parseInt(ui.value);
                        $('#form-field-5').attr('class', 'col-xs-'+val).val('.col-xs-'+val);
                    }
                });
            
            
                
                //"jQuery UI Slider"
                //range slider tooltip example
                $( "#slider-range" ).css('height','200px').slider({
                    orientation: "vertical",
                    range: true,
                    min: 0,
                    max: 100,
                    values: [ 17, 67 ],
                    slide: function( event, ui ) {
                        var val = ui.values[$(ui.handle).index()-1] + "";
            
                        if( !ui.handle.firstChild ) {
                            $("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>")
                            .prependTo(ui.handle);
                        }
                        $(ui.handle.firstChild).show().children().eq(1).text(val);
                    }
                }).find('span.ui-slider-handle').on('blur', function(){
                    $(this.firstChild).hide();
                });
                
                
                $( "#slider-range-max" ).slider({
                    range: "max",
                    min: 1,
                    max: 10,
                    value: 2
                });
                
                $( "#slider-eq > span" ).css({width:'90%', 'float':'left', margin:'15px'}).each(function() {
                    // read initial values from markup and remove that
                    var value = parseInt( $( this ).text(), 10 );
                    $( this ).empty().slider({
                        value: value,
                        range: "min",
                        animate: true
                        
                    });
                });
                
                $("#slider-eq > span.ui-slider-purple").slider('disable');//disable third item
            
                
                $('#id-input-file-1 , #id-input-file-2').ace_file_input({
                    no_file:'No File ...',
                    btn_choose:'Choose',
                    btn_change:'Change',
                    droppable:false,
                    onchange:null,
                    thumbnail:false //| true | large
                    //whitelist:'gif|png|jpg|jpeg'
                    //blacklist:'exe|php'
                    //onchange:''
                    //
                });
                //pre-show a file name, for example a previously selected file
                //$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])
            
            
                $('#id-input-file-3').ace_file_input({
                    style: 'well',
                    btn_choose: 'Drop files here or click to choose',
                    btn_change: null,
                    no_icon: 'ace-icon fa fa-cloud-upload',
                    droppable: true,
                    thumbnail: 'small'//large | fit
                    //,icon_remove:null//set null, to hide remove/reset button
                    /**,before_change:function(files, dropped) {
                        //Check an example below
                        //or examples/file-upload.html
                        return true;
                    }*/
                    /**,before_remove : function() {
                        return true;
                    }*/
                    ,
                    preview_error : function(filename, error_code) {
                        //name of the file that failed
                        //error_code values
                        //1 = 'FILE_LOAD_FAILED',
                        //2 = 'IMAGE_LOAD_FAILED',
                        //3 = 'THUMBNAIL_FAILED'
                        //alert(error_code);
                    }
            
                }).on('change', function(){
                    //console.log($(this).data('ace_input_files'));
                    //console.log($(this).data('ace_input_method'));
                });
                
                
                //$('#id-input-file-3')
                //.ace_file_input('show_file_list', [
                    //{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
                    //{type: 'file', name: 'hello.txt'}
                //]);
            
                
                
            
                //dynamically change allowed formats by changing allowExt && allowMime function
                $('#id-file-format').removeAttr('checked').on('change', function() {
                    var whitelist_ext, whitelist_mime;
                    var btn_choose
                    var no_icon
                    if(this.checked) {
                        btn_choose = "Drop images here or click to choose";
                        no_icon = "ace-icon fa fa-picture-o";
            
                        whitelist_ext = ["jpeg", "jpg", "png", "gif" , "bmp"];
                        whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
                    }
                    else {
                        btn_choose = "Drop files here or click to choose";
                        no_icon = "ace-icon fa fa-cloud-upload";
                        
                        whitelist_ext = null;//all extensions are acceptable
                        whitelist_mime = null;//all mimes are acceptable
                    }
                    var file_input = $('#id-input-file-3');
                    file_input
                    .ace_file_input('update_settings',
                    {
                        'btn_choose': btn_choose,
                        'no_icon': no_icon,
                        'allowExt': whitelist_ext,
                        'allowMime': whitelist_mime
                    })
                    file_input.ace_file_input('reset_input');
                    
                    file_input
                    .off('file.error.ace')
                    .on('file.error.ace', function(e, info) {
                        //console.log(info.file_count);//number of selected files
                        //console.log(info.invalid_count);//number of invalid files
                        //console.log(info.error_list);//a list of errors in the following format
                        
                        //info.error_count['ext']
                        //info.error_count['mime']
                        //info.error_count['size']
                        
                        //info.error_list['ext']  = [list of file names with invalid extension]
                        //info.error_list['mime'] = [list of file names with invalid mimetype]
                        //info.error_list['size'] = [list of file names with invalid size]
                        
                        
                        /**
                        if( !info.dropped ) {
                            //perhapse reset file field if files have been selected, and there are invalid files among them
                            //when files are dropped, only valid files will be added to our file array
                            e.preventDefault();//it will rest input
                        }
                        */
                        
                        
                        //if files have been selected (not dropped), you can choose to reset input
                        //because browser keeps all selected files anyway and this cannot be changed
                        //we can only reset file field to become empty again
                        //on any case you still should check files with your server side script
                        //because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
                    });
                    
                    
                    /**
                    file_input
                    .off('file.preview.ace')
                    .on('file.preview.ace', function(e, info) {
                        console.log(info.file.width);
                        console.log(info.file.height);
                        e.preventDefault();//to prevent preview
                    });
                    */
                
                });
            
                $('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
                .closest('.ace-spinner')
                .on('changed.fu.spinbox', function(){
                    //console.log($('#spinner1').val())
                }); 
                $('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, touch_spinner: true, icon_up:'ace-icon fa fa-caret-up bigger-110', icon_down:'ace-icon fa fa-caret-down bigger-110'});
                $('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
                $('#spinner4').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus', icon_down:'ace-icon fa fa-minus', btn_up_class:'btn-purple' , btn_down_class:'btn-purple'});
            
                //$('#spinner1').ace_spinner('disable').ace_spinner('value', 11);
                //or
                //$('#spinner1').closest('.ace-spinner').spinner('disable').spinner('enable').spinner('value', 11);//disable, enable or change value
                //$('#spinner1').closest('.ace-spinner').spinner('value', 0);//reset to 0
            
            
                //datepicker plugin
                //link
                $('.date-picker').datepicker({
                    autoclose: true,
                    todayHighlight: true
                })
                //show datepicker when clicking on the icon
                .next().on(ace.click_event, function(){
                    $(this).prev().focus();
                });
            
                //or change it into a date range picker
                $('.input-daterange').datepicker({autoclose:true});
            
            
                //to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
                $('input[name=date-range-picker]').daterangepicker({
                    'applyClass' : 'btn-sm btn-success',
                    'cancelClass' : 'btn-sm btn-default',
                    locale: {
                        applyLabel: 'Apply',
                        cancelLabel: 'Cancel',
                    }
                })
                .prev().on(ace.click_event, function(){
                    $(this).next().focus();
                });
            
            
                $('#timepicker1').timepicker({
                    minuteStep: 1,
                    showSeconds: true,
                    showMeridian: false,
                    disableFocus: true,
                    icons: {
                        up: 'fa fa-chevron-up',
                        down: 'fa fa-chevron-down'
                    }
                }).on('focus', function() {
                    $('#timepicker1').timepicker('showWidget');
                }).next().on(ace.click_event, function(){
                    $(this).prev().focus();
                });
                
                
            
                
                if(!ace.vars['old_ie']) $('#date-timepicker1').datetimepicker({
                 //format: 'MM/DD/YYYY h:mm:ss A',//use this option to display seconds
                 icons: {
                    time: 'fa fa-clock-o',
                    date: 'fa fa-calendar',
                    up: 'fa fa-chevron-up',
                    down: 'fa fa-chevron-down',
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-arrows ',
                    clear: 'fa fa-trash',
                    close: 'fa fa-times'
                 }
                }).next().on(ace.click_event, function(){
                    $(this).prev().focus();
                });
                
            
                $('#colorpicker1').colorpicker();
                //$('.colorpicker').last().css('z-index', 2000);//if colorpicker is inside a modal, its z-index should be higher than modal'safe
            
                $('#simple-colorpicker-1').ace_colorpicker();
                //$('#simple-colorpicker-1').ace_colorpicker('pick', 2);//select 2nd color
                //$('#simple-colorpicker-1').ace_colorpicker('pick', '#fbe983');//select #fbe983 color
                //var picker = $('#simple-colorpicker-1').data('ace_colorpicker')
                //picker.pick('red', true);//insert the color if it doesn't exist
            
            
                $(".knob").knob();
                
                
                var tag_input = $('#form-field-tags');
                try{
                    tag_input.tag(
                      {
                        placeholder:tag_input.attr('placeholder'),
                        //enable typeahead by specifying the source array
                        source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
                        /**
                        //or fetch data from database, fetch those that match "query"
                        source: function(query, process) {
                          $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
                          .done(function(result_items){
                            process(result_items);
                          });
                        }
                        */
                      }
                    )
            
                    //programmatically add/remove a tag
                    var $tag_obj = $('#form-field-tags').data('tag');
                    $tag_obj.add('Programmatically Added');
                    
                    var index = $tag_obj.inValues('some tag');
                    $tag_obj.remove(index);
                }
                catch(e) {
                    //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
                    tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
                    //autosize($('#form-field-tags'));
                }
                
                
                /////////
                $('#modal-form input[type=file]').ace_file_input({
                    style:'well',
                    btn_choose:'Drop files here or click to choose',
                    btn_change:null,
                    no_icon:'ace-icon fa fa-cloud-upload',
                    droppable:true,
                    thumbnail:'large'
                })
                
                //chosen plugin inside a modal will have a zero width because the select element is originally hidden
                //and its width cannot be determined.
                //so we set the width after modal is show
                $('#modal-form').on('shown.bs.modal', function () {
                    if(!ace.vars['touch']) {
                        $(this).find('.chosen-container').each(function(){
                            $(this).find('a:first-child').css('width' , '210px');
                            $(this).find('.chosen-drop').css('width' , '210px');
                            $(this).find('.chosen-search input').css('width' , '200px');
                        });
                    }
                })
                /**
                //or you can activate the chosen plugin after modal is shown
                //this way select element becomes visible with dimensions and chosen works as expected
                $('#modal-form').on('shown', function () {
                    $(this).find('.modal-chosen').chosen();
                })
                */
            
                
                
                $(document).one('ajaxloadstart.page', function(e) {
                    autosize.destroy('textarea[class*=autosize]')
                    
                    $('.limiterBox,.autosizejs').remove();
                    $('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
                });
            
            });
        </script>



            