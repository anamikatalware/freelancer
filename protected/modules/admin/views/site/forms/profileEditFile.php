<?php
$user_id = Yii::app()->user->id;
$profileModel = User::model()->findByPk($user_id);

$profileForm = $this->beginWidget('CActiveForm', array(
    'id' => 'profile-form',
    'action' => '/admin/site/profile',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array(
        'autocomplete' => 'off',
        'class' => 'form-horizontal'
    ))
);
?>
<div class="form-group">
    <label class="col-sm-3 control-label" for="user_firstname">First Name</label>
    <div class="col-sm-9">
        <?php echo $profileForm->textField($profileModel, 'user_firstname', array('class' => 'form-control', 'placeholder' => $profileModel->getAttributeLabel('user_firstname'))); ?>
        <?php echo $profileForm->error($profileModel, 'user_firstname'); ?>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label" for="user_lastname">Last Name</label>
    <div class="col-sm-9">
        <?php echo $profileForm->textField($profileModel, 'user_lastname', array('class' => 'form-control', 'placeholder' => $profileModel->getAttributeLabel('user_lastname'))); ?>
        <?php echo $profileForm->error($profileModel, 'user_lastname'); ?>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label" for="user_email">Email</label>
    <div class="col-sm-9">
        <?php echo $profileForm->textField($profileModel, 'user_email', array('class' => 'form-control', 'placeholder' => $profileModel->getAttributeLabel('user_email'))); ?>
        <?php echo $profileForm->error($profileModel, 'user_email'); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        <?php echo CHtml::submitButton('Update', array('class' => 'btn btn-primary')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>