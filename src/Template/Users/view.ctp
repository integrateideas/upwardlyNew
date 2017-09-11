<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User $user
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
                                            <span class="label label-success"><?= h($user->vendor->org_name) ?></span>
                                        </dd>
                                    </dl> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <dl class="dl-horizontal">
                                        <dt><?= __('Role') ?>:</dt> <dd><?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></dd>
                                        <dt><?= __('Name') ?>:</dt> <dd> <?= h($user->first_name) ?> <?= h($user->last_name) ?></dd>
                                        <dt><?= __('Username') ?>:</dt> <dd> <?= h($user->username) ?> </dd>
                                        <dt><?= __('Email') ?>:</dt> <dd> <?= h($user->email) ?> </dd>
                                        <dt><?= __('Phone') ?>:</dt> <dd> <?= h($user->phone) ?> </dd>
                                        <dt><?= __('Created') ?>:</dt> <dd> <?= h($user->created) ?> </dd>
                                        <dt><?= __('Modified') ?>:</dt> <dd><?= h($user->modified) ?></dd>
                                        <dt><?= __('Status') ?>:</dt> <dd><?= h($user->status)?'Enabled':'Disabled' ?></dd>
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