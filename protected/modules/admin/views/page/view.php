<?php $this->pageTitle = 'Manage Pages - ' . $model->page_name; ?>

<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <div class="col-md-12">
        <!-- TABLE: LATEST ORDERS -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <?php echo $model->page_name; ?>
                </h3>
                <div class="box-tools pull-right">
                    <a class="text-blue" href="<?php echo Yii::app()->createAbsoluteUrl('admin/page/index'); ?>">Back to Pages</a>
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-responsive table-hover">
                            <tr>
                                <th><?php echo $model->getAttributeLabel('page_name'); ?></th>
                                <td><?php echo $model->page_name; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $model->getAttributeLabel('page_slug'); ?></th>
                                <td><?php echo $model->page_slug; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $model->getAttributeLabel('page_description'); ?></th>
                                <td><?php echo $model->page_description; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $model->getAttributeLabel('page_status'); ?></th>
                                <td>
                                    <?php
                                    if ($model->page_status == 0) {
                                        echo Utils::getLabels(2);
                                    } else {
                                        echo Utils::getLabels(1);
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->