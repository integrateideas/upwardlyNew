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
            <?= $this->Form->create($vendorAction, ['data-toggle'=>'validator','class' => 'form-horizontal', 'enctype'=>"multipart/form-data"]) ?>
            <?php echo $this->Form->input('vendor_id', ['value' =>$loggedInUser['vendor_id'],'type'=>'hidden']);?>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                <?= $this->Form->label('action_id', __('Action'), ['class' => ['col-sm-2', 'control-label']]); ?> 
                    <div class="col-sm-10">
                        <?= $this->Form->input('action_id', ['options' => $actions,'label' => false,'class' => ['form-control m-b']]); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>  
                <div class="form-group">
                <?= $this->Form->label('label', __('Custom Action'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                        <?= $this->Form->input('label', ['label' => false,'class' => ['form-control m-b']]); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                <?= $this->Form->label('points', __('Points'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                        <?= $this->Form->input('points', ['min'=>1,'label' => false,'class' => ['form-control m-b']]); ?>
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