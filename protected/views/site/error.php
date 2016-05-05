<?php $this->pageTitle = Yii::app()->name . ' - Page Not Found'; ?>
<?php
//echo $code;
//echo CHtml::encode($message);            
?>

<div class="page-header one">
    <div class="container">
        <div class="col-md-6 left-padd0">
            <h3 class="font30 nomargin white uppercase"><?php echo $code; ?> Error</h3>
            <h4 class="font18 white font-thin">Oops! Page not Found</h4>
        </div>
        <div class="col-md-6">
            <div class="pagenation"><a href="/">Home</a> <i>/</i> <?php echo $code; ?> Error</div>
        </div>
    </div>
</div>
<!-- end page header -->

<div class="section-lg one">
    <div class="container">
        <div class="row">
            <div class="error404">
                <h1 class="uppercase font80 blue"><?php echo $code; ?></h1>
                <h2 class="font-thin font35">Oops... Page Not Found!</h2>
                <p class="m-bottom4 m-top2">Sorry the Page Could not be Found here.</p>
            </div>
        </div>
    </div>
</div>
<!-- end features section 1 -->