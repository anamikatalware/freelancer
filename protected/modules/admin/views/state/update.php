<?php $this->pageTitle = 'Manage States'; ?>

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Update State | <a class="text-blue" href="<?php echo Yii::app()->createAbsoluteUrl('admin/state/index'); ?>">Back to States</a></h3>
        <div class="box-tools pull-right">
            <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <?php $this->renderPartial('_form', array('model' => $model)); ?>        
    </div><!-- /.box-body -->
</div>