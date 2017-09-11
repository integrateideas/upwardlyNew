<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\VendorAction $vendorAction
  */
?>
<div class = "row">
    <div class="col-lg-12">
        <div class="hpanel">
            <div class="panel-body">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="m-b-md">
                                    </div>
                                    <dl class="dl-horizontal">
                                    <dt><?= __('Vendor') ?>:</dt> 
                                        <dd>
                                            <span class="label label-success"><?= h($vendorAction->vendor->org_name) ?></span>
                                        </dd>
                                    </dl> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <dl class="dl-horizontal">
                                        <dt><?= __('Action') ?>:</dt> <dd><?= $vendorAction->has('action') ? $this->Html->link($vendorAction->action->name, ['controller' => 'Actions', 'action' => 'view', $vendorAction->action->id]) : '' ?></dd>
                                        <dt><?= __('Points') ?>:</dt> <dd> <?= $this->Number->format($vendorAction->points) ?> </dd>
                                        <dt><?= __('Custom Action') ?>:</dt> <dd> <?= h($vendorAction->custom_action_name) ? h($vendorAction->custom_action_name) : '...' ?> </dd>
                                        <dt><?= __('Created') ?>:</dt> <dd> <?= h($vendorAction->created) ?> </dd>
                                        <dt><?= __('Modified') ?>:</dt> <dd><?= h($vendorAction->modified) ?></dd>
                                    </dl>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <?= $this->Html->link('Back',$this->request->referer(),['class' => ['btn', 'btn-warning']]);?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>