<?php
$model = new Education;
$currentYear = Date('Y');
$start = $currentYear - 10;
$mon = array(1 => 'Jan', 2 => "Feb", 3 => "Mar", 4 => "Apr", 5 => 'May', 6 => 'Jun', 7 => 'July',
    8 => 'August', 9 => 'Sept', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
?>
<div class="widget m-bottom4" id="education">
    <div class="cat-title white font-bold uppercase">
        Education
    </div>
    <div class="c-post one">
        <div class="education-list">
            <?php $education = Education::model()->findAllByAttributes(array('education_customerID' => $current_user)) ?>
            <?php if (!empty($education)) { ?>
                <?php foreach ($education as $edu) { ?>
                    <div class="my-box">
                        <h1><?= $edu->education_degree; ?>
                            <span class="pull-right">
                                <a class="btnEdu" data="<?= $edu->education_id; ?>" edit-for="pub" href="javascript:void(0);"><i  class="fa fa-edit"></i></a>
                                <a class="btnDelEdu" data="<?= $edu->education_id; ?>" href="javascript:void(0);"><i class="fa fa-trash"></i></a>
                            </span>
                        </h1>
                        <p><b><?= $edu->education_university; ?></b> <?= $edu->education_startyear; ?> - <?= $edu->education_endyear; ?></p>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="alert alert-info">No Education found!</div>
            <?php } ?>
        </div>
        <div class="education-add" style="display: none;">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'sky-education',
                'enableClientValidation' => true,
                'enableAjaxValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => true,
                ),
                'htmlOptions' => array('class' => 'sky-form')
            ));
            ?>
            <fieldset>
                <section>
                    <div class="row">
                        <input type="hidden" class="edu_id"  name="id" value=""/>
                        <label class="label col col-4">Country</label>
                        <div class="col col-8">
                            <label class="select">
                                <select id="Education_education_countryID" name="Education[education_countryID]">
                                    <option value="0" selected="" disabled="">Country</option>
                                    <option value="1">India</option>
                                    <option value="2">China</option>
                                    <option value="3">Japan</option>
                                </select>
                                <i></i> 
                            </label>
                            <?php echo $form->error($model, 'education_countryID', array('class' => 'text-red')); ?>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="row">
                        <label class="label col col-4">University/College</label>
                        <div class="col col-8">
                            <label class="input"> <i class="icon-append fa fa-user"></i>
                                <?php echo $form->textField($model, 'education_university', array('placeholder' => $model->getAttributeLabel('education_university'))); ?>
                            </label>
                            <?php echo $form->error($model, 'education_university', array('class' => 'text-red')); ?>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="row">
                        <label class="label col col-4">Degree</label>
                        <div class="col col-8">
                            <label class="input"> <i class="icon-append fa fa-user"></i>
                                <?php echo $form->textField($model, 'education_degree', array('placeholder' => $model->getAttributeLabel('education_degree'))); ?>
                            </label>
                            <?php echo $form->error($model, 'education_degree', array('class' => 'text-red')); ?>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="row">
                        <label class="label col col-4">Start Year</label>
                        <div class="col col-8">
                            <label class="select">
                                <select id="Education_education_startyear" name="Education[education_startyear]">
                                    <option value="0" selected="" disabled="">Year</option>
                                    <?php for ($start; $start <= $currentYear; $start++) { ?>
                                        <option value="<?= $start; ?>"><?= $start; ?></option>
                                        <?php
                                    }
                                    $start = $currentYear - 10;
                                    ?>
                                </select>
                                <i></i> 
                            </label>
                            <?php echo $form->error($model, 'education_startyear', array('class' => 'text-red')); ?>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="row">
                        <label class="label col col-4">End Year</label>
                        <div class="col col-8">
                            <label class="select">
                                <select id="Education_education_endyear" name="Education[education_endyear]">
                                    <option value="0" selected="" disabled="">Year</option>
                                    <?php for ($start; $start <= $currentYear; $start++) { ?>
                                        <option value="<?= $start; ?>"><?= $start; ?></option>
                                        <?php
                                    }
                                    $start = $currentYear - 10;
                                    ?>
                                </select>
                                <i></i> 
                            </label>
                            <?php echo $form->error($model, 'education_endyear', array('class' => 'text-red')); ?>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="row">
                        <label class="label col col-4"></label>
                        <div class="col col-8">
                            <button class="button" type="submit">Save</button>
                            <button class="button button-secondary" type="reset">Cancel</button>
                        </div>
                    </div>
                </section>
            </fieldset>
            <?php $this->endWidget(); ?>
        </div>
        <div class="button">
            <a href="javascript:void(0);" id="btnAddEducationBlock" title="Add Education" class="btn boxed-color-xs uppercase">+ Education</a>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function () {
        $('.btnEdu').click(function () {
            var id = $(this).attr('data');
            $.ajax({
                url: "/user/customer/getEduData",
                type: "POST",
                data: ({id: id}),
                dataType: "json",
                success: function (res) {
                    $('#btnAddEducationBlock').click();
                    $(".edu_id").val(id);
                    $.each(res, function (k, v) {
                        $("#Education_" + k).val(v);
                    });

                }
            })
        });

        $(".btnDelEdu").click(function () {
            if (confirm("Do you realy want to delete ?")) {
                var objD = $(this);
                var id = objD.attr('data');
                $.ajax({
                    url: "/user/customer/DelEdu",
                    type: "POST",
                    data: ({id: id}),
                    dataType: "json",
                    success: function (res) {
                        objD.parents('.my-box').remove();
                        alert("Records has been deleted.");

                    }
                });
            }
        })

    });

</script>