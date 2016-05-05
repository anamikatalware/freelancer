<?php
$current_user = Yii::app()->user->id;
$skills_array = array();
?>

<div class="widget m-bottom4" id="my_top_skills">
    <div class="cat-title white font-bold uppercase">
        My Skills
    </div>
    <div class="c-post one text-right">
        <a class="btn btn-info" id="showSkillsModal"><i class="fa fa-plus"></i> Skills</a>
    </div>

    <?php $skills = CustomerSkills::model()->findAllByAttributes(array('skill_customerID' => $current_user)); ?>

    <?php if (!empty($skills)) { ?>
        <?php foreach ($skills as $skill) { ?>
            <?php array_push($skills_array, $skill->skill_subcategoryID); ?>
            <div class="c-post one">
                <div class="c-post-content">
                    <h4 class="c-post-title">
                        <a href="javascript:void(0);">
                            <?php echo SubCategory::model()->getSubCategoryName($skill->skill_subcategoryID); ?>
                        </a>
                    </h4>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</div>

<div id="skillsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Select your skills and expertise</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-8">
                        <?php $categories = Category::model()->findAll('category_status=1'); ?>
                        <?php if (!empty($categories)) { ?>
                            <ul class="categories-list">
                                <?php foreach ($categories as $category) { ?>
                                    <li class="single-category" data-id="<?php echo $category->category_id; ?>">
                                        <div class="category-box">
                                            <i class="fa fa-globe fa-3x"></i>
                                            <?php echo $category->category_name; ?>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>

                        <?php if (!empty($categories)) { ?>
                            <?php foreach ($categories as $category) { ?>
                                <div class="subcategory-<?php echo $category->category_id ?>" style="display: none;">
                                    <header class="subcategory-header">
                                        <h1>
                                            <?php echo $category->category_name ?>
                                            <small><a class="subcategory-close" href="javascript:void(0);" data-id="<?php echo $category->category_id ?>">Back to Categories</a></small>
                                        </h1>
                                    </header>
                                    <?php $subcategories = SubCategory::model()->findAllByAttributes(array('subcategory_categoryID' => $category->category_id)); ?>
                                    <?php if (!empty($subcategories)) { ?>
                                        <ul class="subcategory-list">
                                            <?php foreach ($subcategories as $subcategory) { ?>
                                                <?php
                                                $active = 'inactive';
                                                if (in_array($subcategory->subcategory_id, $skills_array)) {
                                                    $active = 'active';
                                                }
                                                ?>
                                                <li>
                                                    <div class="subcategory-box <?php echo $active; ?>" id="subcategory_<?php echo $subcategory->subcategory_id; ?>" data-id="<?php echo $subcategory->subcategory_id; ?>" data-name="<?php echo $subcategory->subcategory_name; ?>">
                                                        <?php echo $subcategory->subcategory_name; ?>
                                                        <?php if ($active == 'inactive') { ?>
                                                            <span class="fa fa-plus"></span>
                                                        <?php } else { ?>
                                                            <span class="fa fa-check"></span>
                                                        <?php } ?>
                                                    </div>                                                    
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    <?php } else { ?>
                                    <div class="alert alert-warning">No Category Found!</div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col-sm-4">
                        <div class="selected-skill-counter">
                            <span class="selected-skill-value" id="projectCounter">13713</span>
                            <span class="selected-skill-desc">Jobs matching your skills</span>
                        </div>
                        <div class="selected-skill-inner">
                            <h4 class="selected-skill-title" id="skills-remaining">
                                <span id="availableSkills">23</span> of <span id="totalSkills">86</span> Selected skills
                            </h4>

                            <form class="selected-skill-form" id="saveSkillForm" action="/user/customer/skills" method="post">
                                <div class="slimScrollDiv">
                                    <ul class="selected-skill-list" id="selected-skill-list">
                                        <?php if (!empty($skills)) { ?>
                                            <?php foreach ($skills as $skill) { ?>
                                                <li>
                                                    <?php $name = SubCategory::model()->getSubCategoryName($skill->skill_subcategoryID); ?>
                                                    <div class="skill-select-bubble" data-id="<?php echo $skill->skill_id ?>" data-sub-id="<?php echo $skill->skill_subcategoryID ?>" data-name="<?php echo $name ?>">
                                                        <?php echo $name; ?> <span class="fa fa-times"></span>
                                                    </div>
                                                    <input type="hidden" value="<?php echo $skill->skill_subcategoryID ?>" name="subcategory[]" />
                                                </li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </form>
                            <button class="btn btn-info selected-skill-button" id="saveSkills">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .modal-backdrop{z-index:9999!important}.modal{z-index:99999!important}.categories-list{padding:0;margin:0}.single-category{border:1px solid #ccc;display:inline-block;height:100%;margin-bottom:2px;min-height:160px;padding:10px;text-align:center;vertical-align:middle;width:32%;cursor:pointer}.selected-skill-counter{background:#eee;border-top-left-radius:5px;border-top-right-radius:5px;height:80px;padding:10px;border:1px solid #ccc}.selected-skill-value{color:#000;display:block;font-size:25px;font-weight:700}.selected-skill-title{background:#eee;border:1px solid #ccc;margin:0;padding:10px;border-top:none}.selected-skill-form{-moz-border-bottom-colors:none;-moz-border-left-colors:none;-moz-border-right-colors:none;-moz-border-top-colors:none;background:#eee;border-color:-moz-use-text-color #ccc #ccc;border-image:none;border-style:none solid solid;border-width:medium 1px 1px;margin-bottom:10px;padding:10px}.slimScrollDiv{height:250px;overflow-y:scroll}#selected-skill-list .fa.fa-times{display:none}#selected-skill-list .skill-select-bubble:hover{background:#009ff0;border-radius:5px;color:#000;padding:5px}#selected-skill-list .skill-select-bubble:hover .fa.fa-times{cursor:pointer;display:block;float:right;padding-right:15px;padding-top:2px}#selected-skill-list li{padding:4px 0;margin-bottom:4px}.category-box i{display:block;margin-bottom:10px;margin-top:10px}.subcategory-header{border:1px solid #ccc;border-radius:4px;padding:10px}.subcategory-header h1{font-size:20px;margin:0}.subcategory-list{border:1px solid #ccc;border-radius:4px;height:340px;margin:5px 0 0;overflow-y:scroll;padding:10px}.subcategory-list li{display:inline-block;padding:5px;width:48%}.subcategory-box:hover{background:#009ff0;border-radius:5px;color:#000;padding:5px}.subcategory-box:hover .fa{cursor:pointer;display:block;float:right;padding-right:15px;padding-top:4px}.subcategory-box .fa{display:none}.category-box{font-weight:700;padding-bottom:15px}
    .subcategory-box.active {background: #009ff0 none repeat scroll 0 0;border-radius: 5px;color: #000;padding: 5px;}
    .subcategory-box.active .fa {display: block;float: right;padding-right: 15px;padding-top: 4px;}
    .subcategory-box, #selected-skill-list .skill-select-bubble:hover {cursor: pointer;}
    .alert.alert-warning {margin-top: 10px;}
</style>

<script type="text/javascript">
    $(function () {
        var category_id = 0;

        //$('#skillsModal').modal('show');
        $('#showSkillsModal').click(function () {
            $('.categories-list').show();
            $('.subcategory-' + category_id).hide();
            $('#skillsModal').modal('show');
        });

        $(document).on('click', '.single-category', function () {
            category_id = $(this).attr('data-id');
            $('.categories-list').hide();
            $('.subcategory-' + category_id).show();
        });

        $(document).on('click', '.subcategory-close', function () {
            category_id = $(this).attr('data-id');
            $('.subcategory-' + category_id).hide();
            $('.categories-list').show();
        });

        $(document).on('click', '.subcategory-box.inactive', function () {
            var subcategory_id = $(this).attr('data-id');
            var subcategory_name = $(this).attr('data-name');

            $(this).addClass('active');
            $(this).removeClass('inactive');
            $(this).html(subcategory_name + ' <span class="fa fa-check"></span>');

            var html = '';
            html += '<li>';
            html += '   <div class="skill-select-bubble" data-id="0" data-sub-id="' + subcategory_id + '" data-name="' + subcategory_name + '">';
            html += '       ' + subcategory_name + ' <span class="fa fa-times"></span>';
            html += '   </div>';
            html += '   <input type="hidden" value="' + subcategory_id + '" name="subcategory[]" />';
            html += '</li>';

            $('#selected-skill-list').prepend(html);
        });


        $(document).on('click', '.skill-select-bubble', function () {
            var skill_id = $(this).attr('data-id');
            var subcategory_id = $(this).attr('data-sub-id');
            var subcategory_name = $(this).attr('data-name');

            $('#subcategory_' + subcategory_id).removeClass('active');
            $('#subcategory_' + subcategory_id).addClass('inactive');
            $('#subcategory_' + subcategory_id).html(subcategory_name + ' <span class="fa fa-plus"></span>');

            $(this).parents('li').remove();
        });

        $(document).on('click', '#saveSkills', function () {
            $('#saveSkillForm').submit();
        });

    });
</script>