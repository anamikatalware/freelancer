<?php
$create_url = Yii::app()->createAbsoluteUrl('admin/country/create');
$update_url = Yii::app()->createAbsoluteUrl('admin/country/update/id/' . $model->country_id);

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'country-form',
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
    'focus' => array($model, 'country_name')
        ));
?>

<div class="row">
    <div class="col-sm-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'country_name'); ?>
                    <?php echo $form->textField($model, 'country_name', array('maxlength' => 200, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('country_name'))); ?>
                    <?php echo $form->error($model, 'country_name', array('class' => 'text-red')); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'country_shortname'); ?>
                    <?php echo $form->textField($model, 'country_shortname', array('maxlength' => 200, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('country_shortname'))); ?>
                    <?php echo $form->error($model, 'country_shortname', array('class' => 'text-red')); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'country_code'); ?>
                    <?php echo $form->textField($model, 'country_code', array('maxlength' => 200, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('country_code'))); ?>
                    <?php echo $form->error($model, 'country_code', array('class' => 'text-red')); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'country_flag'); ?>
                    <?php
                    $path = Utils::getDefaultFeaturedImage('small');
                    if (!empty($model->country_flag)) {
                        $path = Utils::getPathFlag($model->country_flag, 'small', '', FALSE);
                    }
                    ?>

                    <div class="featured-image-box">            
                        <img class="featured-image" id="imagePreview" src="<?php echo $path; ?>" />
                    </div>

                    <?php echo $form->fileField($model, 'country_flag'); ?>
                    <?php echo $form->error($model, 'country_flag', array('class' => 'text-red')); ?>
                </div>


                <?php if (!$model->isNewRecord) { ?>                    
                    <div class="form-group">
                        <?php echo $form->checkBox($model, 'country_status'); ?>
                        <?php echo $form->labelEx($model, 'country_status'); ?>
                        <?php echo $form->error($model, 'country_status', array('class' => 'text-red')); ?>
                    </div>                    
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($model->isNewRecord) {
                    echo CHtml::submitButton('Add Country', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
                    echo '&nbsp;&nbsp;';
                    echo CHtml::resetButton('Reset', array('class' => 'btn btn-warning btn-square', 'id' => 'btnReset'));
                } else {
                    echo CHtml::submitButton('Update Country', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>

<style type="text/css">    
    .featured-image-box {position: relative;}
    #imagePreview {width: 80px;height: 50px;}
    .featured-image-box a {position: absolute;right: 72px;color: red;}
    textarea {resize: none;}
    #Country_country_flag {padding-top: 8px !important;line-height: 33px !important;}
</style>
<script type="text/javascript">
    $(function () {
        $('#Country_country_shortname').bind('keydown, blur', function () {
            var shortname = $(this).val();
            shortname = shortname.toUpperCase();
            $(this).val(shortname);
        });
    });
</script>

<script type="text/javascript">
    $(function () {
        $('#Country_country_flag').on('change', function () {
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