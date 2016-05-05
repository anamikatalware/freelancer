<?php $this->pageTitle = 'Change Password'; ?>

<div class="row">
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img alt="User profile picture" src="../../dist/img/user4-128x128.jpg" class="profile-user-img img-responsive img-circle">
                <h3 class="profile-username text-center">Nina Mcintire</h3>
                <p class="text-muted text-center">Software Engineer</p>

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
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#activity" aria-expanded="true">Activity</a></li>
                <li class=""><a data-toggle="tab" href="#timeline" aria-expanded="false">Timeline</a></li>
                <li class=""><a data-toggle="tab" href="#settings" aria-expanded="false">Settings</a></li>
                <li class=""><a data-toggle="tab" href="#changepassword" aria-expanded="false">Change Password</a></li>
            </ul>
            <div class="tab-content">
                <div id="activity" class="tab-pane active"></div><!-- /.tab-pane -->
                <div id="timeline" class="tab-pane"></div><!-- /.tab-pane -->

                <div id="settings" class="tab-pane">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="inputName">Name</label>
                            <div class="col-sm-9">
                                <input type="email" placeholder="Name" id="inputName" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="inputEmail">Email</label>
                            <div class="col-sm-9">
                                <input type="email" placeholder="Email" id="inputEmail" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="inputName">Name</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Name" id="inputName" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="inputExperience">Experience</label>
                            <div class="col-sm-9">
                                <textarea placeholder="Experience" id="inputExperience" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="inputSkills">Skills</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Skills" id="inputSkills" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-9">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-9">
                                <button class="btn btn-danger" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.tab-pane -->

                <div id="changepassword" class="tab-pane">
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'change-password-form',
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
                            <?php echo $form->passwordField($model, 'password_old', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('password_old'))); ?>
                            <?php echo $form->error($model, 'password_old'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="password_new">New Password</label>
                        <div class="col-sm-9">
                            <?php echo $form->passwordField($model, 'password_new', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('password_new'))); ?>
                            <?php echo $form->error($model, 'password_new'); ?>    
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputName">Confirmation Password</label>
                        <div class="col-sm-9">
                            <?php echo $form->passwordField($model, 'password_confirmation', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('password_confirmation'))); ?>
                            <?php echo $form->error($model, 'password_confirmation'); ?>    
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <?php echo CHtml::submitButton('Change Password', array('class' => 'btn btn-primary')); ?>
                        </div>
                    </div>
                    <?php $this->endWidget(); ?>
                </div><!-- /.tab-pane -->
            </div><!-- /.tab-content -->
        </div><!-- /.nav-tabs-custom -->
    </div><!-- /.col -->
</div><!-- /.row -->

