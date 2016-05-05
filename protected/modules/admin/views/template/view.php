<?php $this->pageTitle = 'Manage Email Templates - ' . $model->template_title; ?>

<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <div class="col-md-12">
        <!-- TABLE: LATEST ORDERS -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <?php echo $model->template_title; ?>
                </h3>
                <div class="box-tools pull-right">
                    <a class="text-blue" href="<?php echo Yii::app()->createAbsoluteUrl('admin/template/index'); ?>">Back to Email Templates</a>
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-responsive table-hover">
                            <tr>
                                <th><?php echo $model->getAttributeLabel('template_title'); ?></th>
                                <td><?php echo $model->template_title; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $model->getAttributeLabel('template_alias'); ?></th>
                                <td><?php echo $model->template_alias; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $model->getAttributeLabel('template_subject'); ?></th>
                                <td><?php echo $model->template_subject; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $model->getAttributeLabel('template_parameters'); ?></th>
                                <td><?php echo $model->template_parameters; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $model->getAttributeLabel('template_status'); ?></th>
                                <td>
                                    <?php
                                    if ($model->template_status == 0) {
                                        echo Utils::getLabels(2);
                                    } else {
                                        echo Utils::getLabels(1);
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="mail-content">
                                        <?php echo $model->template_content; ?>
                                    </div>
                                </td>                                
                            </tr>
                        </table>
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->

<style type="text/css">
    .mail-content {
        border: 1px solid #000;
        padding: 10px;
    }
</style>