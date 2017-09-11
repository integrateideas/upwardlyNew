<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $vendorLevel->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $vendorLevel->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Vendor Levels'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Vendors'), ['controller' => 'Vendors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendor'), ['controller' => 'Vendors', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vendor Player Activities'), ['controller' => 'VendorPlayerActivities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendor Player Activity'), ['controller' => 'VendorPlayerActivities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vendor Players'), ['controller' => 'VendorPlayers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendor Player'), ['controller' => 'VendorPlayers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vendorLevels form large-9 medium-8 columns content">
    <?= $this->Form->create($vendorLevel) ?>
    <fieldset>
        <legend><?= __('Edit Vendor Level') ?></legend>
        <?php
            echo $this->Form->control('vendor_id', ['options' => $vendors]);
            echo $this->Form->control('level_name');
            echo $this->Form->control('level_rank');
            echo $this->Form->control('image_path');
            echo $this->Form->control('image_name');
            echo $this->Form->control('points');
            echo $this->Form->control('status');
            echo $this->Form->control('is_deleted', ['empty' => true]);
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
