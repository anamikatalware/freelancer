<?php $model = new CustomerChangePasswordForm(); ?>
<div class="widget m-bottom4">
    <div class="cat-title white font-bold uppercase">
        Change Password
    </div>
    <div class="c-post one">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'sky-change-pass',
            'enableClientValidation' => true,
            'enableAjaxValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
                'validateOnChange' => true,
            ),
            'htmlOptions' => array('class' => 'sky-form')
        ));
        ?>
        <fieldset>
            <section>
                <div class="row">
                    <label class="label col col-4">Current Password</label>
                    <div class="col col-8">
                        <label class="input"> 
                            <i class="icon-append fa fa-lock"></i>
                            <?php echo $form->passwordField($model, 'password_old', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('password_old'))); ?>
                            <?php echo $form->error($model, 'password_old'); ?>

                        </label>
                    </div>
                </div>
            </section>
            <section>
                <div class="row">
                    <label class="label col col-4">New Password</label>
                    <div class="col col-8">
                        <label class="input"> 
                            <i class="icon-append fa fa-lock"></i>
                            <?php echo $form->passwordField($model, 'password_new', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('password_new'))); ?>
                            <?php echo $form->error($model, 'password_new'); ?>    

                        </label>
                    </div>
                </div>
            </section>
            <section>
                <div class="row">
                    <label class="label col col-4">Confirm Password</label>
                    <div class="col col-8">
                        <label class="input"> 
                            <i class="icon-append fa fa-lock"></i>
                            <?php echo $form->passwordField($model, 'password_confirmation', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('password_confirmation'))); ?>
                            <?php echo $form->error($model, 'password_confirmation'); ?>    

                        </label>
                    </div>
                </div>
            </section>                    
            <section>
                <div class="row">
                    <label class="label col col-4"></label>
                    <div class="col col-8">
                        <button class="button" type="submit">Save</button>
                        <button class="button button-secondary" type="reset">Cancel</button>
                    </div>
                </div>
            </section>
        </fieldset>
        <?php $this->endWidget(); ?>        
    </div>
</div>