<?php
$this->pageTitle = Yii::app()->name . ' - Login';

//$utils = new Utils();
//echo $utils->passwordEncrypt(123456);
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
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
    <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('username'))); ?>
    <?php echo $form->error($model, 'username'); ?>    
    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
</div>
<div class="form-group has-feedback">
    <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('password'))); ?>
    <?php echo $form->error($model, 'password'); ?>
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
</div>
<div class="row">
    <div class="col-xs-8">
        <?php echo $form->checkBox($model, 'rememberMe'); ?>
        <?php echo $form->label($model, 'rememberMe'); ?>
        <?php echo $form->error($model, 'rememberMe'); ?>
    </div><!-- /.col -->
    <div class="col-xs-4">
        <?php echo CHtml::submitButton('Sign In', array('class' => 'btn btn-primary btn-block btn-flat')); ?>
    </div><!-- /.col -->
    <div class="col-xs-12">
        <a href="/admin/site/forgotpassword">Forgot your Password?</a>
    </div>
</div>
<?php $this->endWidget(); ?>              