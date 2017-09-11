<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Vendor $vendor
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
                                    <dt><?= __('Org Name') ?>:</dt> 
                                        <dd>
                                            <span class="label label-success"><?= h($vendor->org_name) ?></span>
                                        </dd>
                                    </dl> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <dl class="dl-horizontal">
                                        <dt data-toggle="tooltip" data-placement="top" title="This Client Identifier is used for setting up the app" data-original-title="Tooltip on top"><i class="fa- fa fa-info-circle" style="padding-right: 5px"></i><?= __('Client Identifier') ?>:</dt> <dd><span class="label label-primary"> <?= h($vendor->client_identifier) ?></span> </dd>

                                        
                                        <dt><?= __('Client Logo') ?>:</dt> <dd> <?= $this->Html->image($vendor->image_url, array('height' => 100, 'width' => 100,'id'=>'upload-img')); ?> </dd>

                                        <dt><?= __('Created') ?>:</dt> <dd> <?= h($vendor->created) ?> </dd>
                                        <dt><?= __('Modified') ?>:</dt> <dd><?= h($vendor->modified) ?></dd>
                                        <dt><?= __('Status') ?>:</dt> <dd><?= h($vendor->status)?'Enabled':'Disabled' ?></dd>
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