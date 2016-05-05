<?php
$create_url = Yii::app()->createAbsoluteUrl('admin/tour/create');
$update_url = Yii::app()->createAbsoluteUrl('admin/tour/update/id/' . $model->tour_id);

Yii::app()->clientScript->registerScriptFile($this->module->assetsUrl . '/js/tinymce/tinymce.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('messagesjs', '
		tinymce.init({'
        . (file_exists(dirname(__FILE__) . '/../../assets/js/tinymce/langs/' . Yii::app()->getLanguage() . '.js') ? ('language: "' . Yii::app()->getLanguage() . '",') : '') .
        'selector: "#Tour_tour_overview",
		    theme: "modern",
		    plugins: [
		        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
		        "searchreplace wordcount visualblocks visualchars code fullscreen",
		        "insertdatetime media nonbreaking save table contextmenu directionality",
		        "emoticons template paste textcolor colorpicker textpattern"
		    ],
		    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image pastetext",
		    toolbar2: "forecolor backcolor emoticons | fontselect | fontsizeselect | print preview code pagebreak media",
		    image_advtab: true,
		    templates: [
		        {title: "Test template 1", content: "Test 1"},
		        {title: "Test template 2", content: "Test 2"}
		    ],
		    forced_root_block : "",
                    theme_advanced_font_sizes: "10px,12px,13px,14px,16px,18px,20px",
                    font_size_style_values : "10px,12px,13px,14px,16px,18px,20px",
		});	
	');

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'tour-form',
    'action' => ($model->isNewRecord) ? $create_url : $update_url,
    'enableAjaxValidation' => TRUE,
    'enableClientValidation' => TRUE,
    'clientOptions' => array(
        'validateOnSubmit' => TRUE,
        'validateOnChange' => TRUE
    ),
    'htmlOptions' => array(
        'autocomplete' => 'off',
        'enctype' => 'multipart/form-data',
        'role' => 'form'
    ),
    'focus' => array($model, 'tour_name')
        ));
?>

