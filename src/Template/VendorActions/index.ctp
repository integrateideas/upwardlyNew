<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\VendorAction[]|\Cake\Collection\CollectionInterface $vendorActions
  */
?>
<div class="row">
    <div class="col-lg-12">
        <div class="hpanel">
            <div class="panel-body">
                <div class="table-responsive">
                <table cellpadding="1" cellspacing="1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('vendor_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('action_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('custom_action_name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('points') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($vendorActions as $vendorAction): ?>
                        <tr>
                            <td><?= $this->Number->format($vendorAction->id) ?></td>
                            <td><?= $vendorAction->has('vendor') ? $this->Html->link($vendorAction->vendor->org_name, ['controller' => 'Vendors', 'action' => 'view', $vendorAction->vendor->id]) : '' ?></td>
                            <td><?= $vendorAction->has('action') ? $this->Html->link($vendorAction->action->name, ['controller' => 'Actions', 'action' => 'view', $vendorAction->action->id]) : '' ?></td>
                            <td><?= h($vendorAction->custom_action_name) ? h($vendorAction->custom_action_name) : '...' ?></td>
                            

                            <td><?= $this->Number->format($vendorAction->points) ?></td>
                            <td class="actions">
                            <?= '<a href='.$this->Url->build(['action' => 'view', $vendorAction->id]).' class="btn btn-xs btn-success">' ?>
                                <i class="fa fa-eye fa-fw"></i>
                            </a>
                            <?= '<a href='.$this->Url->build(['action' => 'edit', $vendorAction->id]).' class="btn btn-xs btn-warning"">' ?>
                                <i class="fa fa-pencil fa-fw"></i>
                            </a>
                            <?= $this->Form->postLink(__(''), ['action' => 'delete', $vendorAction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vendorAction->id), 'class' => ['btn', 'btn-sm', 'btn-danger', 'fa', 'fa-trash-o', 'fa-fh']]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                    <!-- <div class="paginator">
                    <ul class="pagination">
                    <?= $this->Paginator->first('<< ' . __('first')) ?>
                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('next') . ' >') ?>
                    <?= $this->Paginator->last(__('last') . ' >>') ?>
                    </ul>
                    <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
                    </div> -->
                </div>

            </div>
        </div>
    </div>
</div>
