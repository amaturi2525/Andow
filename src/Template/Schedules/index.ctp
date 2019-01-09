

     <a href="#panel" class="ui-btn ui-icon-bars ui-btn-icon-left">予定一覧</a>

    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col">名前</th>
                <th scope="col">講義</th>
                <th scope="col">通知</th>
                <th scope="col">日時</th>
                <th scope="col">削除</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($user_schedules as $schedule): ?>
            <tr>
                <td><?= $this->Html->link(__($schedule->name), ['action' => 'view', $schedule->id], ['rel'=>'external']) ?></td>
                <td><?= h($schedule->lecture) ?></td>
                <td>
                <?php
                    $today = date("Y-m-d H:i");
                    if(strtotime($today) === strtotime($schedule->notification_date)){
                      echo "まもなく";
                    }else if(strtotime($today) > strtotime($schedule->notification_date)){
                      echo "済";
                    }else{
                      echo '<FONT color="red">未</FONT>';
                    }
                ?>
               </td>
               <td><?= h($schedule->notification_date->i18nFormat('yyyy/MM/dd')) ?><br>
                   <?= h($schedule->notification_date->i18nFormat('HH:mm')) ?>
               </td>
               <td> <?= $this->Form->postLink(__('×'), ['action' => 'delete', $schedule->id], ['confirm' => __('{0}を削除してもよろしいですか？', $schedule->name)]) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

