<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\VendorPlayer[]|\Cake\Collection\CollectionInterface $vendorPlayers
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
                        <th scope="col"><?= $this->Paginator->sort('player_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('vendor_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('points') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('vendor_level_id') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($vendorPlayers as $vendorPlayer): ?>
                        <tr>
                            <td><?= $this->Number->format($vendorPlayer->id) ?></td>
                            <td><?= $vendorPlayer['player']->first_name." ".$vendorPlayer['player']->last_name ?></td>
                            <td><?= $vendorPlayer->has('vendor') ? $this->Html->link($vendorPlayer->vendor->org_name, ['controller' => 'Vendors', 'action' => 'view', $vendorPlayer->vendor->id]) : '' ?></td>
                            <td><?= $this->Number->format($vendorPlayer->points) ?></td>
                            <td><?= $vendorPlayer->has('vendor_level') ? $this->Html->link($vendorPlayer['vendor_level']->level_name, ['controller' => 'VendorLevels', 'action' => 'view', $vendorPlayer->vendor_level->id]) : '' ?></td>
                            <td class="actions">
                                <?= '<a href='.$this->Url->build(['action' => 'view', $vendorPlayer->id]).' class="btn btn-xs btn-success">' ?>
                                <i class="fa fa-eye fa-fw"></i>
                            </a>
                            <?php /* <?= '<a href='.$this->Url->build(['action' => 'edit', $vendorPlayer->id]).' class="btn btn-xs btn-warning"">' ?>
                                <i class="fa fa-pencil fa-fw"></i>
                            </a>
                            <?= $this->Form->postLink(__(''), ['action' => 'delete', $vendorPlayer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vendorPlayer->id), 'class' => ['btn', 'btn-sm', 'btn-danger', 'fa', 'fa-trash-o', 'fa-fh']]) ?> */?>
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

            </div>
        </div>
    </div>
</div>