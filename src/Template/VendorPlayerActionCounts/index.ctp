<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\VendorPlayerActionCount[]|\Cake\Collection\CollectionInterface $vendorPlayerActionCounts
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Vendor Player Action Count'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vendor Players'), ['controller' => 'VendorPlayers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendor Player'), ['controller' => 'VendorPlayers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vendor Actions'), ['controller' => 'VendorActions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendor Action'), ['controller' => 'VendorActions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vendorPlayerActionCounts index large-9 medium-8 columns content">
    <h3><?= __('Vendor Player Action Counts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('vendor_player_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('vendor_action_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('activity_count') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vendorPlayerActionCounts as $vendorPlayerActionCount): ?>
            <tr>
                <td><?= $this->Number->format($vendorPlayerActionCount->id) ?></td>
                <td><?= $vendorPlayerActionCount->has('vendor_player') ? $this->Html->link($vendorPlayerActionCount->vendor_player->id, ['controller' => 'VendorPlayers', 'action' => 'view', $vendorPlayerActionCount->vendor_player->id]) : '' ?></td>
                <td><?= $vendorPlayerActionCount->has('vendor_action') ? $this->Html->link($vendorPlayerActionCount->vendor_action->id, ['controller' => 'VendorActions', 'action' => 'view', $vendorPlayerActionCount->vendor_action->id]) : '' ?></td>
                <td><?= $this->Number->format($vendorPlayerActionCount->activity_count) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $vendorPlayerActionCount->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $vendorPlayerActionCount->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $vendorPlayerActionCount->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vendorPlayerActionCount->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
