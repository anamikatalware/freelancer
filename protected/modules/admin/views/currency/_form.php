<?php
$create_url = Yii::app()->createAbsoluteUrl('admin/currency/create');
$update_url = Yii::app()->createAbsoluteUrl('admin/currency/update/id/' . $model->currency_id);

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'currency-form',
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
    'focus' => array($model, 'currency_name')
        ));
?>

<div class="row">
    <div class="col-sm-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'currency_name'); ?>
                    <?php echo $form->textField($model, 'currency_name', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('currency_name'))); ?>
                    <?php echo $form->error($model, 'currency_name', array('class' => 'text-red')); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'currency_code'); ?>
                    <?php echo $form->textField($model, 'currency_code', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('currency_code'))); ?>
                    <?php echo $form->error($model, 'currency_code', array('class' => 'text-red')); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'currency_icon'); ?>
                    <?php echo $form->textField($model, 'currency_icon', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('currency_icon'))); ?>
                    <?php echo $form->error($model, 'currency_icon', array('class' => 'text-red')); ?>
                </div>

                <?php if (!$model->isNewRecord) { ?>                    
                    <div class="form-group">
                        <?php echo $form->checkBox($model, 'currency_status'); ?>
                        <?php echo $form->labelEx($model, 'currency_status'); ?>
                        <?php echo $form->error($model, 'currency_status', array('class' => 'text-red')); ?>
                    </div>                    
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($model->isNewRecord) {
                    echo CHtml::submitButton('Add Currency', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
                    echo '&nbsp;&nbsp;';
                    echo CHtml::resetButton('Reset', array('class' => 'btn btn-warning btn-square', 'id' => 'btnReset'));
                } else {
                    echo CHtml::submitButton('Update Currency', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    $(function () {
        $('#Currency_currency_code').bind('keydown, blur', function () {
            var currency = $(this).val();
            currency = currency.toUpperCase();
            $(this).val(currency);
        });
    });
</script>