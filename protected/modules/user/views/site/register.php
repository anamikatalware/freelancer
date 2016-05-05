<?php $this->pageTitle = Yii::app()->name . ' - Register'; ?>

<script src="<?php echo Yii::app()->baseUrl ?>/bootstrap/frontend/js/facebook.js" type="text/javascript"></script>
<script src="https://apis.google.com/js/api:client.js"></script>
<script src="<?php echo Yii::app()->baseUrl ?>/bootstrap/frontend/js/google.js" type="text/javascript"></script>

<div class="page-header one">
    <div class="container">
        <div class="col-md-6 left-padd0">
            <h3 class="font30 nomargin white uppercase">Register</h3>
            <h4 class="font18 white font-thin">You can register from here...!</h4>
        </div>
        <div class="col-md-6">
            <div class="pagenation"><a href="/">Home</a> <i>/</i> Register</div>
        </div>
    </div>
</div>
<!-- end page header -->

<div class="section-lg one">
    <div class="container">
        <div class="row">
            <div class="reg_form">
                <?php if (Yii::app()->user->hasFlash('message')): ?>
                    <div class="alert alert-<?php echo Yii::app()->user->getFlash('type'); ?> alert-dismissable text-center" id="successmsg">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo Yii::app()->user->getFlash('message'); ?>
                    </div>
                <?php endif; ?>

                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'sky-form',
                    'enableClientValidation' => true,
                    'enableAjaxValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                        'validateOnChange' => true,
                    ),
                    'htmlOptions' => array('class' => 'sky-form')
                ));
                ?>                
                <header>Don't have an Account? Register Now!</header>
                <fieldset>
                    <section>
                        <label class="input">
                            <i class="icon-append fa fa-user"></i>
                            <?php echo $form->textField($model, 'customer_username', array('placeholder' => $model->getAttributeLabel('customer_username'))); ?>
                            <b class="tooltip tooltip-bottom-right">Please enter 3-16 alphanumeric characters [a-z 0-9] starting with a letter. No spaces.</b>
                        </label>
                        <?php echo $form->error($model, 'customer_username', array('class' => 'text-red')); ?>
                    </section>
                    <section>
                        <label class="input"> 
                            <i class="icon-append fa fa-envelope-o"></i>
                            <?php echo $form->textField($model, 'customer_email', array('placeholder' => $model->getAttributeLabel('customer_email'))); ?>
                            <b class="tooltip tooltip-bottom-right">An email will be sent to this address for verification to complete the register process.</b> 
                        </label>
                        <?php echo $form->error($model, 'customer_email', array('class' => 'text-red')); ?>
                    </section>
                    <section>
                        <label class="input"> 
                            <i class="icon-append fa fa-lock"></i>
                            <?php echo $form->passwordField($model, 'customer_password', array('placeholder' => $model->getAttributeLabel('customer_password'))); ?>
                            <b class="tooltip tooltip-bottom-right">Don't forget to your Password. Use a combination of numeric, lower and upper case characters to increase password strength.</b>
                        </label>
                        <?php echo $form->error($model, 'customer_password', array('class' => 'text-red')); ?>
                    </section>
                    <section>
                        <label class="input"> 
                            <i class="icon-append fa fa-lock"></i>
                            <?php echo $form->passwordField($model, 'confirmpassword', array('placeholder' => $model->getAttributeLabel('confirmpassword'))); ?>
                            <b class="tooltip tooltip-bottom-right">This field must match the field above.</b>
                        </label>
                        <?php echo $form->error($model, 'confirmpassword', array('class' => 'text-red')); ?>
                    </section>
                    <!--                </fieldset>
                                    <fieldset>-->
                    <!--div class="row">
                        <section class="col col-6">
                            <label class="input">
                                <input type="text" placeholder="First name" name="firstname">
                            </label>
                        </section>
                        <section class="col col-6">
                            <label class="input">
                                <input type="text" placeholder="Last name" name="lastname">
                            </label>
                        </section>
                    </div-->
                    <section>
                        <label class="select">
                            <select name="RegisterForm[customer_roleID]" id="RegisterForm_customer_roleID">
                                <option selected="" disabled="" value="">I want to</option>
                                <option value="1">Work</option>
                                <option value="2">Hire</option>
                            </select>
                            <i></i> 
                        </label>
                        <?php echo $form->error($model, 'customer_roleID', array('class' => 'text-red')); ?>
                    </section>
                    <section>
                        <label class="checkbox">
                            <input type="checkbox" id="subscription" name="subscription" checked="checked">
                            <i></i>I want to receive news and  special offers</label>
                        <label class="checkbox">
                            <input type="checkbox" name="RegisterForm[terms]" id="RegisterForm_terms">
                            <i></i>I agree with the Terms and Conditions
                            <?php echo $form->error($model, 'terms', array('class' => 'text-red')); ?>
                        </label>
                    </section>
                </fieldset>
                <footer>
                    <?php echo CHtml::submitButton('Submit', array('class' => 'button', 'id' => 'btnSubmit')); ?>
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
    .sky-form .button {float: none;margin: 0 auto;margin-top: 10px;}
</style>