<?php
$customer = Customer::model()->getCustomerProfile();
$roleID = $customer->customer_roleID;
?>
<div class="widget m-bottom4">
    <div class="cat-title white font-bold uppercase">
        Account
    </div>
    <div class="c-post one">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'sky-profile-account',
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
                <h3>Account Type</h3>
                <div class="row">
                    <div class="col col-6">
                        <label class="label">I'm looking to:</label>
                        <div class="col-12">
                            <label class="radio">
                                <input type="radio" name="account_type" value="1" id="account_type_1" <?php echo $roleID == 1 ? 'checked' : '' ?>>
                                <i></i> Work
                            </label>
                            <label class="radio">
                                <input type="radio" name="account_type" value="2" id="account_type_2" <?php echo $roleID == 2 ? 'checked' : '' ?>>
                                <i></i> Hire
                            </label>
                        </div>
                    </div>
                    <div class="col col-6">
                        <button class="button pull-right" type="submit">Close My Account</button>
                    </div>
                </div>
            </section>
            <section>
                <div class="row">
                    <div class="col col-12">
                        <button class="button" type="submit">Save</button>
                        <button class="button button-secondary" type="reset">Cancel</button>
                    </div>
                </div>
            </section>
        </fieldset>
        <?php $this->endWidget(); ?>
    </div>
</div>