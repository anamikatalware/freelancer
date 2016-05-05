<?php
$create_url = Yii::app()->createAbsoluteUrl('admin/city/create');
$update_url = Yii::app()->createAbsoluteUrl('admin/city/update/id/' . $model->city_id);

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'city-form',
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
    'focus' => array($model, 'city_stateID'),
        ));
?>

<div class="row">
    <div class="col-md-12">        
        <div class="row">
            <div class="col-md-12">

                <div class="form-group">
                    <?php $states= CHtml::listData(State::model()->order_by()->findAll(), 'state_id', 'state_name'); ?>
                    <?php echo $form->labelEx($model, 'city_stateID'); ?>
                    <?php echo $form->dropDownList($model, 'city_stateID', $states, array('class' => 'form-control', 'empty' => $model->getAttributeLabel('city_stateID'))); ?>
                    <?php echo $form->error($model, 'city_stateID'); ?>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'city_name'); ?>
                    <?php echo $form->textField($model, 'city_name', array('maxlength' => 200, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('city_name'))); ?>
                    <?php echo $form->error($model, 'city_name'); ?>
                </div>                

                <?php if (!$model->isNewRecord) { ?>                    
                    <div class="form-group">
                        <?php echo $form->checkBox($model, 'city_status', array('class' => '')); ?>
                        <?php echo $form->labelEx($model, 'city_status'); ?>                        
                        <?php echo $form->error($model, 'city_status', array('class' => 'text-red')); ?>
                    </div>                    
                <?php } ?>
            </div>            
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($model->isNewRecord) {
                    echo CHtml::submitButton('Add City', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
                    echo '&nbsp;&nbsp;';
                    echo CHtml::resetButton('Reset', array('class' => 'btn btn-warning btn-square', 'id' => 'btnReset'));
                } else {
                    echo CHtml::submitButton('Update City', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
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