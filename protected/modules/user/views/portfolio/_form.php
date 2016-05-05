<?php
$create_url = Yii::app()->createAbsoluteUrl('user/portfolio/add');
$update_url = Yii::app()->createAbsoluteUrl('user/portfolio/edit/id/' . $model->portfolio_id);

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'sky-form',
    'action' => ($model->isNewRecord) ? $create_url : $update_url,
    'enableAjaxValidation' => TRUE,
    'enableClientValidation' => TRUE,
    'clientOptions' => array(
        'validateOnSubmit' => TRUE,
        'validateOnChange' => TRUE
    ),
    'htmlOptions' => array(
        'autocomplete' => 'off',
        'enctype' => 'multipart/form-data',
        'role' => 'form',
        'class' => 'sky-form'
    ))
);
?>
<header>Portfolio Upload!</header>
<fieldset>    
    <section>
        <label class="label">Content Type</label>
        <table class="table">
            <tr>
                <td>
                    <label class="radio-inline" id="type_image">
                        <input type="radio" value="1" name="content_type" <?php echo $model->portfolio_content_type == 1 ? 'checked="checked"' : '' ?>/> Image
                    </label>    
                </td>
                <td>
                    <label class="radio-inline" id="type_article">
                        <input type="radio" value="2" name="content_type" <?php echo $model->portfolio_content_type == 2 ? 'checked="checked"' : '' ?> /> Article
                    </label>    
                </td>
                <td>
                    <label class="radio-inline" id="type_code">
                        <input type="radio" value="3" name="content_type" <?php echo $model->portfolio_content_type == 3 ? 'checked="checked"' : '' ?> /> Code
                    </label>    
                </td>
                <td>
                    <label class="radio-inline" id="type_video">
                        <input type="radio" value="4" name="content_type" <?php echo $model->portfolio_content_type == 4 ? 'checked="checked"' : '' ?> /> Video
                    </label>    
                </td>
                <td>
                    <label class="radio-inline" id="type_audio">
                        <input type="radio" value="5" name="content_type" <?php echo $model->portfolio_content_type == 5 ? 'checked="checked"' : '' ?>/> Audio
                    </label>    
                </td>
                <td>
                    <label class="radio-inline" id="type_others">
                        <input type="radio" value="6" name="content_type" <?php echo $model->portfolio_content_type == 6 ? 'checked="checked"' : '' ?>/> Others
                    </label>    
                </td>
            </tr>
        </table>
    </section>
    <section>
        <label class="label">Title</label>
        <label class="input">
            <?php echo $form->textField($model, 'portfolio_title', array('maxlength' => 60, 'placeholder' => 'Title')); ?>
            <p class="pull-right title-length">60 characters</p>
            <?php echo $form->error($model, 'portfolio_title', array('class' => 'text-red')); ?>
        </label>
    </section>
    <section>
        <label class="label">Item Description</label>
        <label class="textarea">
            <?php echo $form->textarea($model, 'portfolio_description', array('maxlength' => 1000, 'placeholder' => 'Item Description')); ?>
            <p class="pull-right description-length">1000 characters</p>
            <?php echo $form->error($model, 'portfolio_description', array('class' => 'text-red')); ?>
        </label>
    </section>
    <section style="display: none;" class="text-preview">
        <label class="label">Text Preview <i class="fa fa-question-circle"></i></label>
        <label class="textarea">
            <textarea class="Text Preview" maxlength="2000" id="text_preview" name="Portfolio[portfolio_other_description]"></textarea>
            <p class="pull-right text-preview-length">2000 characters</p>
        </label>
    </section>
    <section style="display: none;" class="code-sample">
        <label class="label">Code Sample(Optional) <i class="fa fa-question-circle"></i></label>
        <label class="textarea">
            <textarea class="Code Sample" maxlength="2000" id="code_sample" name="Portfolio[portfolio_other_description]"></textarea>
            <p class="pull-right code-sample-length">2000 characters</p>
        </label>
    </section>
    <section>
        <label class="label change-label">Upload File (Allowed formats: JPG, PNG, GIF. Maximum file size: 10MB</label>
        <label class="input">
            <div class="dropzone" id="myDropzone"></div>
        </label>
    </section>
    <section>
        <label class="label">Skills (Select from list or type your own)
            <p class="pull-right">Selected skills (Skills left: 5)</p>
        </label>
        <label class="select">
            <select class="subcategories" multiple="multiple" name="project_skills[]" id="Project_project_skills">
                <?php
                if ($model->isNewRecord == 1) {
                    $subcategories = SubCategory::model()->findAll();
                    $result = array();
                    if (!empty($subcategories)) {
                        foreach ($subcategories as $sub) {
                            ?>
                            <option value="<?php echo $sub->subcategory_id ?>"><?php echo $sub->subcategory_name ?></option>
                            <?php
                        }
                    }
                } else {
                    if (!empty($model->portfolio_skills)) {
                        $selected_skills = explode(',', $model->portfolio_skills);
                    }
                    $subcategories = SubCategory::model()->findAll();
                    $result = array();
                    if (!empty($subcategories)) {
                        foreach ($subcategories as $sub) {
                            ?>
                            <?php
                            $selected_check = '';
                            if (in_array($sub->subcategory_id, $selected_skills)) {
                                $selected_check = 'selected="selected"';
                            }
                            ?>
                            <option value="<?php echo $sub->subcategory_id ?>" <?php echo $selected_check ?>>
                                <?php echo $sub->subcategory_name ?>
                            </option>
                            <?php
                        }
                    }
                }
                ?>
            </select>
            <i></i>
        </label>
    </section>
</fieldset>
<footer>
    <button type="submit" class="button">Submit</button>
    <?php if ($model->isNewRecord) { ?>
        <button type="reset" class="button button-secondary">Cancel</button>
    <?php } ?>
</footer>

<?php $this->endWidget(); ?>

<style type="text/css">
    td {border: medium none !important;}
    .dropzone .dz-preview, .dropzone-previews .dz-preview {margin: 18px;}
    .dropzone {text-align: left;}
</style>

<link href="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/css/dropzone/css/dropzone.css" rel="stylesheet" type="text/css" />
<script src="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/js/dropzone/dropzone.js" type="text/javascript"></script>
<link href="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/css/jquery-ui.css" rel="stylesheet" />
<script src="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/js/jquery-ui.js"></script>

<script type="text/javascript">
    var flag = '<?php echo $model->isNewRecord ? 1 : 0; ?>';

    $(function () {
        $("div.dropzone").sortable({
            items: '.dz-preview',
            cursor: 'move',
            opacity: 0.5,
            containment: "parent",
            distance: 20,
            tolerance: 'pointer',
            update: function (e, ui) {
            }});

        Dropzone.autoDiscover = false;
        var count = 1;
        $("div.dropzone").dropzone({url: "<?php Yii::app()->baseUrl ?>/user/portfolio/upload",
            addRemoveLinks: true,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF, .doc, .docx, .xlx, .xlsx, .pdf, .zip",
            maxFilesize: 10,
            success: function (file, res) {
                var resp = $.parseJSON(res);
                var objectOn = $("div.dropzone .dz-details .dz-filename span:contains('" + file.name + "')");
                $(objectOn).append("<input type='hidden' data='" + file.name + "' value='" + resp.fname + "' name ='gallery[]' >");
                $(".dz-success-mark").show();
                $(".dz-success-mark").css("opacity", "1");
            },
            removedfile: function (res) {
                $("div.dropzone .dz-details .dz-filename span:contains('" + res.name + "')").parent().parent().parent().remove();

                if (flag == 1) {
                    var rem_file = JSON.parse(res.xhr.response);
                    $.ajax({
                        url: "<?php Yii::app()->baseUrl ?>/user/portfolio/remove",
                        data: {file: rem_file.fname},
                        type: 'POST',
                        dataType: 'JSON',
                        success: function (response) {
                            console.log(response);
                        }
                    });
                }

                $.each($('input:hidden'), function (i, val) {
                    var resd1 = ($.trim($(this).attr("data")));
                    var resd11 = ($.trim($(this).val()));
                    var resd2 = $.trim(res.name);
                    if (resd1 == resd2) {
                        $("#sky-form").append("<input type='hidden'  value='" + resd11 + "' name ='remgallery[]' >");
                        $(this).remove();
                    }
                });
            },
        });
    });

    if (flag == 0) {
        Dropzone.options.myDropzone = {
            init: function () {
                thisDropzone = this;
                $.get('/user/portfolio/getImages/<?php echo $model->portfolio_id; ?>', function (data) {
                    console.log(data);
                    $.each(data, function (key, value) {
                        var mockFile = {name: value.name, size: value.size, id: "all"};
                        thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                        //thisDropzone.options.thumbnail.call(thisDropzone, mockFile, "/path" + value.name);
                        thisDropzone.options.thumbnail.call(thisDropzone, mockFile, value.path);
                        var objectOn = $("div.dropzone .dz-details .dz-filename span:contains('" + value.name + "')");
                        $(objectOn).append("<input type='hidden' data=" + value.name + " value=" + value.name + " name ='gallery[]' >");
                    });
                    $(".dz-success-mark").show();
                    $(".dz-success-mark").css("opacity", "1");
                });
            }
        };
    }
</script>


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>

<style>
    .select2-container .select2-selection--multiple {min-height: 35px;line-height: 32px;}
    .select2-container--default .select2-selection--multiple {border: 1px solid #e5e5e5;border-radius: 0;}
    .select2-container--default .select2-selection--multiple .select2-selection__rendered {display: block;}
    .select2-container--default .select2-selection--multiple .select2-selection__choice {margin: 5px 5px 5px 0;line-height: 25px;background: rgb(0, 159, 240);color: #fff;}
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {color: #fff;margin-right: 5px;}
</style>
<script type="text/javascript">
    $(function () {
        $('.subcategories').select2({
            placeholder: "Skills",
            maximumSelectionLength: 5
        });

        $('#type_image').click(function () {
            $('.change-label').html('Upload File (Allowed formats: JPG, PNG, GIF. Maximum file size: 10MB');
            $('.text-preview').hide();
            $('.code-sample').hide();
        });
        $('#type_article').click(function () {
            if ($(this).children('input[type="radio"]').prop('checked')) {
                $('.change-label').html('Upload File (Maximum file size: 20MB)');
                $('.code-sample').hide();
                $('.text-preview').show();
            }
        });

        $('#type_code').click(function () {
            if ($(this).children('input[type="radio"]').prop('checked')) {
                $('.change-label').html('Upload File (Maximum file size: 20MB)');
                $('.code-sample').show();
                $('.text-preview').hide();
            }
        });

        $('#type_video').click(function () {
            if ($(this).children('input[type="radio"]').prop('checked')) {
                $('.change-label').html('Upload File (Allowed formats FLV, AVI, MP4, MOV. Maximum file size: 50MB)');
                $('.code-sample').hide();
                $('.text-preview').hide();
            }
        });

        $('#type_audio').click(function () {
            if ($(this).children('input[type="radio"]').prop('checked')) {
                $('.change-label').html('Upload File (Allowed formats MP3. Maximum file size: 20MB)');
                $('.code-sample').hide();
                $('.text-preview').hide();
            }
        });
        $('#type_others').click(function () {
            if ($(this).children('input[type="radio"]').prop('checked')) {
                $('.change-label').html('Upload File (Maximum file size: 20MB)');
                $('.code-sample').hide();
                $('.text-preview').hide();
            }
        });

        $('#title').keyup(function () {
            var left = 60 - $(this).val().length;
            if (left < 0) {
                left = 0;
            }
            $('.title-length').text(left + ' characters');
        });
        $('#description').keyup(function () {
            var left = 1000 - $(this).val().length;
            if (left < 0) {
                left = 0;
            }
            $('.description-length').text(left + ' characters');
        });
        $('#text_preview').keyup(function () {
            var left = 2000 - $(this).val().length;
            if (left < 0) {
                left = 0;
            }
            $('.text-preview-length').text(left + ' characters');
        });
        $('#code_sample').keyup(function () {
            var left = 2000 - $(this).val().length;
            if (left < 0) {
                left = 0;
            }
            $('.code-sample-length').text(left + ' characters');
        });

    });
</script>