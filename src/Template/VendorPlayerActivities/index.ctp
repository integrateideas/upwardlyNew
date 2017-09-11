<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\VendorPlayerActivity[]|\Cake\Collection\CollectionInterface $vendorPlayerActivities
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Vendor Player Activity'), ['action' => 'add']) ?></li>
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
<div class="vendorPlayerActivities index large-9 medium-8 columns content">
    <h3><?= __('Vendor Player Activities') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('vendor_player_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('vendor_action_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('vendor_badge_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('vendor_level_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('points') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vendorPlayerActivities as $vendorPlayerActivity): ?>
            <tr>
                <td><?= $this->Number->format($vendorPlayerActivity->id) ?></td>
                <td><?= $vendorPlayerActivity->has('vendor_player') ? $this->Html->link($vendorPlayerActivity->vendor_player->id, ['controller' => 'VendorPlayers', 'action' => 'view', $vendorPlayerActivity->vendor_player->id]) : '' ?></td>
                <td><?= $vendorPlayerActivity->has('vendor_action') ? $this->Html->link($vendorPlayerActivity->vendor_action->id, ['controller' => 'VendorActions', 'action' => 'view', $vendorPlayerActivity->vendor_action->id]) : '' ?></td>
                <td><?= $vendorPlayerActivity->has('vendor_badge') ? $this->Html->link($vendorPlayerActivity->vendor_badge->name, ['controller' => 'VendorBadges', 'action' => 'view', $vendorPlayerActivity->vendor_badge->id]) : '' ?></td>
                <td><?= $vendorPlayerActivity->has('vendor_level') ? $this->Html->link($vendorPlayerActivity->vendor_level->id, ['controller' => 'VendorLevels', 'action' => 'view', $vendorPlayerActivity->vendor_level->id]) : '' ?></td>
                <td><?= $this->Number->format($vendorPlayerActivity->points) ?></td>
                <td><?= $this->Number->format($vendorPlayerActivity->status) ?></td>
                <td><?= h($vendorPlayerActivity->created) ?></td>
                <td><?= h($vendorPlayerActivity->modified) ?></td>
                <td><?= h($vendorPlayerActivity->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $vendorPlayerActivity->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $vendorPlayerActivity->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $vendorPlayerActivity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vendorPlayerActivity->id)]) ?>
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
