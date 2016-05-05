<?php
$model = new Experience;
$month= array(1=>'January',2=>"February",3=>"March",4=>"April",5=>'May',6=>'June', 7=>'July',
       8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
$mon= array(1=>'Jan',2=>"Feb",3=>"Mar",4=>"Apr",5=>'May',6=>'Jun', 7=>'July',
       8=>'August',9=>'Sept',10=>'Oct',11=>'Nov',12=>'Dec');
$currentYear=Date('Y');
$start= $currentYear-10;
?>



<div class="widget m-bottom4" id="experience">
    <div class="cat-title white font-bold uppercase">
        Experience
    </div>
    <div class="c-post one">
        <div class="experience-list">
            <?php $experience = Experience::model()->findAllByAttributes(array('experience_customerID' => $current_user)) ?>
            <?php if (!empty($experience)) { ?>
                <?php foreach ($experience as $exp) { ?>
                  
                    <div class="my-box">
                        <h1><?=$exp->experience_title; ?>
                            <span class="pull-right">
                                <a class="btnedit" data="<?=$exp->experience_id;?>" edit-for="experience" href="javascript:void(0);"><i  class="fa fa-edit"></i></a>
                                <a class="btnDelExp" data="<?=$exp->experience_id;?>" href="javascript:void(0);"><i class="fa fa-trash"></i></a>
                            </span>
                        </h1>
                        <p><b><?=$exp->experience_company; ?></b> <?= $mon[$exp->experience_start_month]; ?> <?=$exp->experience_start_year; ?> - 
                          <?php if($exp->experience_currently_working) {
                            echo "Present" ; 
                          }else{
                            echo  $mon[$exp->experience_end_month] ." ". $exp->experience_end_year;
                          } ?>

                            </p>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="alert alert-info">No Experience found!</div>
            <?php } ?>
        </div>
        <div class="experience-add" style="display: none;">
            <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'sky-experience',
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
                            <label class="label col col-4">Title</label>
                            <div class="col col-8">
                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                    <?php echo $form->textField($model, 'experience_title', array('placeholder' => $model->getAttributeLabel('experience_title'))); ?>
                                </label>
                                <?php echo $form->error($model, 'experience_title', array('class' => 'text-red')); ?>
                             
                             <input type="hidden" class="id"  name="id" value=""/>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="row">
                            <label class="label col col-4">Company</label>
                            <div class="col col-8">
                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                 <?php echo $form->textField($model, 'experience_company', array('placeholder' => $model->getAttributeLabel('experience_company'))); ?>
                                </label>
                                <?php echo $form->error($model, 'experience_company', array('class' => 'text-red')); ?>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="row">
                            <label class="label col col-4">Start Time Period</label>
                            <div class="col col-8">
                                <div class="row">
                                    <div class="col col-6">
                                          <label class="select">
                                            <select id="Experience_experience_start_month" name="Experience[experience_start_month]">
                                                <option value="0" selected="" disabled="">Start Month</option>
                                               <?php  foreach ($month as $key=> $value) { ?>
                                                <option value="<?= $key ?>"><?= $value ?></option>
                                                <?php }  ?>
                                            </select>
                                            <i></i> 
                                        </label>
                                        <?php echo $form->error($model, 'experience_start_month', array('class' => 'text-red')); ?>
                                   
                                    </div>
                                    <div class="col col-6">
                                        <label class="select">
                                            <select id="Experience_experience_start_year" name="Experience[experience_start_year]">
                                                <option value="0" selected="" disabled="">Start Year</option>
                                                <?php for ($start ; $start <=$currentYear; $start++ ){ ?>
                                                <option value="<?=$start; ?>"><?=$start; ?></option>
                                                <?php }
                                                 $start=$currentYear-10;
                                                 ?>
                                            </select>
                                            <i></i> 
                                        </label>
                                        <?php echo $form->error($model, 'experience_start_year', array('class' => 'text-red')); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="row">
                            <label class="label col col-4"></label>
                            <div class="col col-8">
                                <label class="checkbox">
                                    <input type="checkbox"  id="experience_currently_working">                                    
                                    <i></i> Currently working here
                                </label>
                                <input type="hidden" name="Experience[experience_currently_working]" value="0" id="currently_working">
                                
                            </div>
                        </div>
                    </section>
                    <section id="endtime">
                        <div class="row">
                            <label class="label col col-4">End Period</label>
                            <div class="col col-8">
                                <div class="row">
                                    <div class="col col-6">
                                        <label class="select">
                                            <select id="Experience_experience_end_month" name="Experience[experience_end_month]">
                                                <option value="0" selected="" disabled="">End Month</option>
                                                <?php  foreach ($month as $key=> $value) { ?>
                                                <option value="<?= $key ?>"><?= $value ?></option>
                                                <?php }  ?>
                                            </select>
                                            <i></i> 
                                        </label>
                                        <?php echo $form->error($model, 'experience_end_month', array('class' => 'text-red')); ?>
                                    </div>
                                    <div class="col col-6">
                                        <label class="select">
                                            <select id="Experience_experience_end_year" name="Experience[experience_end_year]">
                                                <option value="0" selected="" disabled="">End Year</option>
                                                <?php for ($start ; $start <=$currentYear; $start++ ){ ?>
                                                <option value="<?=$start; ?>"><?=$start; ?></option>
                                                <?php } ?>
                                            </select>
                                            <i></i> 
                                        </label>
                                        <?php echo $form->error($model, 'experience_end_year', array('class' => 'text-red')); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="row">
                            <label class="label col col-4">Summary</label>
                            <div class="col col-8">
                                <label class="textarea">
                                    <?php echo $form->textarea($model, 'experience_summary', array('placeholder' => $model->getAttributeLabel('experience_summary'))); ?>
                                </label>
                                <?php echo $form->error($model, 'experience_summary', array('class' => 'text-red')); ?>
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
            <a href="javascript:void(0);" id="btnAddExperienceBlock" title="Add Experience" class="btn boxed-color-xs uppercase">+ Experience</a>
        </div>
    </div>
</div>
<script type="text/javascript">

 $(document).ready(function(){
    $("#experience_currently_working").click(function(){
      
       if($(this).is(":checked")){
           $("#endtime").hide();
           $("#currently_working").val('1');
       }else{
        $("#endtime").show();
        $("#currently_working").val('0');
       }
    });


        $('.btnedit').click(function () {
            var id =$(this).attr('data');
            $.ajax({
                url:"/user/customer/getExpData",
                type:"POST",
                data:({id:id}),
                dataType:"json",
                success:function(res){                    
                    $('#btnAddExperienceBlock').click(); 
                    $(".id").val(id);                    
                    $.each(res,function(k,v){                       
                       $("#Experience_"+k).val(v); 
                    });
                    var is_current=res.experience_currently_working;                    
                    if(is_current=="1"){                        
                        $("#experience_currently_working").click().prop('checked',true);
                    }else{
                         $("#experience_currently_working").prop('checked',false);
                    }
                    
                }
            })          
        });

$(".btnDelExp").click(function(){
    if(confirm("Do you realy want to delete ?")){
      var objD= $(this);
      var id =objD.attr('data');
            $.ajax({
                url:"/user/customer/DelExp",
                type:"POST",
                data:({id:id}),
                dataType:"json",
                success:function(res){
                    objD.parents('.my-box').remove();                 
                   alert("Records has been deleted.");
                   
                }
            });
        }
  });

 });

</script>

<style type="text/css">
.my-box h1 {
  font-size: 20px;
  font-weight: bold;
  margin: 0 0 10px;
}
.my-box .fa {
  color: #aaa;
}
</style>