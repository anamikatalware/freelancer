<?php $model = Customer::model()->getCustomerProfile(); ?>
<div class="cat-title white font-bold uppercase">
    Profile Details
</div>
<div class="c-post one">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'sky-profile',
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
                <div class="col col-6">
                    <label class="label">First Name</label>
                    <div class="col-12">
                        <label class="input"> 
                            <i class="icon-append fa fa-lock"></i>
                            <?php echo $form->textField($model, 'customer_firstname', array('placeholder' => $model->getAttributeLabel('customer_firstname'))); ?>
                        </label>
                    </div>
                </div>
                <div class="col col-6">
                    <label class="label">Last Name</label>
                    <div class="col-12">
                        <label class="input"> 
                            <i class="icon-append fa fa-lock"></i>
                            <?php echo $form->textField($model, 'customer_lastname', array('placeholder' => $model->getAttributeLabel('customer_lastname'))); ?>
                        </label>
                    </div>
                </div>                        
            </div>
        </section>
        <section>
            <div class="row">
                <div class="col col-sm-12">
                    <label class="label">Address</label>
                    <div class="col-12" style="margin-bottom: 10px;">
                        <label class="input"> 
                            <i class="icon-append fa fa-location-arrow"></i>
                            <?php echo $form->textField($model, 'customer_address1', array('placeholder' => $model->getAttributeLabel('customer_address1'))); ?>
                        </label>
                    </div>
                    <div class="col-12">
                        <label class="input"> 
                            <i class="icon-append fa fa-location-arrow"></i>
                            <?php echo $form->textField($model, 'customer_address2', array('placeholder' => $model->getAttributeLabel('customer_address2'))); ?>
                        </label>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="row">
                <div class="col col-sm-12">
                    <label class="label">City</label>
                    <div class="col-12">
                        <label class="input"> 
                            <i class="icon-append fa fa-lock"></i>
                            <?php echo $form->textField($model, 'customer_city', array('placeholder' => $model->getAttributeLabel('customer_city'))); ?>
                        </label>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="row">
                <div class="col col-6">
                    <label class="label">Pin Code</label>
                    <div class="col-12">
                        <label class="input"> 
                            <i class="icon-append fa fa-lock"></i>
                            <?php echo $form->textField($model, 'customer_pincode', array('placeholder' => $model->getAttributeLabel('customer_pincode'))); ?>
                        </label>
                    </div>
                </div>
                <div class="col col-6">
                    <label class="label">State</label>
                    <div class="col-12">
                        <label class="input"> 
                            <i class="icon-append fa fa-lock"></i>
                            <?php echo $form->textField($model, 'customer_state', array('placeholder' => $model->getAttributeLabel('customer_state'))); ?>
                        </label>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="row">
                <div class="col col-sm-12">
                    <label class="label">Company</label>
                    <div class="col-12">
                        <label class="input"> 
                            <i class="icon-append fa fa-lock"></i>
                            <?php echo $form->textField($model, 'customer_company', array('placeholder' => $model->getAttributeLabel('customer_company'))); ?>
                        </label>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="row">
                <div class="col col-sm-12">
                    <label class="label">Location</label>
                    <div class="col-12">
                        <label class="input"> 
                            <i class="icon-append fa fa-location-arrow"></i>
                            <?php echo $form->textField($model, 'customer_location', array('placeholder' => $model->getAttributeLabel('customer_location'))); ?>
                        </label>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="row">
                <div class="col col-12">
                    <button class="button" type="submit">Update</button>
                    <!-- <button class="button button-secondary" type="reset">Cancel</button> -->
                </div>
            </div>
        </section>
    </fieldset>
    <?php $this->endWidget(); ?>       
</div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<script type="text/javascript">
    function initialize() {
        var input = document.getElementById('Customer_customer_location');
        var autocomplete = new google.maps.places.Autocomplete(input);
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>