<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\VendorPlayerActionCount $vendorPlayerActionCount
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Vendor Player Action Count'), ['action' => 'edit', $vendorPlayerActionCount->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vendor Player Action Count'), ['action' => 'delete', $vendorPlayerActionCount->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vendorPlayerActionCount->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Vendor Player Action Counts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vendor Player Action Count'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vendor Players'), ['controller' => 'VendorPlayers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vendor Player'), ['controller' => 'VendorPlayers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vendor Actions'), ['controller' => 'VendorActions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vendor Action'), ['controller' => 'VendorActions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="vendorPlayerActionCounts view large-9 medium-8 columns content">
    <h3><?= h($vendorPlayerActionCount->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Vendor Player') ?></th>
            <td><?= $vendorPlayerActionCount->has('vendor_player') ? $this->Html->link($vendorPlayerActionCount->vendor_player->id, ['controller' => 'VendorPlayers', 'action' => 'view', $vendorPlayerActionCount->vendor_player->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vendor Action') ?></th>
            <td><?= $vendorPlayerActionCount->has('vendor_action') ? $this->Html->link($vendorPlayerActionCount->vendor_action->id, ['controller' => 'VendorActions', 'action' => 'view', $vendorPlayerActionCount->vendor_action->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($vendorPlayerActionCount->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Activity Count') ?></th>
            <td><?= $this->Number->format($vendorPlayerActionCount->activity_count) ?></td>
        </tr>
    </table>
</div>
