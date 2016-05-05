<?php $this->pageTitle = 'Manage FAQs '; ?>

<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <div class="col-md-12">
        <!-- TABLE: LATEST ORDERS -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <?php echo FaqCategory::model()->getFaqCategoryName($model->faq_faqcategoryID); ?>
                </h3>
                <div class="box-tools pull-right">
                    <a class="text-blue" href="<?php echo Yii::app()->createAbsoluteUrl('admin/faq/index'); ?>">Back to FAQs</a>
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-responsive table-hover">
                            <tr>
                                <th><?php echo $model->getAttributeLabel('faq_question'); ?></th>
                                <th><?php echo $model->faq_question; ?></th>
                            </tr>
                            <tr>
                                <th><?php echo $model->getAttributeLabel('faq_answer'); ?></th>
                                <td><?php echo $model->faq_answer; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $model->getAttributeLabel('faq_status'); ?></th>
                                <td>
                                    <?php
                                    if ($model->faq_status == 0) {
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