<?php $this->pageTitle = 'Manage Budget Type'; ?>

<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <div class="col-md-12">
        <!-- TABLE: LATEST ORDERS -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Update Budget Type | <a class="text-blue" href="<?php echo Yii::app()->createAbsoluteUrl('admin/budgetType/index'); ?>">Back to Budget Type</a>
                </h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <?php $this->renderPartial('_form', array('model' => $model)); ?>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->