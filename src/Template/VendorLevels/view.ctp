<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\VendorLevel $vendorLevel
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
                                            <span class="label label-success"><?= h($vendorLevel->vendor->org_name) ?></span>
                                        </dd>
                                    </dl> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <dl class="dl-horizontal">
                                        <dt><?= __('Level Name') ?>:</dt> <dd> <?= h($vendorLevel->level_name) ?> </dd>
                                        <dt><?= __('Level Rank') ?>:</dt> <dd> <?= h($vendorLevel->level_rank) ?> </dd>
                                        <dt><?= __('Points') ?>:</dt> <dd> <?= h($vendorLevel->points) ?> </dd>
                                        <dt><?= __('Created') ?>:</dt> <dd> <?= h($vendorLevel->created) ?> </dd>
                                        <dt><?= __('Modified') ?>:</dt> <dd><?= h($vendorLevel->modified) ?></dd>
                                        <dt><?= __('Status') ?>:</dt> <dd><?= h($vendorLevel->status)?'Enabled':'Disabled' ?></dd>
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