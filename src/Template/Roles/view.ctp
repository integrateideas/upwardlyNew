<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Role $role
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
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <dl class="dl-horizontal">
                                        <dt><?= __('Name') ?>:</dt> <dd> <?= h($role->name) ?> </dd>
                                        <dt><?= __('Label') ?>:</dt> <dd> <?= h($role->label) ?> </dd>
                                        <dt><?= __('Created') ?>:</dt> <dd> <?= h($role->created) ?> </dd>
                                        <dt><?= __('Modified') ?>:</dt> <dd><?= h($role->modified) ?></dd>
                                        <dt><?= __('Status') ?>:</dt> <dd><?= h($role->status)?'Enabled':'Disabled' ?></dd>
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