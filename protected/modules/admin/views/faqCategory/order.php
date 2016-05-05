<?php $this->pageTitle = 'Manage order of FAQ Categories'; ?>

<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <div class="col-md-12">
        <!-- TABLE: LATEST ORDERS -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Manage order of FAQ Categories | <a class="text-blue" href="<?php echo Yii::app()->createAbsoluteUrl('admin/faqCategory/index'); ?>">Back to FAQ Categories</a>
                </h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div id="orderMsg"></div>
                <div class="form-group">
                    <?php if (!empty($categories)) { ?>
                        <ul id="sortable">
                            <?php foreach ($categories as $category) { ?>
                                <li class="ui-state-default" data="<?php echo $category->faqcategory_id; ?>">
                                    <i class="fa fa-angle-right"></i> <?php echo $category->faqcategory_name; ?>
                                </li>
                            <?php } ?>
                        </ul>
                        <input type="button" value="Save Order" name="saveOrder" id="saveOrder" class="btn btn-success" />
                    <?php } else { ?>
                        No Categories Found!
                    <?php } ?>
                </div>    
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->

<style>
    #sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; }
    #sortable li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; height: 1.5em; }
    html>body #sortable li { height: 1.5em; line-height: 1.2em; }
    .ui-state-highlight { height: 1.5em; line-height: 1.2em; }
    .ui-sortable li {height: 32px !important;line-height: 22px !important;margin: 0 0 10px !important;padding: 4px !important;cursor: pointer !important;}
    .ui-sortable-helper {background: rgb(44,62,80) !important;color: #fff !important;}
</style>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
    $(function () {
        $("#sortable").sortable({
            placeholder: "ui-state-highlight"
        });
        $("#sortable").disableSelection();

        $('#saveOrder').click(function () {
            var list = [];
            $('#sortable li').each(function (i) {
                list.push(parseInt($(this).attr('data')));
            });

            $.ajax({
                'url': '/admin/faqcategory/saveorder',
                data: {list: list},
                type: 'POST',
                success: function (response) {
                    if (response == 1) {
                        $('#orderMsg').removeClass('alert alert-danger');
                        $('#orderMsg').addClass('alert alert-success');
                        $('#orderMsg').html('Order saved successfully.');
                    } else {
                        $('#orderMsg').removeClass('alert alert-success');
                        $('#orderMsg').addClass('alert alert-danger');
                        $('#orderMsg').html('Order saved failed. Try again later!');
                    }
                }
            });
        });
    });
</script>