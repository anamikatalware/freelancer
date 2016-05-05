<?php $this->pageTitle = 'Tours - ' . $model->tour_name; ?>

<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <div class="col-md-12">
        <!-- TABLE: LATEST ORDERS -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <?php echo $model->tour_name; ?>
                </h3>
                <div class="box-tools pull-right">
                    <a class="text-blue" href="<?php echo Yii::app()->createAbsoluteUrl('admin/tour/index'); ?>">Back to Tours</a>
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-8">
                        <table class="table table-bordered table-responsive table-hover">
                            <tr>
                                <th><?php echo $model->getAttributeLabel('tour_name'); ?></th>
                                <td><?php echo $model->tour_name; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $model->getAttributeLabel('tour_categoryID'); ?></th>
                                <td><?php echo Category::model()->getCategoryName($model->tour_categoryID); ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $model->getAttributeLabel('tour_duration'); ?></th>
                                <td><?php echo $model->tour_duration; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $model->getAttributeLabel('tour_amount'); ?></th>
                                <td>AED <?php echo $model->tour_amount; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $model->getAttributeLabel('tour_overview'); ?></th>
                                <td><?php echo $model->tour_overview; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $model->getAttributeLabel('tour_is_private'); ?></th>
                                <td>
                                    <?php
                                    if ($model->tour_is_private == 0) {
                                        echo Utils::getLabels(3);
                                    } else {
                                        echo Utils::getLabels(4);
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th><?php echo $model->getAttributeLabel('tour_is_bestSeller'); ?></th>
                                <td>
                                    <?php
                                    if ($model->tour_is_bestSeller == 0) {
                                        echo Utils::getLabels(3);
                                    } else {
                                        echo Utils::getLabels(4);
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th><?php echo $model->getAttributeLabel('tour_status'); ?></th>
                                <td>
                                    <?php
                                    if ($model->tour_status == 0) {
                                        echo Utils::getLabels(2);
                                    } else {
                                        echo Utils::getLabels(1);
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-4">
                        <?php echo Utils::getPathFeaturedImage($model->tour_image, 'medium') ?>
                    </div>
                    <div class="col-sm-12">
                        <?php
                        if (!empty($model->tour_gallery)) {
                            $gallery = explode(',', $model->tour_gallery);
                            $baseUrl = Yii::app()->baseUrl . '/bootstrap/upload/tours/medium/';
                            ?>
                        <h4>Gallery Images</h4>
                            <ul class="gallery_images">
                                <?php foreach ($gallery as $img) { ?>
                                    <li>
                                        <img src="<?php echo $baseUrl . $img ?>" />
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->

<style type="text/css">
    .gallery_images {
        list-style: none;
        padding: 0;
    }
    .gallery_images li {
        display: inline-block;
        margin-bottom: 3px;
        padding: 4px;
        border: 1px solid #eee;
    }
</style>