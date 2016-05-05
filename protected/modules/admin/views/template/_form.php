<?php
$create_url = Yii::app()->createAbsoluteUrl('admin/template/create');
$update_url = Yii::app()->createAbsoluteUrl('admin/template/update/id/' . $model->template_id);

Yii::app()->clientScript->registerScriptFile($this->module->assetsUrl . '/js/tinymce/tinymce.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('messagesjs', '
		tinymce.init({'
        . (file_exists(dirname(__FILE__) . '/../../assets/js/tinymce/langs/' . Yii::app()->getLanguage() . '.js') ? ('language: "' . Yii::app()->getLanguage() . '",') : '') .
        'selector: "#Template_template_content",
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
    'id' => 'template-form',
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
    'focus' => array($model, 'template_title')
        ));
?>

<div class="row">
    <div class="col-sm-8">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'template_title'); ?>
                    <?php echo $form->textField($model, 'template_title', array('maxlength' => 200, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('template_title'))); ?>
                    <?php echo $form->error($model, 'template_title', array('class' => 'text-red')); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'template_alias'); ?>
                    <?php echo $form->textField($model, 'template_alias', array('maxlength' => 200, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('template_alias'))); ?>
                    <?php echo $form->error($model, 'template_alias', array('class' => 'text-red')); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'template_subject'); ?>
                    <?php echo $form->textArea($model, 'template_subject', array('maxlength' => 200, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('template_subject'))); ?>
                    <?php echo $form->error($model, 'template_subject', array('class' => 'text-red')); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'template_parameters'); ?>
                    <?php echo $form->textArea($model, 'template_parameters', array('maxlength' => 1000, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('template_parameters'))); ?>
                    <?php echo $form->error($model, 'template_parameters', array('class' => 'text-red')); ?>
                </div>
            </div>
        </div>        
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <?php echo $form->labelEx($model, 'template_content'); ?>
            <?php echo $form->textArea($model, 'template_content', array('class' => 'form-control', 'rows' => 16, 'placeholder' => $model->getAttributeLabel('template_content'))); ?>
            <?php echo $form->error($model, 'template_content', array('class' => 'text-red')); ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        <?php if (!$model->isNewRecord) { ?>                    
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <?php echo $form->checkBox($model, 'template_status'); ?> <?php echo $model->getAttributeLabel('template_status'); ?>
                        <?php echo $form->error($model, 'template_status', array('class' => 'text-red')); ?>
                    </label>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="col-md-12">
        <?php
        if ($model->isNewRecord) {
            echo CHtml::submitButton('Add Email Template', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
            echo '&nbsp;&nbsp;';
            echo CHtml::resetButton('Reset', array('class' => 'btn btn-warning btn-square', 'id' => 'btnReset'));
        } else {
            echo CHtml::submitButton('Update Email Template', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
        }
        ?>
    </div>
</div>

<?php $this->endWidget(); ?>

<style type="text/css">    
    textarea {resize: none;}
</style>
<script type="text/javascript">
    $(function () {
        $('#Template_template_title').blur(function () {
            var name = $(this).val();
            var slug = name.replace(/\s/g, '-');
            slug = slug.toLowerCase();
            $('#Template_template_alias').val(slug);
        });
    });
</script>