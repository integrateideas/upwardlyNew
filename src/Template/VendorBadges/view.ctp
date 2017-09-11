<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\VendorBadge $vendorBadge
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
                                            <span class="label label-success"><?= h($vendorBadge->vendor->org_name) ?></span>
                                        </dd>
                                    </dl> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <dl class="dl-horizontal">
                                        <dt><?= __('Badge Name') ?>:</dt> <dd><?= h($vendorBadge->name) ?></dd>
                                        <dt><?= __('Points') ?>:</dt> <dd> <?= $this->Number->format($vendorBadge->points) ?></dd>
                                        <dt><?= __('Frequency') ?>:</dt> <dd> <?= $this->Number->format($vendorBadge['vendor_badge_actions'][0]->frequency) ?></dd>
                                        <dt><?= __('Image') ?>:</dt> <dd>  <a href="<?= $vendorBadge->image_url ?>" target="_blank"><?= $this->Html->image($vendorBadge->image_url, array('height' => 100, 'width' => 100))?></a> </dd>
                                        <dt><?= __('Created') ?>:</dt> <dd> <?= h($vendorBadge->created) ?> </dd>
                                        <dt><?= __('Modified') ?>:</dt> <dd><?= h($vendorBadge->modified) ?></dd>
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