<?php
$create_url = Yii::app()->createAbsoluteUrl('admin/page/create');
$update_url = Yii::app()->createAbsoluteUrl('admin/page/update/id/' . $model->page_id);

Yii::app()->clientScript->registerScriptFile($this->module->assetsUrl . '/js/tinymce/tinymce.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('messagesjs', '
		tinymce.init({'
        . (file_exists(dirname(__FILE__) . '/../../assets/js/tinymce/langs/' . Yii::app()->getLanguage() . '.js') ? ('language: "' . Yii::app()->getLanguage() . '",') : '') .
        'selector: "#Page_page_description",
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
    'id' => 'page-form',
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
    'focus' => array($model, 'page_name')
        ));
?>

<div class="row">
    <div class="col-sm-8">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'page_name'); ?>
                    <?php echo $form->textField($model, 'page_name', array('maxlength' => 255, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('page_name'))); ?>
                    <?php echo $form->error($model, 'page_name', array('class' => 'text-red')); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'page_slug'); ?>
                    <?php echo $form->textField($model, 'page_slug', array('maxlength' => 255, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('page_slug'))); ?>
                    <?php echo $form->error($model, 'page_slug', array('class' => 'text-red')); ?>
                </div>
            </div>
        </div>        
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <?php echo $form->labelEx($model, 'page_description'); ?>
            <?php echo $form->textArea($model, 'page_description', array('class' => 'form-control', 'rows' => 16, 'placeholder' => $model->getAttributeLabel('page_description'))); ?>
            <?php echo $form->error($model, 'page_description', array('class' => 'text-red')); ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        <?php if (!$model->isNewRecord) { ?>                    
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <?php echo $form->checkBox($model, 'page_status'); ?> <?php echo $model->getAttributeLabel('page_status'); ?>
                        <?php echo $form->error($model, 'page_status', array('class' => 'text-red')); ?>
                    </label>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="col-md-12">
        <?php
        if ($model->isNewRecord) {
            echo CHtml::submitButton('Add Page', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
            echo '&nbsp;&nbsp;';
            echo CHtml::resetButton('Reset', array('class' => 'btn btn-warning btn-square', 'id' => 'btnReset'));
        } else {
            echo CHtml::submitButton('Update Page', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
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
        $('#Page_page_name').blur(function () {
            var name = $(this).val();
            var slug = name.replace(/\s/g, '-');
            slug = slug.toLowerCase();
            $('#Page_page_slug').val(slug);
        });
    });
</script>