<?php
$create_url = Yii::app()->createAbsoluteUrl('admin/state/create');
$update_url = Yii::app()->createAbsoluteUrl('admin/state/update/id/' . $model->state_id);

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'state-form',
    'action' => ($model->isNewRecord) ? $create_url : $update_url,
    'enableAjaxValidation' => TRUE,
    'enableClientValidation' => TRUE,
    'clientOptions' => array(
        'validateOnSubmit' => TRUE,
        'validateOnChange' => TRUE
    ),
    'htmlOptions' => array(
        'autocomplete' => 'off',
        'role' => 'form'
    ),
    'focus' => array($model, 'state_countryID'),
        ));
?>

<div class="row">
    <div class="col-md-12">        
        <div class="row">
            <div class="col-md-12">

                <div class="form-group">
                    <?php $countries = CHtml::listData(Country::model()->order_by()->findAll(), 'country_id', 'country_name'); ?>
                    <?php echo $form->labelEx($model, 'state_countryID'); ?>
                    <?php echo $form->dropDownList($model, 'state_countryID', $countries, array('class' => 'form-control', 'empty' => $model->getAttributeLabel('state_countryID'))); ?>
                    <?php echo $form->error($model, 'state_countryID'); ?>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'state_name'); ?>
                    <?php echo $form->textField($model, 'state_name', array('maxlength' => 200, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('state_name'))); ?>
                    <?php echo $form->error($model, 'state_name'); ?>
                </div>                

                <?php if (!$model->isNewRecord) { ?>                    
                    <div class="form-group">
                        <?php echo $form->checkBox($model, 'state_status', array('class' => '')); ?>
                        <?php echo $form->labelEx($model, 'state_status'); ?>                        
                        <?php echo $form->error($model, 'state_status', array('class' => 'text-red')); ?>
                    </div>                    
                <?php } ?>
            </div>            
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($model->isNewRecord) {
                    echo CHtml::submitButton('Add State', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
                    echo '&nbsp;&nbsp;';
                    echo CHtml::resetButton('Reset', array('class' => 'btn btn-warning btn-square', 'id' => 'btnReset'));
                } else {
                    echo CHtml::submitButton('Update State', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>

<style type="text/css">
    .checkbox, .radio {     
        margin-bottom: 3px;
        margin-top: 3px;     
    }
</style>