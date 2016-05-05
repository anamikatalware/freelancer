<?php
$create_url = Yii::app()->createAbsoluteUrl('admin/feature/create');
$update_url = Yii::app()->createAbsoluteUrl('admin/feature/update/id/' . $model->feature_id);

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'feature-form',
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
    'focus' => array($model, 'feature_id')
        ));
?>

<div class="row">
    <div class="col-sm-6">
        <div class="row">
            <div class="col-sm-12">


                <div class="form-group">
                    <?php echo $form->labelEx($model, 'feature_name'); ?>
                    <?php echo $form->textArea($model, 'feature_name', array('maxlength' => 1000, 'rows' =>6, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('feature_name'))); ?>
                    <?php echo $form->error($model, 'feature_name', array('class' => 'text-red')); ?>
                </div>
                 <div class="form-group">
                    <?php echo $form->labelEx($model, 'feature_key'); ?>
                    <?php echo $form->textField($model, 'feature_key', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('feature_key'))); ?>
                    <?php echo $form->error($model, 'feature_key', array('class' => 'text-red')); ?>
                </div>
                 <div class="form-group">
                    <?php echo $form->labelEx($model, 'feature_fixedvalue'); ?>
                    <?php echo $form->textField($model, 'feature_fixedvalue', array('maxlength' => 10, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('feature_fixedvalue'))); ?>
                    <?php echo $form->error($model, 'feature_fixedvalue', array('class' => 'text-red')); ?>
                </div>
                 <div class="form-group">
                    <?php echo $form->labelEx($model, 'feature_percentagevalue'); ?>
                    <?php echo $form->textField($model, 'feature_percentagevalue', array('maxlength' => 10, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('feature_percentagevalue'))); ?>
                    <?php echo $form->error($model, 'feature_percentagevalue', array('class' => 'text-red')); ?>
                </div>
                



                <?php if (!$model->isNewRecord) { ?>                    
                    <div class="form-group">
                        <?php echo $form->checkBox($model, 'status'); ?>
                        <?php echo $form->labelEx($model, 'status'); ?>
                        <?php echo $form->error($model, 'status', array('class' => 'text-red')); ?>
                    </div>                    
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($model->isNewRecord) {
                    echo CHtml::submitButton('Add Feature', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
                    echo '&nbsp;&nbsp;';
                    echo CHtml::resetButton('Reset', array('class' => 'btn btn-warning btn-square', 'id' => 'btnReset'));
                } else {
                    echo CHtml::submitButton('Update Feature', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>