<div class="row">
    <div class="col-sm-8">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'tour_name'); ?>
                    <?php echo $form->textField($model, 'tour_name', array('maxlength' => 255, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('tour_name'))); ?>
                    <?php echo $form->error($model, 'tour_name', array('class' => 'text-red')); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'tour_slug'); ?>
                    <?php echo $form->textField($model, 'tour_slug', array('maxlength' => 255, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('tour_slug'))); ?>
                    <?php echo $form->error($model, 'tour_slug', array('class' => 'text-red')); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'tour_categoryID'); ?>
                    <?php
                    $categories = Category::model()->findAll();
                    $listdata = CHtml::listData($categories, 'category_id', 'category_name');
                    ?>
                    <?php echo $form->dropDownList($model, 'tour_categoryID', $listdata, array('maxlength' => 100, 'class' => 'form-control', 'empty' => $model->getAttributeLabel('tour_categoryID'))); ?>
                    <?php echo $form->error($model, 'tour_categoryID', array('class' => 'text-red')); ?>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <?php
                            if (!$model->isNewRecord) {
                                $duration = explode(' ', $model->tour_duration);
                            }
                            ?>
                            <?php echo $form->labelEx($model, 'tour_duration'); ?>
                            <div class="row">
                                <div class="col-sm-6">                                    
                                    <select class="form-control" name="duration" id="duration">
                                        <option value="">Select</option>
                                        <?php for ($i = 1; $i <= 24; $i++) { ?>
                                            <?php if (!empty($duration[0])) { ?>
                                                <?php if ($duration[0] == $i) { ?>    
                                                    <option value="<?= $i ?>" selected="selected"><?= $i ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $i ?>"><?= $i ?></option>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                    <?php echo $form->error($model, 'tour_duration', array('class' => 'text-red')); ?>
                                </div>
                                <div class="col-sm-6">
                                    <?php
                                    if (!$model->isNewRecord) {
                                        $model->tour_duration = $duration[1];
                                    }
                                    ?>
                                    <?php echo $form->dropDownList($model, 'tour_duration', Utils::getDuration(), array('maxlength' => 100, 'class' => 'form-control', 'empty' => $model->getAttributeLabel('tour_duration'))); ?>
                                    <?php echo $form->error($model, 'tour_duration', array('class' => 'text-red')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <?php echo $form->labelEx($model, 'tour_amount'); ?>
                            <?php echo $form->textField($model, 'tour_amount', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('tour_amount'))); ?>
                            <?php echo $form->error($model, 'tour_amount', array('class' => 'text-red')); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    <div class="col-sm-4">
        <?php echo $form->labelEx($model, 'tour_image'); ?>
        <?php
        $path = Utils::getDefaultFeaturedImage('medium');
        if (!empty($model->tour_image)) {
            $path = Utils::getPathFeaturedImage($model->tour_image, 'medium', '', FALSE);
        }
        ?>
        <div class="form-group">
            <div class="featured-image-box">            
                <img class="featured-image" id="imagePreview" src="<?php echo $path; ?>" />
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->fileField($model, 'tour_image'); ?>
            <?php echo $form->error($model, 'tour_image', array('class' => 'text-red')); ?>
        </div>    
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <?php echo $form->labelEx($model, 'tour_overview'); ?>
            <?php echo $form->textArea($model, 'tour_overview', array('class' => 'form-control', 'rows' => 16, 'placeholder' => $model->getAttributeLabel('tour_overview'))); ?>
            <?php echo $form->error($model, 'tour_overview', array('class' => 'text-red')); ?>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <div class="dropzone" id="myDropzone"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?php echo $form->checkBox($model, 'tour_is_private'); ?> <?php echo $model->getAttributeLabel('tour_is_private'); ?>
                    <?php echo $form->error($model, 'tour_is_private', array('class' => 'text-red')); ?>
                </label>
            </div>
        </div>                    
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?php echo $form->checkBox($model, 'tour_is_bestSeller'); ?> <?php echo $model->getAttributeLabel('tour_is_bestSeller'); ?>
                    <?php echo $form->error($model, 'tour_is_bestSeller', array('class' => 'text-red')); ?>
                </label>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <?php if (!$model->isNewRecord) { ?>                    
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <?php echo $form->checkBox($model, 'tour_status'); ?> <?php echo $model->getAttributeLabel('tour_status'); ?>
                        <?php echo $form->error($model, 'tour_status', array('class' => 'text-red')); ?>
                    </label>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="col-md-12">
        <?php
        if ($model->isNewRecord) {
            echo CHtml::submitButton('Add Tour', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
            echo '&nbsp;&nbsp;';
            echo CHtml::resetButton('Reset', array('class' => 'btn btn-warning btn-square', 'id' => 'btnReset'));
        } else {
            echo CHtml::submitButton('Update Tour', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
        }
        ?>
    </div>
</div>

<?php $this->endWidget(); ?>

<style type="text/css">
    .featured-image-box {
        position: relative;
        //text-align: center;
    }
    #imagePreview {
        width: 200px;
        height: 200px;
    }
    .featured-image-box a {
        position: absolute;
        right: 72px;
        color: red;
    }
    textarea {resize: none;}
    #Tour_tour_image {
        padding-top: 8px !important;
        line-height: 33px !important;
    }
</style>
<script type="text/javascript">
    $(function () {
        $('#Tour_tour_name').blur(function () {
            var name = $(this).val();
            var slug = name.replace(/\s/g, '-');
            slug = slug.toLowerCase();
            $('#Tour_tour_slug').val(slug);
        });
    });
</script>

<script type="text/javascript">
    $(function () {
        $('#Tour_tour_image').on('change', function () {
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader)
                return;
            var ftype = $(this)[0].files[0].type;
            var types = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
            if ($.inArray(ftype, types) > 0) {
                if (/^image/.test(files[0].type)) {
                    if ($(this)[0].files[0].size > 10485760) {
                        $('#statusMsg').addClass('alert alert-danger').html('The Image Size is too Big. Max size for the image is 2MB');
                        $(this).val('');
                        $("#imagePreview").attr("src", '<?php echo $path ?>');
                        setTimeout(function () {
                            $('#statusMsg').removeClass('alert alert-danger').html('');
                        }, 3000);
                    } else {
                        var reader = new FileReader();
                        reader.readAsDataURL(files[0]);
                        reader.onloadend = function (event) {
                            $("#imagePreview").attr("src", event.target.result);
                            $("#span_close").html('<span id="close" style="display:none" title="Click here to delete this image"><i class="fa fa-times fa-2x"></i></span>');
                        }
                    }
                } else {
                    $('#statusMsg').addClass('alert alert-danger').html('Please upload a valid Image File.');
                    $(this).val('');
                    $("#imagePreview").attr("src", '<?php echo $path ?>');
                    setTimeout(function () {
                        $('#statusMsg').removeClass('alert alert-danger').html('');
                    }, 3000);
                }
            } else {
                $('#statusMsg').addClass('alert alert-danger').html('Please upload a valid Image File.');
                $(this).val('');
                $("#imagePreview").attr("src", '<?php echo $path ?>');
                setTimeout(function () {
                    $('#statusMsg').removeClass('alert alert-danger').html('');
                }, 3000);
            }
        });
    });
</script>

<link href="<?php echo $this->module->assetsUrl; ?>/css/dropzone/css/dropzone.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $this->module->assetsUrl; ?>/js/dropzone/dropzone.js" type="text/javascript"></script>
<link href="<?php echo $this->module->assetsUrl; ?>/css/jquery-ui.css" rel="stylesheet" />
<script src="<?php echo $this->module->assetsUrl; ?>/js/jquery-ui.js"></script>

<script type="text/javascript">
    var flag = '<?php echo $model->isNewRecord ? 1 : 0; ?>';
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
        $("div.dropzone").dropzone({url: "<?php Yii::app()->baseUrl ?>/admin/common/upload",
            addRemoveLinks: true,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF",
            maxFilesize: 10,
            success: function (file, res) {
                var resp = $.parseJSON(res);
                var objectOn = $("div.dropzone .dz-details .dz-filename span:contains('" + file.name + "')");
                $(objectOn).append("<input type='hidden' data='" + file.name + "' value='" + resp.fname + "' name ='gallery[]' >");
                $(".dz-success-mark").show();
                $(".dz-success-mark").css("opacity", "1");
            },
            removedfile: function (res) {
                $("div.dropzone .dz-details .dz-filename span:contains('" + res.name + "')").parent().parent().parent().remove();
                $.each($('input:hidden'), function (i, val) {
                    var resd1 = ($.trim($(this).attr("data")));
                    var resd11 = ($.trim($(this).val()));
                    var resd2 = $.trim(res.name);
                    if (resd1 == resd2) {
                        $("#tour-form").append("<input type='hidden'  value='" + resd11 + "' name ='remgallery[]' >");
                        $(this).remove();
                    }
                });
            },
        });
    });
    if (flag == 0) {
        Dropzone.options.myDropzone = {
            init: function () {
                thisDropzone = this;
                $.get('/admin/tour/getimages/<?php echo $model->tour_id; ?>', function (data) {
                    console.log(data);
                    $.each(data, function (key, value) {
                        var mockFile = {name: value.name, size: value.size, id: "all"};
                        thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                        //thisDropzone.options.thumbnail.call(thisDropzone, mockFile, "/path" + value.name);
                        thisDropzone.options.thumbnail.call(thisDropzone, mockFile, value.path);
                        var objectOn = $("div.dropzone .dz-details .dz-filename span:contains('" + value.name + "')");
                        $(objectOn).append("<input type='hidden' data=" + value.name + " value=" + value.name + " name ='gallery[]' >");
                    });
                    $(".dz-success-mark").show();
                    $(".dz-success-mark").css("opacity", "1");
                });
            }
        };
    }
</script>