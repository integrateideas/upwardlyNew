<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\VendorPlayer $vendorPlayer
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
                                            <span class="label label-success"><?= h($vendorPlayer['vendor']->org_name) ?></span>
                                        </dd>
                                    </dl> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <dl class="dl-horizontal">
                                        <dt><?= __('Player Name') ?>:</dt> <dd> <?= h($vendorPlayer['player']->first_name." ".$vendorPlayer['player']->last_name) ?> </dd>
                                        <dt><?= __('Points') ?>:</dt> <dd> <?= h($vendorPlayer->points) ?> </dd>
                                        <dt><?= __('Current Level') ?>:</dt><?php if(!empty($vendorPlayer['vendor_level'])){?> <dd> <?= h($vendorPlayer['vendor_level']->level_name) ?> </dd><?php }?>
                                        <dt><?= __('Badges Achieved') ?>:</dt>
                                        <dd> 
                                        <?php 
                                        if(!empty($vendorPlayer['vendor_player_badges'])){
                                        foreach ($vendorPlayer['vendor_player_badges'] as $playerBadges) { ?>
                                            <span class="label label-success"><?= h($playerBadges['vendor_badge']->name) ?></span>
                                        <?php } }?>
                                        </dd>
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
