<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Grades'), ['controller' => 'Grades', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Grade'), ['controller' => 'Grades', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Reports'), ['controller' => 'Reports', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Report'), ['controller' => 'Reports', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Review Evals'), ['controller' => 'ReviewEvals', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Review Eval'), ['controller' => 'ReviewEvals', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Schedules'), ['controller' => 'Schedules', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Schedule'), ['controller' => 'Schedules', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Taskreview'), ['controller' => 'Taskreview', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Taskreview'), ['controller' => 'Taskreview', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Taskreviews'), ['controller' => 'Taskreviews', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Taskreview'), ['controller' => 'Taskreviews', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Users') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('username') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('password') ?></th>
                <th scope="col"><?= $this->Paginator->sort('group_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('point') ?></th>
                <th scope="col"><?= $this->Paginator->sort('high_eval_review_num') ?></th>
                <th scope="col"><?= $this->Paginator->sort('penalty_review_num') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ｆree_service_num') ?></th>
                <th scope="col"><?= $this->Paginator->sort('paid_service_day') ?></th>
                <th scope="col"><?= $this->Paginator->sort('malicious_user_flag') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Number->format($user->id) ?></td>
                <td><?= h($user->username) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->password) ?></td>
                <td><?= $user->has('grade') ? $this->Html->link($user->grade->id, ['controller' => 'Grades', 'action' => 'view', $user->grade->id]) : '' ?></td>
                <td><?= $this->Number->format($user->point) ?></td>
                <td><?= $this->Number->format($user->high_eval_review_num) ?></td>
                <td><?= $this->Number->format($user->penalty_review_num) ?></td>
                <td><?= $this->Number->format($user->ｆree_service_num) ?></td>
                <td><?= $this->Number->format($user->paid_service_day) ?></td>
                <td><?= h($user->malicious_user_flag) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
