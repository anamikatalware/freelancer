<?php
$changePasswordModel = new ChangePasswordForm();

$changePasswordForm = $this->beginWidget('CActiveForm', array(
    'id' => 'change-password-form',
    'action'=>'/admin/site/changePassword',
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
    <label class="col-sm-3 control-label" for="password_old">Old Password</label>
    <div class="col-sm-9">
        <?php echo $changePasswordForm->passwordField($changePasswordModel, 'password_old', array('value' => '', 'class' => 'form-control', 'placeholder' => $changePasswordModel->getAttributeLabel('password_old'))); ?>
        <?php echo $changePasswordForm->error($changePasswordModel, 'password_old'); ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label" for="password_new">New Password</label>
    <div class="col-sm-9">
        <?php echo $changePasswordForm->passwordField($changePasswordModel, 'password_new', array('class' => 'form-control', 'placeholder' => $changePasswordModel->getAttributeLabel('password_new'))); ?>
        <?php echo $changePasswordForm->error($changePasswordModel, 'password_new'); ?>    
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label" for="inputName">Confirm New Password</label>
    <div class="col-sm-9">
        <?php echo $changePasswordForm->passwordField($changePasswordModel, 'password_confirmation', array('class' => 'form-control', 'placeholder' => $changePasswordModel->getAttributeLabel('password_confirmation'))); ?>
        <?php echo $changePasswordForm->error($changePasswordModel, 'password_confirmation'); ?>    
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        <?php echo CHtml::submitButton('Change Password', array('class' => 'btn btn-primary')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>