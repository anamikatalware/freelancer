<?php $this->pageTitle = Yii::app()->name . ' - ' . $page->page_name; ?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-body">
                <h2 class="block-header"><?php echo $page->page_name; ?></h2>
                <?php echo $page->page_description; ?>
            </div>
        </div>
    </div>
</div>