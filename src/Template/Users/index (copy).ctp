<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
  */
?>
<div class="content animate-panel">
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-heading">
                    
                </div>
                <div class="panel-body">
                    <table cellpadding="1" cellspacing="1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('vendor_id') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('role_id') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('username') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $this->Number->format($user->id) ?></td>
                                <td><?= $user->has('vendor') ? $this->Html->link($user->vendor->org_name, ['controller' => 'Vendors', 'action' => 'view', $user->vendor->id]) : '' ?></td>
                                <td><?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
                                <td><?= h($user->first_name)." ".h($user->last_name) ?></td>
                                <td><?= h($user->username) ?></td>
                                <td><?= h($user->email) ?></td>
                                <td><?= h($user->phone) ?></td>
                                <td><?= h($user->status) ?></td>
                                <td class="actions">
                                <?= '<a href='.$this->Url->build(['action' => 'view', $user->id]).' class="btn btn-xs btn-success">' ?>
                                    <i class="fa fa-eye fa-fw"></i>
                                </a>
                                <?= '<a href='.$this->Url->build(['action' => 'edit', $user->id]).' class="btn btn-xs btn-warning"">' ?>
                                    <i class="fa fa-pencil fa-fw"></i>
                                </a>
                                <?= $this->Form->postLink(__(''), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => ['btn', 'btn-sm', 'btn-danger', 'fa', 'fa-trash-o', 'fa-fh']]) ?>
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