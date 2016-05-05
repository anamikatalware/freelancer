<?php
$create_url = Yii::app()->createAbsoluteUrl('admin/budgetType/create');
$update_url = Yii::app()->createAbsoluteUrl('admin/budgetType/update/id/' . $model->budgettype_id);

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'budgettype-form',
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
    'focus' => array($model, 'budgettype_name')
        ));
?>

<div class="row">
    <div class="col-sm-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'budgettype_name'); ?>
                    <?php echo $form->textField($model, 'budgettype_name', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('budgettype_name'))); ?>
                    <?php echo $form->error($model, 'budgettype_name', array('class' => 'text-red')); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'budgettype_slug'); ?>
                    <?php echo $form->textField($model, 'budgettype_slug', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('budgettype_slug'))); ?>
                    <?php echo $form->error($model, 'budgettype_slug', array('class' => 'text-red')); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'budgettype_description'); ?>
                    <?php echo $form->textArea($model, 'budgettype_description', array('maxlength' => 500, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('budgettype_description'))); ?>
                    <?php echo $form->error($model, 'budgettype_description', array('class' => 'text-red')); ?>
                </div>

                <?php if (!$model->isNewRecord) { ?>                    
                    <div class="form-group">
                        <?php echo $form->checkBox($model, 'budgettype_status'); ?>
                        <?php echo $form->labelEx($model, 'budgettype_status'); ?>
                        <?php echo $form->error($model, 'budgettype_status', array('class' => 'text-red')); ?>
                    </div>                    
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($model->isNewRecord) {
                    echo CHtml::submitButton('Add Budget Type', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
                    echo '&nbsp;&nbsp;';
                    echo CHtml::resetButton('Reset', array('class' => 'btn btn-warning btn-square', 'id' => 'btnReset'));
                } else {
                    echo CHtml::submitButton('Update Budget Type', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    $(function () {
        $('#BudgetType_budgettype_name').bind('keydown, blur', function () {
            var name = $(this).val();
            var slug = name.replace(/\s/g, '-');
            slug = slug.toLowerCase();
            $('#BudgetType_budgettype_slug').val(slug);
        });
    });
</script>