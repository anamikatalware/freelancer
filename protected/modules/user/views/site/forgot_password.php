<?php $this->pageTitle = Yii::app()->name . ' - Forgot Password'; ?>

<div class="page-header one">
    <div class="container">
        <div class="col-md-6 left-padd0">
            <h3 class="font30 nomargin white uppercase">Forgot Password</h3>
            <h4 class="font18 white font-thin">You can recover password from here...</h4>
        </div>
        <div class="col-md-6">
            <div class="pagenation"><a href="/">Home</a> <i>/</i> Forgot Password</div>
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
                <header class="font-slim">Forgot Password</header>
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
                </fieldset>
                <footer>
                    <div class="fright">
                        <?php echo CHtml::submitButton('Submit', array('class' => 'button')); ?>
                    </div>
                </footer>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>
<!-- end features section 1 -->