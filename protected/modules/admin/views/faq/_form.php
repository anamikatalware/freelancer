<?php
$create_url = Yii::app()->createAbsoluteUrl('admin/faq/create');
$update_url = Yii::app()->createAbsoluteUrl('admin/faq/update/id/' . $model->faq_id);

Yii::app()->clientScript->registerScriptFile($this->module->assetsUrl . '/js/tinymce/tinymce.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('messagesjs', '
		tinymce.init({'
        . (file_exists(dirname(__FILE__) . '/../../assets/js/tinymce/langs/' . Yii::app()->getLanguage() . '.js') ? ('language: "' . Yii::app()->getLanguage() . '",') : '') .
        'selector: "#Faq_faq_answer",
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
    'id' => 'faq-form',
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
    'focus' => array($model, 'faq_question')
        ));
?>

<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <?php $categories = CHtml::listData(FaqCategory::model()->findAll(), 'faqcategory_id', 'faqcategory_name') ?>
                    <?php echo $form->labelEx($model, 'faq_faqcategoryID'); ?>
                    <?php echo $form->dropDownList($model, 'faq_faqcategoryID', $categories, array('maxlength' => 100, 'class' => 'form-control', 'empty' => $model->getAttributeLabel('faq_faqcategoryID'))); ?>
                    <?php echo $form->error($model, 'faq_faqcategoryID', array('class' => 'text-red')); ?>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'faq_question'); ?>
                    <?php echo $form->textArea($model, 'faq_question', array('maxlength' => 1000, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('faq_question'))); ?>
                    <?php echo $form->error($model, 'faq_question', array('class' => 'text-red')); ?>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'faq_answer'); ?>
                    <?php echo $form->textArea($model, 'faq_answer', array('rows' => 10, 'maxlength' => 2000, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('faq_answer'))); ?>
                    <?php echo $form->error($model, 'faq_answer', array('class' => 'text-red')); ?>
                </div>

                <?php if (!$model->isNewRecord) { ?>                    
                    <div class="form-group">
                        <?php echo $form->checkBox($model, 'faq_status'); ?>
                        <?php echo $form->labelEx($model, 'faq_status'); ?>
                        <?php echo $form->error($model, 'faq_status', array('class' => 'text-red')); ?>
                    </div>                    
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($model->isNewRecord) {
                    echo CHtml::submitButton('Add FAQ', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
                    echo '&nbsp;&nbsp;';
                    echo CHtml::resetButton('Reset', array('class' => 'btn btn-warning btn-square', 'id' => 'btnReset'));
                } else {
                    echo CHtml::submitButton('Update FAQ', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>