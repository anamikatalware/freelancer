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
        <div class="row sky-form">
            <div class="col-sm-6">
                <a class="button" href="/portfolio/add"><i class="fa fa-plus"></i> Add Item</a>
            </div>
            <div class="col-sm-6">
                <a class="button pull-right" href="/profile"><i class="fa fa-backward"></i> Go back to Profile Page</a>
            </div>
        </div>

        <div id="statusMsg"></div>
        <?php if (Yii::app()->user->hasFlash('message')): ?>
            <div class="alert alert-<?php echo Yii::app()->user->getFlash('type'); ?> alert-dismissable" id="successmsg">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo Yii::app()->user->getFlash('message'); ?>
            </div>
        <?php endif; ?>

        <div class="divider-s-line"></div>

        <div class="row">
            <?php if (!empty($model)) { ?>
                <?php foreach ($model as $portfolio) { ?>
                    <?php
                    $path = Yii::app()->baseUrl . '/bootstrap/frontend/images/portfolio-img.png';
                    if (!empty($portfolio->portfolio_files)) {
                        $files = explode(',', $portfolio->portfolio_files);
                        $path = Yii::app()->baseUrl . '/bootstrap/upload/portfolio/' . $files[0];
                    }
                    ?>
                    <div class="col-md-3 col-sm-3 m-bottom3">
                        <div class="col-img-hover">
                            <div class="img-hover-st-1">
                                <div class="text">
                                    <div class="imgbox"> <img src="<?php echo $path ?>" alt="<?php echo $portfolio->portfolio_title ?>"> </div>
                                    <h5 class="title font20"><?php echo $portfolio->portfolio_title ?></h5>
                                    <p><?php echo $portfolio->portfolio_description; ?></p>
                                    <br>
                                    <p class="options">
                                        <a href="/portfolio/edit/<?php echo $portfolio->portfolio_id; ?>"><i class="fa fa-edit"></i> Edit</a> |
                                        <a href="/portfolio/delete/<?php echo $portfolio->portfolio_id; ?>"><i class="fa fa-times"></i> Delete</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
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

    #successmsg {margin-top: 10px;}
    
    .imgbox img {height: 100%;width: 100%;}
</style>