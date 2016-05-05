<?php
$this->pageTitle = 'User Profile';
$user_id = Yii::app()->user->id;
$user = User::model()->findByPk($user_id);
?>

<div class="row">
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img alt="User profile picture" src="<?php echo $this->module->assetsUrl; ?>/dist/img/user2-160x160.jpg" class="profile-user-img img-responsive img-circle">
                <h3 class="profile-username text-center">
                    <?php echo ucwords($user->user_firstname . ' ' . $user->user_lastname); ?>
                </h3>
<!--                <p class="text-muted text-center">Software Engineer</p>-->

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Followers</b> <a class="pull-right">1,322</a>
                    </li>
                    <li class="list-group-item">
                        <b>Following</b> <a class="pull-right">543</a>
                    </li>
                    <li class="list-group-item">
                        <b>Friends</b> <a class="pull-right">13,287</a>
                    </li>
                </ul>

                <a class="btn btn-primary btn-block" href="#"><b>Follow</b></a>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
    <div class="col-md-9">

        <?php if (Yii::app()->user->hasFlash('message')): ?>
            <div class="alert alert-<?php echo Yii::app()->user->getFlash('type'); ?> alert-dismissable" id="successmsg">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo Yii::app()->user->getFlash('message'); ?>
            </div>
        <?php endif; ?>

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">                
                <li class="active"><a data-toggle="tab" href="#profile" aria-expanded="true">Profile</a></li>
                <li class=""><a data-toggle="tab" href="#changepassword">Change Password</a></li>
            </ul>
            <div class="tab-content">
                <div id="profile" class="tab-pane active">
                    <?php $this->renderPartial('forms/profileEditFile'); ?>
                </div><!-- /.tab-pane -->

                <div id="changepassword" class="tab-pane">
                    <?php $this->renderPartial('forms/changePasswordFile'); ?>
                </div><!-- /.tab-pane -->
            </div><!-- /.tab-content -->
        </div><!-- /.nav-tabs-custom -->
    </div><!-- /.col -->
</div><!-- /.row -->

