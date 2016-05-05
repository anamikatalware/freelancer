<?php $this->pageTitle = Yii::app()->name . ' - Reset Password'; ?>

<?php
$model = new ResetPasswordForm;

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'reset-password-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ))
);
?>

<?php if (Yii::app()->user->hasFlash('message')): ?>
    <div class="alert alert-<?php echo Yii::app()->user->getFlash('type'); ?> alert-dismissable" id="successmsg">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo Yii::app()->user->getFlash('message'); ?>
    </div>
<?php endif; ?>

<div class="form-group has-feedback">
    <?php echo $form->passwordField($model, 'password_new', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('password_new'))); ?>
    <?php echo $form->error($model, 'password_new'); ?>    
    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
</div>

<div class="form-group has-feedback">
    <?php echo $form->passwordField($model, 'password_confirmation', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('password_confirmation'))); ?>
    <?php echo $form->error($model, 'password_confirmation'); ?>    
    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
</div>

<div class="row">
    <div class="col-xs-6 col-xs-offset-6">
        <?php echo CHtml::submitButton('Reset Password', array('class' => 'btn btn-primary btn-block btn-flat')); ?>
    </div><!-- /.col -->
    <div class="col-xs-12">
        <a href="/admin/site/login">Back to Login</a>
    </div>
</div>
<?php $this->endWidget(); ?>