<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\VendorPlayerActivity $vendorPlayerActivity
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Vendor Player Activity'), ['action' => 'edit', $vendorPlayerActivity->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vendor Player Activity'), ['action' => 'delete', $vendorPlayerActivity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vendorPlayerActivity->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Vendor Player Activities'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vendor Player Activity'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vendor Players'), ['controller' => 'VendorPlayers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vendor Player'), ['controller' => 'VendorPlayers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vendor Actions'), ['controller' => 'VendorActions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vendor Action'), ['controller' => 'VendorActions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vendor Badges'), ['controller' => 'VendorBadges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vendor Badge'), ['controller' => 'VendorBadges', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vendor Levels'), ['controller' => 'VendorLevels', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vendor Level'), ['controller' => 'VendorLevels', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="vendorPlayerActivities view large-9 medium-8 columns content">
    <h3><?= h($vendorPlayerActivity->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Vendor Player') ?></th>
            <td><?= $vendorPlayerActivity->has('vendor_player') ? $this->Html->link($vendorPlayerActivity->vendor_player->id, ['controller' => 'VendorPlayers', 'action' => 'view', $vendorPlayerActivity->vendor_player->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vendor Action') ?></th>
            <td><?= $vendorPlayerActivity->has('vendor_action') ? $this->Html->link($vendorPlayerActivity->vendor_action->id, ['controller' => 'VendorActions', 'action' => 'view', $vendorPlayerActivity->vendor_action->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vendor Badge') ?></th>
            <td><?= $vendorPlayerActivity->has('vendor_badge') ? $this->Html->link($vendorPlayerActivity->vendor_badge->name, ['controller' => 'VendorBadges', 'action' => 'view', $vendorPlayerActivity->vendor_badge->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vendor Level') ?></th>
            <td><?= $vendorPlayerActivity->has('vendor_level') ? $this->Html->link($vendorPlayerActivity->vendor_level->id, ['controller' => 'VendorLevels', 'action' => 'view', $vendorPlayerActivity->vendor_level->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($vendorPlayerActivity->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Points') ?></th>
            <td><?= $this->Number->format($vendorPlayerActivity->points) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($vendorPlayerActivity->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($vendorPlayerActivity->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($vendorPlayerActivity->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($vendorPlayerActivity->is_deleted) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Feed Text') ?></h4>
        <?= $this->Text->autoParagraph(h($vendorPlayerActivity->feed_text)); ?>
    </div>
    <div class="row">
        <h4><?= __('Meta Data') ?></h4>
        <?= $this->Text->autoParagraph(h($vendorPlayerActivity->meta_data)); ?>
    </div>
</div>
