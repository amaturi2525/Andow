<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
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
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->input('username');
            echo $this->Form->input('email');
            echo $this->Form->input('password');
            echo $this->Form->input('group_id', ['options' => $grades]);
            echo $this->Form->input('point');
            echo $this->Form->input('high_eval_review_num');
            echo $this->Form->input('penalty_review_num');
            echo $this->Form->input('ｆree_service_num');
            echo $this->Form->input('paid_service_day');
            echo $this->Form->input('malicious_user_flag');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
