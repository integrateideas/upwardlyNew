<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Vendor Player Activities'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Vendor Players'), ['controller' => 'VendorPlayers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendor Player'), ['controller' => 'VendorPlayers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vendor Actions'), ['controller' => 'VendorActions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendor Action'), ['controller' => 'VendorActions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vendor Badges'), ['controller' => 'VendorBadges', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendor Badge'), ['controller' => 'VendorBadges', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vendor Levels'), ['controller' => 'VendorLevels', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendor Level'), ['controller' => 'VendorLevels', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vendorPlayerActivities form large-9 medium-8 columns content">
    <?= $this->Form->create($vendorPlayerActivity) ?>
    <fieldset>
        <legend><?= __('Add Vendor Player Activity') ?></legend>
        <?php
            echo $this->Form->control('vendor_player_id', ['options' => $vendorPlayers]);
            echo $this->Form->control('vendor_action_id', ['options' => $vendorActions, 'empty' => true]);
            echo $this->Form->control('vendor_badge_id', ['options' => $vendorBadges, 'empty' => true]);
            echo $this->Form->control('vendor_level_id', ['options' => $vendorLevels, 'empty' => true]);
            echo $this->Form->control('points');
            echo $this->Form->control('feed_text');
            echo $this->Form->control('meta_data');
            echo $this->Form->control('status');
            echo $this->Form->control('is_deleted', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
