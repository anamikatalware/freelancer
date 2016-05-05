<?php
$create_url = Yii::app()->createAbsoluteUrl('admin/package/create');
$update_url = Yii::app()->createAbsoluteUrl('admin/package/update/id/' . $model->package_id);

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'package-form',
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
    'focus' => array($model, 'package_id')
        ));
?>

<div class="row">
    <div class="col-sm-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'package_name'); ?>
                    <?php echo $form->textField($model, 'package_name', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('price_name'))); ?>
                    <?php echo $form->error($model, 'package_name', array('class' => 'text-red')); ?>
                </div>             
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'package_price'); ?>
                    <?php echo $form->textField($model, 'package_price', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('package_price'))); ?>
                    <?php echo $form->error($model, 'package_price', array('class' => 'text-red')); ?>
                </div>             
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'package_bids_per_month'); ?>
                    <?php echo $form->textField($model, 'package_bids_per_month', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('package_bids_per_month'))); ?>
                    <?php echo $form->error($model, 'package_bids_per_month', array('class' => 'text-red')); ?>
                </div>             
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'package_skills'); ?>
                    <?php echo $form->textField($model, 'package_skills', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('package_skills'))); ?>
                    <?php echo $form->error($model, 'package_skills', array('class' => 'text-red')); ?>
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
                    echo CHtml::submitButton('Add Package', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
                    echo '&nbsp;&nbsp;';
                    echo CHtml::resetButton('Reset', array('class' => 'btn btn-warning btn-square', 'id' => 'btnReset'));
                } else {
                    echo CHtml::submitButton('Update package', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
                }
                ?>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="form-group">
            <?php
            if (!empty($model->package_features)) {
                $feature = json_decode($model->package_features);
            }
            ?>
            <table class="table" id="addedRows">
                <tr> 
                    <td>Feature</td>
                    <td><a href="javascript:void(0);" onclick="addMoreRows(this.form);"> Add More </a> </td> 
                </tr> 
                <?php if (!empty($feature)) { ?>
                    <?php $i = 0; ?>
                    <?php foreach ($feature as $f) { ?>
                        <tr id="<?php echo $i == 0 ? 'rowId' : 'rowCount' . $i ?>">
                            <td><input name="feature[]" type="text" class="form-control" value="<?php echo $f; ?>" /></td>
                            <td>
                                <?php if ($i != 0) { ?>
                                    <a href="javascript:void(0);" onclick="removeRow(<?php echo $i; ?>);">Delete</a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php } ?>
                <?php } else { ?>
                    <tr id="rowId">
                        <td><input name="feature[]" type="text" class="form-control" value="" /></td>
                    </tr>                
                <?php } ?>
            </table>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    var rowCount = 1;

    function addMoreRows(frm) {
        rowCount++;
        var recRow = '<tr id="rowCount' + rowCount + '"><td><input class="form-control" name="feature[]" type="text" /></td><td><a href="javascript:void(0);" onclick="removeRow(' + rowCount + ');">Delete</a></td></tr>';
        jQuery('#addedRows').append(recRow);
    }

    function removeRow(removeNum) {
        jQuery('#rowCount' + removeNum).remove();
    }
</script>