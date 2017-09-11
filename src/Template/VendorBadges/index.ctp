<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\VendorBadge[]|\Cake\Collection\CollectionInterface $vendorBadges
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
                        <th scope="col"><?= $this->Paginator->sort('badge_name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('points') ?></th>
                        <th scope="col">Frequency</th>
                        <th scope="col"><?= $this->Paginator->sort('image_name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($vendorBadges as $vendorBadge): ?>
                    <tr>
                        <td><?= $this->Number->format($vendorBadge->id) ?></td>
                        <td><?= $vendorBadge->has('vendor') ? $this->Html->link($vendorBadge->vendor->org_name, ['controller' => 'Vendors', 'action' => 'view', $vendorBadge->vendor->id]) : '' ?></td>
                        <td><?= h($vendorBadge->name) ?></td>
                        <td><?= $this->Number->format($vendorBadge->points) ?></td>
                        <td>
                            <?= h($vendorBadge->vendor_badge_actions[0]->frequency) ?>
                        </td>
                        <td><?= $this->Html->image($vendorBadge->image_url, array('height' => 100, 'width' => 100,'id'=>'upload-img')); ?></td>

                        <td><?= h($vendorBadge->status) ?></td>
                        <td class="actions">
                            <?= '<a href='.$this->Url->build(['action' => 'view', $vendorBadge->id]).' class="btn btn-xs btn-success">' ?>
                                <i class="fa fa-eye fa-fw"></i>
                            </a>
                            <?= '<a href='.$this->Url->build(['action' => 'edit', $vendorBadge->id]).' class="btn btn-xs btn-warning"">' ?>
                                <i class="fa fa-pencil fa-fw"></i>
                            </a>
                            <?= $this->Form->postLink(__(''), ['action' => 'delete', $vendorBadge->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vendorBadge->id), 'class' => ['btn', 'btn-sm', 'btn-danger', 'fa', 'fa-trash-o', 'fa-fh']]) ?>
                        
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
