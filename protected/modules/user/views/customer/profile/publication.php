<?php
 
 $model = new Publication;

?>

<div class="widget m-bottom4" id="publications">
    <div class="cat-title white font-bold uppercase">
        Publications
    </div>
    <div class="c-post one">
        <div class="publication-list">
            <?php $publication = Publication::model()->findAllByAttributes(array('publication_customerID' => $current_user)) ?>
            <?php if (!empty($publication)) { ?>
                <?php foreach ($publication as $pub) { ?>
                    <div class="my-box">
                        <h1><?=$pub->publication_title; ?>
                            <span class="pull-right">
                                <a class="btnPub" data="<?=$pub->publication_id;?>" edit-for="Cert" href="javascript:void(0);"><i  class="fa fa-edit"></i></a>
                                <a class="btnDelPub" data="<?=$pub->publication_id;?>" href="javascript:void(0);"><i class="fa fa-trash"></i></a>
                            </span>
                        </h1>
                        <p><b><?=$pub->publication_publisher; ?></b>
                          

                            </p>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="alert alert-info">No Publications Added!</div>
            <?php } ?>
        </div>
        <div class="publication-add" style="display: none;">
         <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'sky-publication',
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
                            <label class="label col col-4">Publication Title</label>
                            <div class="col col-8">
                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                    <?php echo $form->textField($model, 'publication_title', array('placeholder' => $model->getAttributeLabel('publication_title'))); ?>
                                </label>
                                <?php echo $form->error($model, 'publication_title', array('class' => 'text-red')); ?>
                            </div>
                            <input type="hidden" class="pub_id"  name="id" value=""/>
                        </div>
                    </section>
                    <section>
                        <div class="row">
                            <label class="label col col-4">Publisher</label>
                            <div class="col col-8">
                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                     <?php echo $form->textField($model, 'publication_publisher', array('placeholder' => $model->getAttributeLabel('publication_publisher'))); ?>
                                </label>
                                <?php echo $form->error($model, 'publication_publisher', array('class' => 'text-red')); ?>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="row">
                            <label class="label col col-4">Summary</label>
                            <div class="col col-8">
                                <label class="textarea">
                                     <?php echo $form->textarea($model, 'publication_summary', array('placeholder' => $model->getAttributeLabel('publication_summary'))); ?>
                                </label>
                                <?php echo $form->error($model, 'publication_summary', array('class' => 'text-red')); ?>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="row">
                            <label class="label col col-4"></label>
                            <div class="col col-8">
                                 <?php echo CHtml::submitButton('Submit', array('class' => 'button', 'id' => 'btnpublication')); ?>                                <button class="button button-secondary" type="reset">Cancel</button>
                            </div>
                        </div>
                    </section>
                </fieldset>
           <?php $this->endWidget(); ?>
        </div>
        <div class="button">
            <a href="javascript:void(0);" id="btnAddPublicationBlock" title="Add Publication" class="btn boxed-color-xs uppercase">+ Publication</a>
        </div>
    </div>
</div>
<script type="text/javascript">

 $(document).ready(function(){
         $('.btnPub').click(function () {
            var id =$(this).attr('data');
            $.ajax({
                url:"/user/customer/getPubData",
                type:"POST",
                data:({id:id}),
                dataType:"json",
                success:function(res){                    
                    $('.publication-add').show(); 
                    $(".pub_id").val(id);                    
                    $.each(res,function(k,v){                       
                       $("#Publication_"+k).val(v); 
                    });
                   
                }
            })          
        });
 $(".btnDelPub").click(function(){
    if(confirm("Do you realy want to delete ?")){
      var objD= $(this);
      var id =objD.attr('data');
            $.ajax({
                url:"/user/customer/DelPub",
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