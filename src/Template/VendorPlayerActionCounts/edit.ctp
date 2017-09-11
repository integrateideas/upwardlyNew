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
                ['action' => 'delete', $vendorPlayerActionCount->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $vendorPlayerActionCount->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Vendor Player Action Counts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Vendor Players'), ['controller' => 'VendorPlayers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendor Player'), ['controller' => 'VendorPlayers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vendor Actions'), ['controller' => 'VendorActions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendor Action'), ['controller' => 'VendorActions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vendorPlayerActionCounts form large-9 medium-8 columns content">
    <?= $this->Form->create($vendorPlayerActionCount) ?>
    <fieldset>
        <legend><?= __('Edit Vendor Player Action Count') ?></legend>
        <?php
            echo $this->Form->control('vendor_player_id', ['options' => $vendorPlayers]);
            echo $this->Form->control('vendor_action_id', ['options' => $vendorActions]);
            echo $this->Form->control('activity_count');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
