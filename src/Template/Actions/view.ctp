<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Action $action
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Action'), ['action' => 'edit', $action->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Action'), ['action' => 'delete', $action->id], ['confirm' => __('Are you sure you want to delete # {0}?', $action->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Actions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Action'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vendor Actions'), ['controller' => 'VendorActions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vendor Action'), ['controller' => 'VendorActions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="actions view large-9 medium-8 columns content">
    <h3><?= h($action->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($action->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($action->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($action->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($action->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Vendor Actions') ?></h4>
        <?php if (!empty($action->vendor_actions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Action Id') ?></th>
                <th scope="col"><?= __('Custom Action Name') ?></th>
                <th scope="col"><?= __('Vendor Id') ?></th>
                <th scope="col"><?= __('Points') ?></th>
                <th scope="col"><?= __('Image Path') ?></th>
                <th scope="col"><?= __('Image Name') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Label') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($action->vendor_actions as $vendorActions): ?>
            <tr>
                <td><?= h($vendorActions->id) ?></td>
                <td><?= h($vendorActions->action_id) ?></td>
                <td><?= h($vendorActions->custom_action_name) ?></td>
                <td><?= h($vendorActions->vendor_id) ?></td>
                <td><?= h($vendorActions->points) ?></td>
                <td><?= h($vendorActions->image_path) ?></td>
                <td><?= h($vendorActions->image_name) ?></td>
                <td><?= h($vendorActions->created) ?></td>
                <td><?= h($vendorActions->modified) ?></td>
                <td><?= h($vendorActions->label) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'VendorActions', 'action' => 'view', $vendorActions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'VendorActions', 'action' => 'edit', $vendorActions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'VendorActions', 'action' => 'delete', $vendorActions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vendorActions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
