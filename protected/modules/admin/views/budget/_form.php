<?php
$create_url = Yii::app()->createAbsoluteUrl('admin/budget/create');
$update_url = Yii::app()->createAbsoluteUrl('admin/budget/update/id/' . $model->budget_id);

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'budget-form',
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
    'focus' => array($model, 'budget_budgettypeID')
        ));
?>

<div class="row">
    <div class="col-sm-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <?php $budgettypes = CHtml::listData(BudgetType::model()->findAll(), 'budgettype_id', 'budgettype_name'); ?>
                    <?php echo $form->labelEx($model, 'budget_budgettypeID'); ?>
                    <?php echo $form->dropDownList($model, 'budget_budgettypeID', $budgettypes, array('maxlength' => 100, 'class' => 'form-control', 'empty' => $model->getAttributeLabel('budget_budgettypeID'))); ?>
                    <?php echo $form->error($model, 'budget_budgettypeID', array('class' => 'text-red')); ?>
                </div>             
                <div class="form-group">
                    <?php $currencies = CHtml::listData(Currency::model()->findAll(array('order' => 'currency_order')), 'currency_id', 'currency_name'); ?>
                    <?php echo $form->labelEx($model, 'budget_currencyID'); ?>
                    <?php echo $form->dropDownList($model, 'budget_currencyID', $currencies, array('maxlength' => 100, 'class' => 'form-control', 'empty' => $model->getAttributeLabel('budget_currencyID'))); ?>
                    <?php echo $form->error($model, 'budget_currencyID', array('class' => 'text-red')); ?>
                </div>             
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'budget_name'); ?>
                    <?php echo $form->textField($model, 'budget_name', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('budget_name'))); ?>
                    <?php echo $form->error($model, 'budget_name', array('class' => 'text-red')); ?>
                </div>             
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'budget_min_value'); ?>
                    <?php echo $form->textField($model, 'budget_min_value', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('budget_min_value'))); ?>
                    <?php echo $form->error($model, 'budget_min_value', array('class' => 'text-red')); ?>
                </div>             
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'budget_max_value'); ?>
                    <?php echo $form->textField($model, 'budget_max_value', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('budget_max_value'))); ?>
                    <?php echo $form->error($model, 'budget_max_value', array('class' => 'text-red')); ?>
                </div>             

                <?php if (!$model->isNewRecord) { ?>                    
                    <div class="form-group">
                        <?php echo $form->checkBox($model, 'budget_status'); ?>
                        <?php echo $form->labelEx($model, 'budget_status'); ?>
                        <?php echo $form->error($model, 'budget_status', array('class' => 'text-red')); ?>
                    </div>                    
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($model->isNewRecord) {
                    echo CHtml::submitButton('Add Budget', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
                    echo '&nbsp;&nbsp;';
                    echo CHtml::resetButton('Reset', array('class' => 'btn btn-warning btn-square', 'id' => 'btnReset'));
                } else {
                    echo CHtml::submitButton('Update Budget', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>