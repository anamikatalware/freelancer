<?php
 
 $model = new Certification;
 $currentYear=Date('Y');
 $start= $currentYear-10;
?>

<div class="widget m-bottom4" id="certifications">
    <div class="cat-title white font-bold uppercase">
        Certifications
    </div>
    <div class="c-post one">
        <div class="certification-list">
            <?php $certification = Certification::model()->findAllByAttributes(array('certification_customerID' => $current_user)) ?>
            <?php if (!empty($certification)) { ?>
                <?php foreach ($certification as $cer) { ?>
                          
                    <div class="my-box">
                        <h1><?=$cer->certification_name; ?>
                            <span class="pull-right">
                                <a class="btnCert" data="<?=$cer->certification_id;?>" edit-for="Cert" href="javascript:void(0);"><i  class="fa fa-edit"></i></a>
                                <a class="btnDelCert" data="<?=$cer->certification_id;?>" href="javascript:void(0);"><i class="fa fa-trash"></i></a>
                            </span>
                        </h1>
                        <p><b><?=$cer->certification_organization; ?></b> - <?=$cer->certification_year; ?>
                          

                            </p>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="alert alert-info">No Certifications found!</div>
            <?php } ?>
        </div>
        <div class="certification-add" style="display: none;">
            <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'sky-certification',
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
                            <label class="label col col-4">Professional Certificate or Award</label>
                            <div class="col col-8">
                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                    <?php echo $form->textField($model, 'certification_name', array('placeholder' => $model->getAttributeLabel('certification_name'))); ?>
                                </label>
                                <?php echo $form->error($model, 'certification_name', array('class' => 'text-red')); ?>
                            </div>
                            <input type="hidden" class="cert_id"  name="id" value=""/>
                        </div>
                    </section>
                    <section>
                        <div class="row">
                            <label class="label col col-4">Conferring Organization</label>
                            <div class="col col-8">
                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                    <?php echo $form->textField($model, 'certification_organization', array('placeholder' => $model->getAttributeLabel('certification_organization'))); ?>
                                </label>
                                <?php echo $form->error($model, 'certification_organization', array('class' => 'text-red')); ?>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="row">
                            <label class="label col col-4">Describe Certification</label>
                            <div class="col col-8">
                                <label class="textarea">
                                    <?php echo $form->textarea($model, 'certification_description', array('placeholder' => $model->getAttributeLabel('certification_description'))); ?>
                                </label>
                                <?php echo $form->error($model, 'certification_description', array('class' => 'text-red')); ?>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="row">
                            <label class="label col col-4">Year</label>
                            <div class="col col-8">                                                
                                <label class="select">
                                    <select id="Certification_certification_year" name="Certification[certification_year]">
                                        <option value="0" selected="" disabled="">Year</option>
                                        <?php for ($start ; $start <=$currentYear; $start++ ){ ?>
                                                <option value="<?=$start; ?>"><?=$start; ?></option>
                                        <?php } ?>
                                    </select>
                                    <i></i> 
                                </label>
                                <?php echo $form->error($model, 'certification_year', array('class' => 'text-red')); ?>
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
            <a href="javascript:void(0);" id="btnAddCertificationBlock" title="Add Certification" class="btn boxed-color-xs uppercase">+ Certification</a>
        </div>
    </div>
</div>
<script type="text/javascript">

 $(document).ready(function(){
         $('.btnCert').click(function () {
            var id =$(this).attr('data');
            $.ajax({
                url:"/user/customer/getCertData",
                type:"POST",
                data:({id:id}),
                dataType:"json",
                success:function(res){                    
                    $('#btnAddCertificationBlock').click(); 
                    $(".cert_id").val(id);                    
                    $.each(res,function(k,v){                       
                       $("#Certification_"+k).val(v); 
                    });
                   
                }
            })          
        });

$(".btnDelCert").click(function(){
    if(confirm("Do you realy want to delete ?")){
      var objD= $(this);
      var id =objD.attr('data');
            $.ajax({
                url:"/user/customer/DelCert",
                type:"POST",
                data:({id:id}),
                dataType:"json",
                success:function(res){
                    objD.parents('.my-box').remove();                 
                   alert("Records has been deleted.");
                   
                }
            });
        }
  })

 });

</script>