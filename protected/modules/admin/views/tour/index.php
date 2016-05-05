<?php
$this->pageTitle = 'Tours';

Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
	$('#category-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <div class="col-md-12">
        <!-- TABLE: LATEST ORDERS -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Manage Tours | <a class="text-blue" href="<?php echo Yii::app()->createAbsoluteUrl('admin/tour/create'); ?>">Add Tour</a>
                </h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">

                <div id="statusMsg"></div>
                <?php if (Yii::app()->user->hasFlash('message')): ?>
                    <div class="alert alert-<?php echo Yii::app()->user->getFlash('type'); ?> alert-dismissable" id="successmsg">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo Yii::app()->user->getFlash('message'); ?>
                    </div>
                <?php endif; ?>

                <?php
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'category-grid',
                    'htmlOptions' => array('class' => 'dataTables_wrapper', 'role' => 'grid'),
                    'dataProvider' => $model->search(),
                    'filter' => $model,
                    'columns' => array(
                        array(
                            'header' => 'S. No.',
                            'name' => 'S. No.',
                            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                            'htmlOptions' => array('style' => 'text-align:center'),
                            'headerHtmlOptions' => array('style' => 'text-align: center;width:60px'),
                        ),
                        array(
                            'header' => 'Image',
                            'type' => 'raw',
                            'value' => 'Utils::getPathFeaturedImage($data->tour_image,"extra_small")',
                            'htmlOptions' => array('style' => 'text-align:justify;vertical-align: middle;-ms-word-break: break-all;word-break: break-all;'),
                            'filter' => ''
                        ),
                        array(
                            'name' => 'tour_name',
                            'value' => '$data->tour_name',
                            'htmlOptions' => array('style' => 'text-align:justify;vertical-align: middle;-ms-word-break: break-all;word-break: break-all;'),
                            'filter' => CHtml::activeTextField($model, 'tour_name', array('placeholder' => $model->getAttributeLabel('tour_name'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
                        ),
                        array(
                            'name' => 'tour_categoryID',
                            'value' => 'Category::model()->getCategoryName($data->tour_categoryID)',
                            'htmlOptions' => array('style' => 'text-align:justify;vertical-align: middle;-ms-word-break: break-all;word-break: break-all;'),
                            'filter' => CHtml::activeTextField($model, 'tour_categoryID', array('placeholder' => $model->getAttributeLabel('tour_categoryID'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
                        ),
                        array(
                            'name' => 'tour_duration',
                            'value' => '$data->tour_duration',
                            'htmlOptions' => array('style' => 'text-align:justify;vertical-align: middle;-ms-word-break: break-all;word-break: break-all;'),
                            'filter' => CHtml::activeTextField($model, 'tour_duration', array('placeholder' => $model->getAttributeLabel('tour_duration'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
                        ),
                        array(
                            'name' => 'tour_amount',
                            'value' => '"AED " . $data->tour_amount',
                            'htmlOptions' => array('style' => 'text-align:justify;vertical-align: middle;-ms-word-break: break-all;word-break: break-all;'),
                            'filter' => CHtml::activeTextField($model, 'tour_amount', array('placeholder' => $model->getAttributeLabel('tour_amount'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
                        ),
                        array(
                            'name' => 'tour_is_private',
                            'type' => 'raw',
                            'value' => '($data->tour_is_private == 0) ? Utils::getLabels(3) : Utils::getLabels(4)',
                            'htmlOptions' => array('style' => 'text-align:center;vertical-align: middle;'),
                            'headerHtmlOptions' => array('style' => 'text-align: center;width:120px'),
                            'filter' => CHtml::activeDropDownList($model, 'tour_is_private', array(0 => 'Inactive', 1 => 'Active'), array('style' => 'font-style:italic', 'class' => 'form-control', 'empty' => 'Status'))
                        ),
                        array(
                            'name' => 'tour_is_bestSeller',
                            'type' => 'raw',
                            'value' => '($data->tour_is_bestSeller == 0) ? Utils::getLabels(3) : Utils::getLabels(4)',
                            'htmlOptions' => array('style' => 'text-align:center;vertical-align: middle;'),
                            'headerHtmlOptions' => array('style' => 'text-align: center;width:120px'),
                            'filter' => CHtml::activeDropDownList($model, 'tour_is_bestSeller', array(0 => 'Inactive', 1 => 'Active'), array('style' => 'font-style:italic', 'class' => 'form-control', 'empty' => 'Status'))
                        ),
                        array(
                            'name' => 'tour_status',
                            'type' => 'raw',
                            'value' => '($data->tour_status == 0) ? Utils::getLabels(2) : Utils::getLabels(1)',
                            'htmlOptions' => array('style' => 'text-align:center;vertical-align: middle;'),
                            'headerHtmlOptions' => array('style' => 'text-align: center;width:120px'),
                            'filter' => CHtml::activeDropDownList($model, 'tour_status', array(0 => 'Inactive', 1 => 'Active'), array('style' => 'font-style:italic', 'class' => 'form-control', 'empty' => 'Status'))
                        ),
                        array(
                            'header' => 'View',
                            'class' => 'CButtonColumn',
                            'headerHtmlOptions' => array('style' => 'text-align: center;width:50px'),
                            'htmlOptions' => array('style' => 'text-align:center;vertical-align: middle;'),
                            'template' => '{view}',
                            'buttons' => array
                                (
                                'view' => array
                                    (
                                    'label' => '<i class="fa fa-eye fa-2x text-primary"></i>',
                                    'options' => array('title' => 'View'),
                                    'imageUrl' => FALSE
                                )
                            ),
                        ),
                        array(
                            'header' => 'Edit',
                            'class' => 'CButtonColumn',
                            'headerHtmlOptions' => array('style' => 'text-align: center;width:50px'),
                            'htmlOptions' => array('style' => 'text-align:center;vertical-align: middle;'),
                            'template' => '{update}',
                            'buttons' => array
                                (
                                'update' => array
                                    (
                                    'label' => '<i class="fa fa-edit fa-2x text-green"></i>',
                                    'options' => array('title' => 'Edit'),
                                    'imageUrl' => FALSE
                                )
                            ),
                        ),
                        array(
                            'header' => 'Delete',
                            'class' => 'CButtonColumn',
                            'deleteConfirmation' => 'Do you really want to delete this Tour?',
                            'afterDelete' => 'function(link,success,data){ if(success) { $("#statusMsg").css("display", "block"); $("#statusMsg").html(data); $("#statusMsg").animate({opacity: 1.0}, 3000).fadeOut("fast");}}',
                            'headerHtmlOptions' => array('style' => 'text-align: center;width:50px'),
                            'htmlOptions' => array('style' => 'text-align:center;vertical-align: middle;'),
                            'template' => '{delete}',
                            'buttons' => array
                                (
                                'delete' => array
                                    (
                                    'label' => '<i class="fa fa-trash fa-2x text-red"></i>',
                                    'options' => array('title' => 'Delete', 'class' => 'remove'),
                                    'imageUrl' => FALSE
                                ),
                            ),
                        ),
                    ),
                    'itemsCssClass' => 'table table-striped table-bordered table-hover table-green dataTable',
                    'pagerCssClass' => 'dataTables_paginate paging_bootstrap',
                    'summaryCssClass' => 'dataTables_info',
                    'template' => '{items}<div class = "row"><div class = "col-xs-6">{summary}</div><div class = "col-xs-6">{pager}</div></div>',
                    'pager' => array(
                        'htmlOptions' => array('class' => 'pagination', 'id' => ''),
                        'header' => '',
                        'cssFile' => false,
                        'selectedPageCssClass' => 'active',
                        'previousPageCssClass' => 'prev',
                        'nextPageCssClass' => 'next',
                        'hiddenPageCssClass' => 'disabled',
                        'maxButtonCount' => 5,
                    ),
                    'emptyText' => '<span class="text-danger text-center">No Record Found!</span>',
                ));
                ?>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->