<?php $this->pageTitle = Yii::app()->name . ' - Portfolio'; ?>

<div class="page-header one">
    <div class="container">
        <div class="col-md-6 left-padd0">
            <h3 class="font30 nomargin white uppercase">Portfolio</h3>
            <h4 class="font18 white font-thin">You can change your portfolio here...!</h4>
        </div>
        <div class="col-md-6">
            <div class="pagenation"><a href="/dashboard">My Account</a> <i>/</i> Portfolio</div>
        </div>
    </div>
</div>
<!-- end page header -->

<div class="section-lg one">
    <div class="container">
        <div class="row">            
            <div class="reg_form">
                <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
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

    .divider-s-line {margin-bottom: 15px;margin-top: 15px;}
    .options {position: absolute; bottom: 20px; width: 100%; margin: 0px auto !important; text-align: center;}
    .options a {margin: 0 !important;}
</style>