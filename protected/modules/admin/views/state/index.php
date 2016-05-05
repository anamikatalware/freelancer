<?php
$this->pageTitle = 'Manage States';

Yii::app()->clientScript->registerScript('search', "
    $('.search-form form').submit(function(){
	$('#state-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
    });
");
?>

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Manage States | <a class="text-blue" href="<?php echo Yii::app()->createAbsoluteUrl('admin/state/create'); ?>">Add State</a></h3>
        <div class="box-tools pull-right">
            <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">

        <div id="statusMsg"></div>

        <?php if (Yii::app()->user->hasFlash('message')): ?>
            <div class="alert alert-<?php echo Yii::app()->user->getFlash('type'); ?> alert-dismissable" id="successmsg">
                <?php echo Yii::app()->user->getFlash('message'); ?>
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            </div>
        <?php endif; ?>


        <?php
        $countries = CHtml::listData(Country::model()->order_by()->findAll(), 'country_id', 'country_name');

        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'state-grid',
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
                    'name' => 'state_countryID',
                    'type' => 'raw',
                    'value' => 'Country::model()->getCountryNameByID($data->state_countryID)',
                    'htmlOptions' => array('style' => 'text-align:justify;-ms-word-break: break-all;word-break: break-all;'),
                    'filter' => CHtml::activeDropDownList($model, 'state_countryID', $countries, array('empty' => $model->getAttributeLabel('state_countryID'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
                ),
                array(
                    'name' => 'state_name',
                    'value' => '$data->state_name',
                    'htmlOptions' => array('style' => 'text-align:justify;-ms-word-break: break-all;word-break: break-all;'),
                    'filter' => CHtml::activeTextField($model, 'state_name', array('placeholder' => $model->getAttributeLabel('state_name'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
                ),
                array(
                    'name' => 'state_status',
                    'type' => 'raw',
                    'value' => '($data->state_status == 0) ? Utils::getLabels(2) : Utils::getLabels(1)',
                    'htmlOptions' => array('style' => 'text-align:center;'),
                    'headerHtmlOptions' => array('style' => 'text-align: center;width:120px'),
                    'filter' => CHtml::activeDropDownList($model, 'state_status', array(0 => 'Inactive', 1 => 'Active'), array('style' => 'font-style:italic', 'class' => 'form-control', 'empty' => 'Status'))
                ),
                array(
                    'header' => 'Edit',
                    'class' => 'CButtonColumn',
                    'headerHtmlOptions' => array('style' => 'text-align: center;width:50px'),
                    'htmlOptions' => array('style' => 'text-align:center;'),
                    'template' => '{update}',
                    'buttons' => array
                        (
                        'update' => array
                            (
                            'label' => '<i class="fa fa-edit"></i>',
                            'options' => array('title' => 'Edit'),
                            'imageUrl' => FALSE
                        ),
                    ),
                ),
                array(
                    'header' => 'Delete',
                    'class' => 'CButtonColumn',
                    'deleteConfirmation' => 'Are you sure you want to delete this State?',
                    'afterDelete' => 'function(link,success,data){ if(success) { $("#statusMsg").css("display", "block"); $("#statusMsg").html(data); $("#statusMsg").animate({opacity: 1.0}, 3000).fadeOut("fast");}}',
                    'headerHtmlOptions' => array('style' => 'text-align: center;width:50px'),
                    'htmlOptions' => array('style' => 'text-align:center;'),
                    'template' => '{delete}',
                    'buttons' => array
                        (
                        'delete' => array
                            (
                            'label' => '<i class="fa fa-trash-o"></i>',
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
                'firstPageLabel' => '<<',
                'prevPageLabel' => '<',
                'nextPageLabel' => '>',
                'lastPageLabel' => '>>',
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
</div>           

<style type="text/css">
    .designation_list {
        margin: 0;
        padding-left: 20px;
    }
</style>