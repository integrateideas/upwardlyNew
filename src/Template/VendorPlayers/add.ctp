<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Vendor Players'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Players'), ['controller' => 'Players', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Player'), ['controller' => 'Players', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vendors'), ['controller' => 'Vendors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendor'), ['controller' => 'Vendors', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vendor Levels'), ['controller' => 'VendorLevels', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendor Level'), ['controller' => 'VendorLevels', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vendor Player Action Counts'), ['controller' => 'VendorPlayerActionCounts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendor Player Action Count'), ['controller' => 'VendorPlayerActionCounts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vendor Player Activities'), ['controller' => 'VendorPlayerActivities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendor Player Activity'), ['controller' => 'VendorPlayerActivities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vendor Player Badge Activities'), ['controller' => 'VendorPlayerBadgeActivities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendor Player Badge Activity'), ['controller' => 'VendorPlayerBadgeActivities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vendor Player Badges'), ['controller' => 'VendorPlayerBadges', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendor Player Badge'), ['controller' => 'VendorPlayerBadges', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vendorPlayers form large-9 medium-8 columns content">
    <?= $this->Form->create($vendorPlayer) ?>
    <fieldset>
        <legend><?= __('Add Vendor Player') ?></legend>
        <?php
            echo $this->Form->control('player_id', ['options' => $players]);
            echo $this->Form->control('vendor_id', ['options' => $vendors]);
            echo $this->Form->control('ref_code');
            echo $this->Form->control('points');
            echo $this->Form->control('vendor_level_id', ['options' => $vendorLevels, 'empty' => true]);
            echo $this->Form->control('status');
            echo $this->Form->control('is_deleted', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
