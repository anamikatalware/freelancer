<?php
$create_url = Yii::app()->createAbsoluteUrl('admin/faqCategory/create');
$update_url = Yii::app()->createAbsoluteUrl('admin/faqCategory/update/id/' . $model->faqcategory_id);

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'faqcategory-form',
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
    'focus' => array($model, 'faqcategory_name')
        ));
?>

<div class="row">
    <div class="col-sm-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'faqcategory_name'); ?>
                    <?php echo $form->textField($model, 'faqcategory_name', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('faqcategory_name'))); ?>
                    <?php echo $form->error($model, 'faqcategory_name', array('class' => 'text-red')); ?>
                </div>             
                
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'faqcategory_slug'); ?>
                    <?php echo $form->textField($model, 'faqcategory_slug', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('faqcategory_slug'))); ?>
                    <?php echo $form->error($model, 'faqcategory_slug', array('class' => 'text-red')); ?>
                </div>                

                <?php if (!$model->isNewRecord) { ?>                    
                    <div class="form-group">
                        <?php echo $form->checkBox($model, 'faqcategory_status'); ?>
                        <?php echo $form->labelEx($model, 'faqcategory_status'); ?>
                        <?php echo $form->error($model, 'faqcategory_status', array('class' => 'text-red')); ?>
                    </div>                    
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($model->isNewRecord) {
                    echo CHtml::submitButton('Add FAQ Category', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
                    echo '&nbsp;&nbsp;';
                    echo CHtml::resetButton('Reset', array('class' => 'btn btn-warning btn-square', 'id' => 'btnReset'));
                } else {
                    echo CHtml::submitButton('Update FAQ Category', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    $(function () {
        $('#FaqCategory_faqcategory_name').bind('keydown, blur', function () {
            var name = $(this).val();
            var slug = name.replace(/\s/g, '-');
            slug = slug.toLowerCase();
            $('#FaqCategory_faqcategory_slug').val(slug);
        });
    });
</script>