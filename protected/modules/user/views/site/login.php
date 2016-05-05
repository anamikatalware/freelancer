<?php $this->pageTitle = Yii::app()->name . ' - Log In'; ?>

<script src="<?php echo Yii::app()->baseUrl ?>/bootstrap/frontend/js/facebook.js" type="text/javascript"></script>
<script src="https://apis.google.com/js/api:client.js"></script>
<script src="<?php echo Yii::app()->baseUrl ?>/bootstrap/frontend/js/google.js" type="text/javascript"></script>

<div class="page-header one">
    <div class="container">
        <div class="col-md-6 left-padd0">
            <h3 class="font30 nomargin white uppercase">Login</h3>
            <h4 class="font18 white font-thin">User Login Here...!</h4>
        </div>
        <div class="col-md-6">
            <div class="pagenation"><a href="/">Home</a> <i>/</i> Log In</div>
        </div>
    </div>
</div>
<!-- end page header -->

<div class="section-lg one">
    <div class="container">
        <div class="row">
            <div class="login_form">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'sky-form',
                    'enableClientValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                    ),
                    'htmlOptions' => array('class' => 'sky-form', 'novalidate' => 'novalidate')
                ));
                ?>
                <header class="font-slim">Login</header>
                <fieldset>
                    <section>
                        <div class="row">
                            <?php echo $form->label($model, 'username', array('class' => 'label col col-4')); ?>
                            <div class="col col-8">
                                <label class="input"> 
                                    <i class="icon-append fa fa-user"></i>
                                    <?php echo $form->textField($model, 'username', array('placeholder' => $model->getAttributeLabel('username'))); ?>
                                </label>
                                <?php echo $form->error($model, 'username', array('class' => 'text-red')); ?>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="row">
                            <?php echo $form->label($model, 'password', array('class' => 'label col col-4')); ?>
                            <div class="col col-8">
                                <label class="input"> 
                                    <i class="icon-append fa fa-lock"></i>
                                    <?php echo $form->passwordField($model, 'password', array('placeholder' => $model->getAttributeLabel('password'))); ?>    
                                </label>
                                <?php echo $form->error($model, 'password', array('class' => 'text-red')); ?>
                                <div class="note"><a href="/forgot-password" class="modal-opener">Forgot password?</a></div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="row">
                            <div class="col col-4"></div>
                            <div class="col col-8">
                                <label class="checkbox">
                                    <input type="checkbox" name="remember" checked="">
                                    <?php echo $form->checkBox($model, 'rememberMe', array('checked' => 'checked')); ?>
                                    <i></i>Keep me logged in
                                </label>
                            </div>
                        </div>
                    </section>
                </fieldset>
                <footer>
                    <div class="fright">
                        <?php echo CHtml::Button('Sign up now!', array('class' => 'button button-secondary', 'onclick' => 'window.location.href="/register"')); ?>
                        <?php echo CHtml::submitButton('Log In', array('class' => 'button')); ?>
                    </div>
                </footer>                
                <div class="social-login">
                    <h4 class="box-or"><span>OR</span></h4>
                    <div>
                        <input value="Sign in with Facebook" type="button" class="button fb-signin" />
                        <input value="Sign in with Google+" type="button" class="button" id="googleBtn" />
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>
<!-- end features section 1 -->

<style type="text/css">
    /*    .sky-form .button {float: none;margin: 0 auto;margin-top: 10px;}*/
</style>