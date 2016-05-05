<?php
$this->pageTitle = 'Manage Sub Categories';

Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
	$('#sub-category-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

$categories = CHtml::listData(Category::model()->findAll(), 'category_id', 'category_name')
?>

<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <div class="col-md-12">
        <!-- TABLE: LATEST ORDERS -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Manage Sub Categories | <a class="text-blue" href="<?php echo Yii::app()->createAbsoluteUrl('admin/subCategory/create'); ?>">Add Sub Category</a>
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
                    'id' => 'sub-category-grid',
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
                            'name' => 'subcategory_categoryID',
                            'value' => 'Category::model()->getCategoryName($data->subcategory_categoryID)',
                            'htmlOptions' => array('style' => 'text-align:justify;vertical-align: middle;-ms-word-break: break-all;word-break: break-all;'),
                            'filter' => CHtml::activeDropDownList($model, 'subcategory_categoryID', $categories, array('empty' => $model->getAttributeLabel('subcategory_categoryID'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
                        ),
                        array(
                            'name' => 'subcategory_name',
                            'value' => '$data->subcategory_name',
                            'htmlOptions' => array('style' => 'text-align:justify;vertical-align: middle;-ms-word-break: break-all;word-break: break-all;'),
                            'filter' => CHtml::activeTextField($model, 'subcategory_name', array('placeholder' => $model->getAttributeLabel('subcategory_name'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
                        ),
                        array(
                            'name' => 'subcategory_status',
                            'type' => 'raw',
                            'value' => '($data->subcategory_status == 0) ? Utils::getLabels(2) : Utils::getLabels(1)',
                            'htmlOptions' => array('style' => 'text-align:center;vertical-align: middle;'),
                            'headerHtmlOptions' => array('style' => 'text-align: center;width:120px'),
                            'filter' => CHtml::activeDropDownList($model, 'subcategory_status', array(0 => 'Inactive', 1 => 'Active'), array('style' => 'font-style:italic', 'class' => 'form-control', 'empty' => 'Status'))
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
                                    'label' => '<i class="fa fa-edit text-green"></i>',
                                    'options' => array('title' => 'Edit'),
                                    'imageUrl' => FALSE
                                )
                            ),
                        ),
                        array(
                            'header' => 'Delete',
                            'class' => 'CButtonColumn',
                            'deleteConfirmation' => 'Do you really want to delete this Sub Category?',
                            'afterDelete' => 'function(link,success,data){ if(success) { $("#statusMsg").css("display", "block"); $("#statusMsg").html(data); $("#statusMsg").animate({opacity: 1.0}, 3000).fadeOut("fast");}}',
                            'headerHtmlOptions' => array('style' => 'text-align: center;width:50px'),
                            'htmlOptions' => array('style' => 'text-align:center;vertical-align: middle;'),
                            'template' => '{delete}',
                            'buttons' => array
                                (
                                'delete' => array
                                    (
                                    'label' => '<i class="fa fa-trash text-red"></i>',
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