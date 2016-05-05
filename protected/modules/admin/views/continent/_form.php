<?php
$create_url = Yii::app()->createAbsoluteUrl('admin/continent/create');
$update_url = Yii::app()->createAbsoluteUrl('admin/continent/update/id/' . $model->continent_id);

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'continent-form',
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
    'focus' => array($model, 'continent_name')
        ));
?>

<div class="row">
    <div class="col-sm-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'continent_name'); ?>
                    <?php echo $form->textField($model, 'continent_name', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('continent_name'))); ?>
                    <?php echo $form->error($model, 'continent_name', array('class' => 'text-red')); ?>
                </div>             

                <?php if (!$model->isNewRecord) { ?>                    
                    <div class="form-group">
                        <?php echo $form->checkBox($model, 'continent_status'); ?>
                        <?php echo $form->labelEx($model, 'continent_status'); ?>
                        <?php echo $form->error($model, 'continent_status', array('class' => 'text-red')); ?>
                    </div>                    
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($model->isNewRecord) {
                    echo CHtml::submitButton('Add Continent', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
                    echo '&nbsp;&nbsp;';
                    echo CHtml::resetButton('Reset', array('class' => 'btn btn-warning btn-square', 'id' => 'btnReset'));
                } else {
                    echo CHtml::submitButton('Update Continent', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>