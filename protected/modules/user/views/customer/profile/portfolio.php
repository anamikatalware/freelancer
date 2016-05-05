<div class="section-lg m-top5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="font-thin font30 m-bottom3">
                    Portfolio
                    <div class="pull-right button">
                        <a class="btn boxed-color-xs uppercase btn-block" title="Edit Portfolio" id="btnEditPortfolio" href="/portfolio" style="margin: 0px;"><i class="fa fa-edit"></i> Edit Portfolio</a>
                    </div>
                </h2>

                <div class="row">
                    <?php
                    $portfolio_customerID = Yii::app()->user->id;
                    $portfolios = Portfolio::model()->findAllByAttributes(array('portfolio_customerID' => $portfolio_customerID));
                    ?>
                    <?php if (!empty($portfolios)) { ?>
                        <?php foreach ($portfolios as $portfolio) { ?>
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
    </div>
</div>
<!-- end features section 1 -->
<style>
    .imgbox img {height: 100%;width: 100%;}
</style>