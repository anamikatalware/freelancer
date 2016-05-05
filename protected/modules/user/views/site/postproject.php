<?php $this->pageTitle = Yii::app()->name . ' - Post a Project'; ?>

<div class="page-header one">
    <div class="container">
        <div class="col-md-6 left-padd0">
            <h3 class="font30 nomargin white uppercase">Post a Project</h3>
            <h4 class="font18 white font-thin">You can post your project from here...!</h4>
        </div>
        <div class="col-md-6">
            <div class="pagenation"><a href="/dashboard">Dashboard</a> <i>/</i> Post a Project</div>
        </div>
    </div>
</div>
<!-- end page header -->

<div class="section-lg one">
    <div class="container">
        <div class="row">
            <div class="reg_form">
                <?php if (Yii::app()->user->hasFlash('message')): ?>
                    <div class="alert alert-<?php echo Yii::app()->user->getFlash('type'); ?> alert-dismissable text-center" id="successmsg">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo Yii::app()->user->getFlash('message'); ?>
                    </div>
                <?php endif; ?>

                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'sky-form',
                    'enableClientValidation' => true,
                    'enableAjaxValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                        'validateOnChange' => true,
                    ),
                    'htmlOptions' => array(
                        'class' => 'sky-form',
                        'enctype' => 'multipart/form-data'
                    )
                ));
                ?>
                <header class="font-slim">What type of work do you require?</header>
                <fieldset>
                    <section>
                        <div class="row">
                            <label class="label col col-4"></label>
                            <div class="col col-8">
                                <label class="select">
                                    <?php $categories = CHtml::listData(Category::model()->findAll(), 'category_id', 'category_name'); ?>
                                    <?php echo $form->dropDownList($model, 'project_categoryID', $categories, array('empty' => 'Select a Category of work (optional)')) ?>
                                    <i></i> 
                                </label>
                                <?php echo $form->error($model, 'project_categoryID', array('class' => 'text-red')); ?>
                            </div>
                        </div>
                    </section>
                </fieldset>
                <header class="font-slim">What is your project about?</header>
                <fieldset>
                    <section>
                        <div class="row">
                            <label class="label col col-4">Project Name</label>
                            <div class="col col-8">
                                <label class="input"> <i class="icon-append fa fa-globe"></i>
                                    <?php echo $form::textField($model, 'project_name', array('placeholder' => 'e.g. Build a website')) ?>
                                </label>
                                <?php echo $form->error($model, 'project_name', array('class' => 'text-red')); ?>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="row">
                            <label class="label col col-4"></label>
                            <div class="col col-8">
                                <label class="checkbox">
                                    <?php echo $form::checkBox($model, 'project_isLocal') ?>
                                    <i></i> Does your project require a local freelancer?
                                </label>
                            </div>
                        </div>
                    </section>
                    <section class="local-post">
                        <div class="row">
                            <label class="label col col-4">Where do you want this done?</label>
                            <div class="col col-8">
                                <label class="input"> <i class="icon-append fa fa-location-arrow"></i>
                                    <?php echo $form::textField($model, 'project_localAddress', array('placeholder' => 'e.g. Address')) ?>
                                </label>
                                <?php echo $form->error($model, 'project_localAddress', array('class' => 'text-red')); ?>
                            </div>
                        </div>
                    </section>
                </fieldset>
                <header class="font-slim">Tell us more about your project.</header>
                <fieldset>
                    <section>
                        <div class="row">
                            <label class="label col col-4">What skills are required?</label>
                            <div class="col col-8">
                                <label class="select">
                                    <select class="subcategories" multiple="multiple" name="project_skills[]" id="Project_project_skills">
                                        <?php
                                        $subcategories = SubCategory::model()->findAll();
                                        $result = array();
                                        if (!empty($subcategories)) {
                                            foreach ($subcategories as $sub) {
                                                ?>
                                                <option value="<?php echo $sub->subcategory_id ?>"><?php echo $sub->subcategory_name ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <i></i>
                                </label>
                                <?php echo $form->error($model, 'subcategory', array('class' => 'text-red')); ?>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="row">
                            <label class="label col col-4">Describe your project</label>
                            <div class="col col-8">
                                <label class="textarea">
                                    <?php echo $form::textArea($model, 'project_description', array('placeholder' => 'Describe your project here')) ?>
                                </label>
                                <?php echo $form->error($model, 'project_description', array('class' => 'text-red')); ?>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="row">
                            <label class="label col col-4"></label>
                            <div class="col col-8">
                                <label class="input">
                                    <div class="dropzone" id="myDropzone"></div>
                                </label>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="row">
                            <label class="label col col-4">What budget do you have in mind?</label>
                            <div class="col col-8">
                                <div class="row">
                                    <div class="col col-sm-12">
                                        <?php
                                        //$budgetType = CHtml::listData(BudgetType::model()->findAll(), 'budgettype_id', 'budgettype_name');
                                        $budgetType = CHtml::listData(BudgetType::model()->findAllByAttributes(array('budgettype_id' => 1)), 'budgettype_id', 'budgettype_name');
                                        ?>
                                        <?php $model->project_budgetType = 1 ?>
                                        <?php echo $form->radioButtonList($model, 'project_budgetType', $budgetType, array('template' => '{input}{label}', 'separator' => '', 'labelOptions' => array('style' => 'line-height:36px;width: 150px;float: left;'), 'style' => 'float:left;')); ?>
                                    </div>
                                    <div class="col col-6">
                                        <label class="select">
                                            <?php $currency = CHtml::listData(Currency::model()->findAll(), 'currency_id', 'currency_code'); ?>
                                            <?php echo $form::dropDownList($model, 'project_currencyID', $currency) ?>
                                            <i></i>
                                        </label>
                                    </div>
                                    <div class="col col-6">
                                        <label class="select">
                                            <select id="Project_project_budgetRangeID" name="Project[project_budgetRangeID]">
                                                <?php
                                                $currency_id = 4;
                                                echo Customer::getBudget($currency_id);
                                                ?>
                                            </select>
                                            <i></i>
                                        </label>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="row">
                            <label class="label col col-4"></label>
                            <div class="col col-8">
                                <button class="button" type="submit">Post Project Now</button>
                                <button class="button button-secondary" type="reset">Cancel</button>
                            </div>
                        </div>
                    </section>
                </fieldset>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .local-post{display: none;}
    .reg_form {width: 90%;}
    .button {text-align: right;margin-top: 10px;}
    .button a {margin: 0;}
    .sky-form .button {float: left;margin: 0;}
    .font-slim {margin-bottom: 10px !important;padding: 0 0 10px !important;font-size: 18px !important;}
    #Project_project_budgetType > input {height: 30px;width: 30px;}    
    .dropzone .dz-preview, .dropzone-previews .dz-preview {margin: 18px;}
    .dropzone {text-align: left;}
</style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '#Project_project_isLocal', function () {
            $('.local-post').toggle();
        });
    });

    function initialize() {
        var input = document.getElementById('Project_project_localAddress');
        var autocomplete = new google.maps.places.Autocomplete(input);
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>

<link href="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/css/dropzone/css/dropzone.css" rel="stylesheet" type="text/css" />
<script src="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/js/dropzone/dropzone.js" type="text/javascript"></script>
<link href="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/css/jquery-ui.css" rel="stylesheet" />
<script src="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/js/jquery-ui.js"></script>

<script type="text/javascript">
    $(function () {
        $("div.dropzone").sortable({
            items: '.dz-preview',
            cursor: 'move',
            opacity: 0.5,
            containment: "parent",
            distance: 20,
            tolerance: 'pointer',
            update: function (e, ui) {
            }
        });

        Dropzone.autoDiscover = false;
        var count = 1;
        $("div.dropzone").dropzone({url: "<?php Yii::app()->baseUrl ?>/user/site/upload",
            addRemoveLinks: true,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF, .doc, .docx, .xlx, .xlsx, .pdf, .zip",
            maxFilesize: 10,
            success: function (file, res) {
                var resp = $.parseJSON(res);
                var objectOn = $("div.dropzone .dz-details .dz-filename span:contains('" + file.name + "')");
                $(objectOn).append("<input type='hidden' data='" + file.name + "' value='" + resp.fname + "' name ='gallery[]' >");
                $(".dz-success-mark").show();
                $(".dz-success-mark").css("opacity", "1");
            },
            removedfile: function (res) {
                var rem_file = JSON.parse(res.xhr.response);
                $("div.dropzone .dz-details .dz-filename span:contains('" + res.name + "')").parent().parent().parent().remove();

                $.ajax({
                    url: "<?php Yii::app()->baseUrl ?>/user/site/remove",
                    data: {file: rem_file.fname},
                    type: 'POST',
                    dataType: 'JSON',
                    success: function (response) {
                        console.log(response);
                    }
                });

                $.each($('input:hidden'), function (i, val) {
                    var resd1 = ($.trim($(this).attr("data")));
                    var resd11 = ($.trim($(this).val()));
                    var resd2 = $.trim(res.name);
                    if (resd1 == resd2) {
                        $("#sky-form").append("<input type='hidden'  value='" + resd11 + "' name ='remgallery[]' >");
                        $(this).remove();
                    }
                });
            },
        });
    });
</script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>

<style>
    .select2-container .select2-selection--multiple {min-height: 35px;line-height: 32px;}
    .select2-container--default .select2-selection--multiple {border: 1px solid #e5e5e5;border-radius: 0;}
    .select2-container--default .select2-selection--multiple .select2-selection__rendered {display: block;}
    .select2-container--default .select2-selection--multiple .select2-selection__choice {margin: 5px 5px 5px 0;line-height: 25px;background: rgb(0, 159, 240);color: #fff;}
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {color: #fff;margin-right: 5px;}
</style>
<script type="text/javascript">
    $(function () {
        $('.subcategories').select2({
            placeholder: "Skills",
            maximumSelectionLength: 5
        });

        $('#Project_project_currencyID').change(function () {
            var currency = $(this).val();

            if (currency != '') {
                $.ajax({
                    url: '/user/customer/ajaxGetBudget',
                    data: {currency: currency},
                    type: 'POST',
                    async: false,
                    cache: false,
                    success: function (response) {
                        $('#Project_project_budgetRangeID').html(response);
                    }
                });
            } else {
                alert('Please select Currency!');
            }
        });
    });
</script>