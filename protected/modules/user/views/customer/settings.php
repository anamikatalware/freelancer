<?php $this->pageTitle = Yii::app()->name . ' - Settings'; ?>

<div class="page-header one">
    <div class="container">
        <div class="col-md-6 left-padd0">
            <h3 class="font30 nomargin white uppercase">Settings</h3>
            <h4 class="font18 white font-thin">You can change your profile here...!</h4>
        </div>
        <div class="col-md-6">
            <div class="pagenation"><a href="/dashboard">My Account</a> <i>/</i> Settings</div>
        </div>
    </div>
</div>
<!-- end page header -->

<div class="section-lg one">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a data-toggle="tab" href="#sky-profile">Profile</a></li>
                    <li><a data-toggle="tab" href="#membership">Membership</a></li>
                    <li><a data-toggle="tab" href="#password">Password</a></li>
<!--                    <li><a data-toggle="tab" href="#trustverification">Trust & Verification</a></li>-->
                    <li><a data-toggle="tab" href="#account">Account</a></li>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="tab-content">
                    <div id="statusMsg"></div>
                    <?php if (Yii::app()->user->hasFlash('message')): ?>
                        <div class="alert alert-<?php echo Yii::app()->user->getFlash('type'); ?> alert-dismissable" id="successmsg">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo Yii::app()->user->getFlash('message'); ?>
                        </div>
                    <?php endif; ?>

                    <div id="sky-profile" class="tab-pane fade in active">
                        <?php echo $this->renderPartial('settings/profile'); ?>
                    </div>
                    <div id="membership" class="tab-pane fade">
                        <?php echo $this->renderPartial('settings/membership'); ?>
                    </div>
                    <div id="password" class="tab-pane fade">
                        <?php echo $this->renderPartial('settings/password'); ?>
                    </div>
                    <div id="trustverification" class="tab-pane fade">
                        <?php echo $this->renderPartial('settings/trust_verification'); ?>
                    </div>
                    <div id="account" class="tab-pane fade">
                        <?php echo $this->renderPartial('settings/account'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .nav-pills > li.active > a, .nav-pills > li.active > a:focus, .nav-pills > li.active > a:hover {background-color: rgb(0, 159, 240);border-radius:0;}
    .nav > li > a:focus, .nav > li > a:hover {border-radius: 0;}
    .button {text-align: right;margin-top: 10px;}
    .button a {margin: 0;}
    .sky-form .button {float: left;margin: 0;}    
    .c-post.one {margin-left: 20px;margin-right: 20px;}
</style>