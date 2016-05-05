<?php $this->pageTitle = Yii::app()->name . ' - Membership'; 
echo Yii::app()->user->id;
$customer_id = Yii::app()->user->id;
        $customer = Customer::model()->findByPk($customer_id);
print_r($customer);
die;
?>

<div class="page-header one">
    <div class="container">
        <div class="col-md-6 left-padd0">
            <h3 class="font30 nomargin white uppercase">Freelancer Memberships</h3>
            <h4 class="font18 white font-thin">No obligations. Change plans anytime. Maximise your Earnings! </h4>
        </div>
        <div class="col-md-6">
            <div class="pagenation"><a href="/">My Account</a> <i>/</i> Membership</div>
        </div>
    </div>
</div>
<!-- end page header -->

<div class="section-lg">
    <div class="container">
        <div class="row">
            <div class="title1 text-center">
                <h2 class="uppercase font-thin font45">Freelancer <span class="blue font-bold">Memberships</span></h2>
                <p>No obligations. Change plans anytime. Maximise your Earnings!</p><br>
                <br>
            </div>
            <?php $customer = Customer::model()->getCustomerProfile();?>
            <?php $packages = Package::model()->findAllByAttributes(array(), array('order' => 'package_price')); ?>
            <?php if (!empty($packages)) { ?>
                <?php foreach ($packages as $package) { ?>
                    <div class="col-md-3 col-sm-3 text-center m-bottom4">
                        <div class="pricing-box one">
                            <div class="price">
                                <div class="pack-title uppercase font20"><?php echo $package->package_name; ?></div>
                                <h4 class="font70 m-top5"><span class="font-bold font30 align-top">$</span><?php echo $package->package_price; ?><sup>.00</sup></h4>
                                <div>per month</div>
                            </div>

                            <?php if ($customer->customer_membershipID == $package->package_id) { ?>
                                <div class="button m-top4"><a class="btn grey-border-large uppercase" href="#">Current Plan</a></div>
                            <?php } else { ?>
                                <div class="button m-top4"><a class="btn grey-border-large uppercase" href="#">Downgrade</a></div>    
                            <?php } ?>

                            <ul class="plan-list">
                                <li><?php echo $package->package_bids_per_month; ?> Bids per Month</li>
                                <li><?php echo $package->package_skills; ?> Skills</li>
                                <?php if (!empty($package->package_features)) { ?>
                                    <?php $features = json_decode($package->package_features); ?>
                                    <?php foreach ($features as $feature) { ?>
                                        <li><?php echo $feature; ?></li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>                    
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>

            <div class="col-md-3 col-sm-3 text-center m-bottom4">
                <div class="pricing-box one">
                    <div class="price">
                        <div class="pack-title uppercase font20">Free</div>
                        <h4 class="font70 m-top5"><span class="font-bold font30 align-top">$</span>0<sup>.00</sup></h4>
                        <div>per month</div>
                    </div>
                    <div class="button m-top4"><br/><br/></div>
                    <ul class="plan-list">
                        <li>10 GB Free Disk Space</li>
                        <li>Free Domain Registration</li>
                        <li>5 Free Email Accounts</li>
                        <li>24/7 Full Support</li>
                    </ul>                    
                </div>
            </div>
            <div class="col-md-3 col-sm-3 text-center m-bottom4">
                <div class="pricing-box one">
                    <div class="price">
                        <div class="pack-title uppercase font20">Intro</div>
                        <h4 class="font70 m-top5"><span class="font-bold font30 align-top">$</span>0<sup>.99</sup></h4>
                        <div>per month</div>
                    </div>
                    <div class="button m-top4"><a class="btn grey-border-large uppercase" href="#">Downgrade</a></div>
                    <ul class="plan-list">
                        <li>10 GB Free Disk Space</li>
                        <li>Free Domain Registration</li>
                        <li>5 Free Email Accounts</li>
                        <li>24/7 Full Support</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 text-center m-bottom4">
                <div class="pricing-box one active">
                    <div class="price">
                        <div class="pack-title uppercase font20">Basic</div>
                        <h4 class="font70 m-top5"><span class="font-bold font30 align-top">$</span>4<sup>.95</sup></h4>
                        <div>per month</div>
                    </div>
                    <div class="button m-top4"><a class="btn grey-border-large uppercase" href="#">Downgrade</a></div>
                    <ul class="plan-list">
                        <li>100 GB Free Disk Space</li>
                        <li>UNLIMITED Registration</li>
                        <li>5 Free Email Accounts</li>
                        <li>24/7 Full Support</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 text-center m-bottom4">
                <div class="pricing-box one">
                    <div class="price">
                        <div class="pack-title uppercase font20">Plus</div>
                        <h4 class="font70 m-top5"><span class="font-bold font30 align-top">$</span>9<sup>.95</sup></h4>
                        <div>per month</div>
                    </div>

                    <ul class="plan-list">
                        <li>UNLIMITED Free Disk Space</li>
                        <li>UNLIMITED Registration</li>
                        <li>100 Free Email Accounts</li>
                        <li>24/7 Full Support</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 text-center m-bottom4">
                <div class="pricing-box one">
                    <div class="price">
                        <div class="pack-title uppercase font20">Standard</div>
                        <h4 class="font70 m-top5"><span class="font-bold font30 align-top">$</span>49<sup>.95</sup></h4>
                        <div>per month</div>
                    </div>
                    <div class="button m-top4"><a class="btn grey-border-large uppercase my-upgrade-button" href="#">Upgrade</a></div>
                    <ul class="plan-list">
                        <li>UNLIMITED Free Disk Space</li>
                        <li>UNLIMITED Registration</li>
                        <li>100 Free Email Accounts</li>
                        <li>24/7 Full Support</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end features section 2 -->