<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Grades'), ['controller' => 'Grades', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Grade'), ['controller' => 'Grades', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Reports'), ['controller' => 'Reports', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Report'), ['controller' => 'Reports', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Review Evals'), ['controller' => 'ReviewEvals', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Review Eval'), ['controller' => 'ReviewEvals', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Schedules'), ['controller' => 'Schedules', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Schedule'), ['controller' => 'Schedules', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Taskreview'), ['controller' => 'Taskreview', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Taskreview'), ['controller' => 'Taskreview', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Taskreviews'), ['controller' => 'Taskreviews', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Taskreview'), ['controller' => 'Taskreviews', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Grade') ?></th>
            <td><?= $user->has('grade') ? $this->Html->link($user->grade->id, ['controller' => 'Grades', 'action' => 'view', $user->grade->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Point') ?></th>
            <td><?= $this->Number->format($user->point) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('High Eval Review Num') ?></th>
            <td><?= $this->Number->format($user->high_eval_review_num) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Penalty Review Num') ?></th>
            <td><?= $this->Number->format($user->penalty_review_num) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ｆree Service Num') ?></th>
            <td><?= $this->Number->format($user->ｆree_service_num) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Paid Service Day') ?></th>
            <td><?= $this->Number->format($user->paid_service_day) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Malicious User Flag') ?></th>
            <td><?= $user->malicious_user_flag ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Reports') ?></h4>
        <?php if (!empty($user->reports)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Review Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->reports as $reports): ?>
            <tr>
                <td><?= h($reports->id) ?></td>
                <td><?= h($reports->review_id) ?></td>
                <td><?= h($reports->user_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Reports', 'action' => 'view', $reports->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Reports', 'action' => 'edit', $reports->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Reports', 'action' => 'delete', $reports->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reports->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Review Evals') ?></h4>
        <?php if (!empty($user->review_evals)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Review Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Score') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->review_evals as $reviewEvals): ?>
            <tr>
                <td><?= h($reviewEvals->id) ?></td>
                <td><?= h($reviewEvals->review_id) ?></td>
                <td><?= h($reviewEvals->user_id) ?></td>
                <td><?= h($reviewEvals->score) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ReviewEvals', 'action' => 'view', $reviewEvals->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ReviewEvals', 'action' => 'edit', $reviewEvals->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ReviewEvals', 'action' => 'delete', $reviewEvals->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reviewEvals->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Schedules') ?></h4>
        <?php if (!empty($user->schedules)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Lecture') ?></th>
                <th scope="col"><?= __('Memo') ?></th>
                <th scope="col"><?= __('Image Pass') ?></th>
                <th scope="col"><?= __('Notification Date') ?></th>
                <th scope="col"><?= __('Public Flag') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->schedules as $schedules): ?>
            <tr>
                <td><?= h($schedules->id) ?></td>
                <td><?= h($schedules->name) ?></td>
                <td><?= h($schedules->user_id) ?></td>
                <td><?= h($schedules->lecture) ?></td>
                <td><?= h($schedules->memo) ?></td>
                <td><?= h($schedules->image_pass) ?></td>
                <td><?= h($schedules->notification_date) ?></td>
                <td><?= h($schedules->public_flag) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Schedules', 'action' => 'view', $schedules->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Schedules', 'action' => 'edit', $schedules->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Schedules', 'action' => 'delete', $schedules->id], ['confirm' => __('Are you sure you want to delete # {0}?', $schedules->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Taskreview') ?></h4>
        <?php if (!empty($user->taskreview)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Lecture') ?></th>
                <th scope="col"><?= __('Took Time') ?></th>
                <th scope="col"><?= __('Difficulty') ?></th>
                <th scope="col"><?= __('Advice') ?></th>
                <th scope="col"><?= __('Image Pass') ?></th>
                <th scope="col"><?= __('Created At') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->taskreview as $taskreview): ?>
            <tr>
                <td><?= h($taskreview->id) ?></td>
                <td><?= h($taskreview->name) ?></td>
                <td><?= h($taskreview->user_id) ?></td>
                <td><?= h($taskreview->lecture) ?></td>
                <td><?= h($taskreview->took_time) ?></td>
                <td><?= h($taskreview->difficulty) ?></td>
                <td><?= h($taskreview->advice) ?></td>
                <td><?= h($taskreview->image_pass) ?></td>
                <td><?= h($taskreview->created_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Taskreview', 'action' => 'view', $taskreview->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Taskreview', 'action' => 'edit', $taskreview->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Taskreview', 'action' => 'delete', $taskreview->id], ['confirm' => __('Are you sure you want to delete # {0}?', $taskreview->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Taskreviews') ?></h4>
        <?php if (!empty($user->taskreviews)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Lecture') ?></th>
                <th scope="col"><?= __('Took Time') ?></th>
                <th scope="col"><?= __('Difficulty') ?></th>
                <th scope="col"><?= __('Advice') ?></th>
                <th scope="col"><?= __('Image Pass') ?></th>
                <th scope="col"><?= __('Created At') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->taskreviews as $taskreviews): ?>
            <tr>
                <td><?= h($taskreviews->id) ?></td>
                <td><?= h($taskreviews->name) ?></td>
                <td><?= h($taskreviews->user_id) ?></td>
                <td><?= h($taskreviews->lecture) ?></td>
                <td><?= h($taskreviews->took_time) ?></td>
                <td><?= h($taskreviews->difficulty) ?></td>
                <td><?= h($taskreviews->advice) ?></td>
                <td><?= h($taskreviews->image_pass) ?></td>
                <td><?= h($taskreviews->created_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Taskreviews', 'action' => 'view', $taskreviews->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Taskreviews', 'action' => 'edit', $taskreviews->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Taskreviews', 'action' => 'delete', $taskreviews->id], ['confirm' => __('Are you sure you want to delete # {0}?', $taskreviews->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
