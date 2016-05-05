<?php $this->pageTitle = Yii::app()->name . ' - Reset Password Error Page'; ?>

<?php if (Yii::app()->user->hasFlash('message')): ?>
    <div class="alert alert-<?php echo Yii::app()->user->getFlash('type'); ?> alert-dismissable text-center" id="successmsg">
<!--        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>-->
        <?php echo Yii::app()->user->getFlash('message'); ?>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-xs-12 text-center">
        <a href="/admin/site/login">Login</a> | <a href="/admin/site/forgotpassword">Forgot Password</a>
    </div>
</div>

<style type="text/css">
    .text-center {
        font-size: 16px;
    }
</style>
