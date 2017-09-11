<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="row">
<div class="col-lg-12">
    <div class="hpanel">
        <div class="panel-heading">
            
        </div>
        <div class="panel-body">
            <?= $this->Form->create($vendorBadge, ['data-toggle'=>'validator','class' => 'form-horizontal', 'enctype'=>"multipart/form-data"]) ?>
            <?php echo $this->Form->input('vendor_id', ['value' =>$loggedInUser['vendor_id'],'type'=>'hidden']);?>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                <?= $this->Form->label('badge_name', __('Badge Name'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                        <?= $this->Form->input('name', ['label' => false,'class' => ['form-control m-b']]); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                
                <div class="form-group">
                <?= $this->Form->label('description', __('Badge Description'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                        <?= $this->Form->input('description', ['label' => false,'class' => ['form-control m-b']]); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>

                <div class="form-group">
                <?= $this->Form->label('points', __('Points'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                        <?= $this->Form->input('points', ['min'=>'1','id'=>'input-points','label' => false, 'class' => ['form-control m-b']]); ?>
                    </div>
                </div>

                <div class="hr-line-dashed"></div>
                <div class="form-group">
                <?= $this->Form->label('image', __('Upload Image'), ['class' => 'col-sm-2 control-label']); ?>
                    <div class="col-sm-4">
                        <div class="img-thumbnail">
                            <?= $this->Html->image($vendorBadge->image_url, array('height' => 100, 'width' => 100,'id'=>'upload-img')); ?>
                        </div>
                        <br> </br>
                        <?= $this->Form->input('image_name', ['accept'=>"image/*",'label' => false,'required' => true,['class' => 'form-control'],'type' => "file",'id'=>'imgChange']); ?>
                    </div>
                </div>

                <div class="hr-line-dashed"></div>
                <div class="form-group">
                <?= $this->Form->label('action_id', __('Action'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                    <?= $this->Form->input('vendor_badge_action.vendor_action_id', ['options' => $vendorActions, 'label' => false, 'class' => 'form-control']); ?>
                        <div class="form-group">
                            <!-- <a href="#" data-toggle="modal" data-target="#basicModal"> Add Custom Action</a> -->
                        </div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                <?= $this->Form->label('frequency', __('Frequency'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                        <?= $this->Form->input('vendor_badge_action.frequency', ['min'=>1,'id'=>'frequency','label' => false, "type"=>"number",'class' => ['form-control m-b']]); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                <?= $this->Form->label('status', __('Status'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                        <?= $this->Form->input('status', ['label' => false,'class' => ['form-control m-b']]); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>

                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-2">
                    <?= $this->Form->button(__('Submit'), ['id'=>'check_submit','class' => ['btn', 'btn-primary']]) ?>
                    <?= $this->Html->link('Cancel',$this->request->referer(),['id'=>'check_cancel','class' => ['btn', 'btn-danger']]);?>
                    </div>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="basicModal">
  <div class="modal-dialog" role="document">
    <?php //$this->Form->create($vendorBadge, ['class' => 'form-horizontal','data-toggle'=>"validator"]) ?>
    <form action="/upwardly/vendor-actions/add" data-toggle="validator" class="form-horizontal" accept-charset="utf-8" method="post">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?= __('Add Custom Action')?></h4>
      </div>

      <div class="modal-body">
      <div class="alert" id="rsp_msg" style=''>

        </div>
        <div class="form-group">
          <?= $this->Form->label('name', __('Name'), ['class' => ['col-sm-2', 'control-label']]); ?>
          <div class="col-sm-8">
           <?= $this->Form->input("action", array(
            "label" => false,
            'id'=>'action',
            "type"=>"text",
            "class" => "form-control"));
            ?>
          </div>
        </div>

        <div class="form-group">
          <?= $this->Form->label('points', __('Points'), ['class' => ['col-sm-2', 'control-label']]); ?>
          <div class="col-sm-8">
           <?= $this->Form->input('points', ['id'=>'actionpoints','label' => false,'step'=>1, 'min'=>1, "type"=>"number",'onpaste'=>"return false;",['class' => 'form-control']]); ?>
          </div>
        </div>
      </div>

      <div class="modal-footer text-center">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <?= $this->Form->input(__('submit'), ['class' => ['btn', 'btn-primary'],"type"=>"button",'label'=>false,'id'=>"customAction",'name'=>"Submit"]) ?>
      </div>
      </form>
      <?php //$this->Form->end() ?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<style type ="text/style">
.img-thumbnail {
    background: #fff none repeat scroll 0 0;
    height: 200px;
    margin: 10px 5px;
    padding: 0;
    position: relative;
    width: 200px;
}
.img-thumbnail img {
    border :1px solid #dcdcdc;
    max-width: 100%;
    object-fit: cover;
}
</style>
<script type ="text/javascript">
    /**
    * @method uploadImage
    @return null
    */    
    function uploadImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#upload-img').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imgChange").change(function(){
        uploadImage(this);
    });
</script>
