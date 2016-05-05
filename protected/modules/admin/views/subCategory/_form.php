<?php
$create_url = Yii::app()->createAbsoluteUrl('admin/subCategory/create');
$update_url = Yii::app()->createAbsoluteUrl('admin/subCategory/update/id/' . $model->subcategory_id);

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'sub-category-form',
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
    'focus' => array($model, 'subcategory_name')
        ));
?>

<div class="row">
    <div class="col-sm-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <?php $categories = CHtml::listData(Category::model()->findAll(), 'category_id', 'category_name') ?>
                    <?php echo $form->labelEx($model, 'subcategory_categoryID'); ?>
                    <?php echo $form->dropDownList($model, 'subcategory_categoryID', $categories, array('maxlength' => 100, 'class' => 'form-control', 'empty' => $model->getAttributeLabel('subcategory_categoryID'))); ?>
                    <?php echo $form->error($model, 'subcategory_categoryID', array('class' => 'text-red')); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'subcategory_name'); ?>
                    <?php echo $form->textField($model, 'subcategory_name', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('subcategory_name'))); ?>
                    <?php echo $form->error($model, 'subcategory_name', array('class' => 'text-red')); ?>
                </div>

                <?php if (!$model->isNewRecord) { ?>                    
                    <div class="form-group">
                        <?php echo $form->checkBox($model, 'subcategory_status'); ?>
                        <?php echo $form->labelEx($model, 'subcategory_status'); ?>
                        <?php echo $form->error($model, 'subcategory_status', array('class' => 'text-red')); ?>
                    </div>                    
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($model->isNewRecord) {
                    echo CHtml::submitButton('Add Sub Category', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
                    echo '&nbsp;&nbsp;';
                    echo CHtml::resetButton('Reset', array('class' => 'btn btn-warning btn-square', 'id' => 'btnReset'));
                } else {
                    echo CHtml::submitButton('Update Sub Category', array('class' => 'btn btn-success btn-square', 'id' => 'btnSave'));
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>