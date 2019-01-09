<?= $this->element('formContainerTemplate') ?>


    <a href="#panel" class="ui-btn ui-icon-bars ui-btn-icon-left">課題レビュー詳細</a>
<?= $this->Form->postLink(__('通報'), ['action' => 'report', $Task->id], ['confirm' => __('{0}を通報してもよろしいですか？', $Task->name)]) ?>
 <?= $this->Form->create($eval,['type' => 'file','data-ajax' => 'false']) ?>
   <div class="schedules view large-9 medium-8 columns content">
    <h3><?= h($Task->name) ?></h3>
 <fieldset>
<?=$this->Html->image($Task->image_pass,['style'=>'width:100%']) ?>
    <table class="vertical-table">
        
    <?php
    
    ?>
        <tr>
            <th scope="row"><?= __('ユーザーID') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('講義名') ?></th>
            <td><?= h($Task->lecture) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('アドバイス') ?></th>
            <td><?= h($Task->advice) ?></td>
        </tr>
       
        
       
          <?php 
          if($Task->difficulty==1){$difficult="簡単";}
          if($Task->difficulty==2){$difficult="普通";}
          if($Task->difficulty==3){$difficult="難しい";}
          if($Task->difficulty==4){$difficult="ものすごく難しい";}
          if($Task->took_time==1){$time="0~1時間";}
          if($Task->took_time==2){$time="1~2時間";}  
          if($Task->took_time==3){$time="2~3時間";}
          if($Task->took_time==4){$time="3~4時間";}
          if($Task->took_time==5){$time="4時間以上";}
          ?>
       <tr>
            <th scope="row"><?= __('作業時間') ?></th>
            <td><?= h($time) ?></td>
        </tr>
    <tr>
            <th scope="row"><?= __('難易度') ?></th>
            <td><?= h($difficult) ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('課題レビュー作成日') ?></th>
            <td><?= h($Task->created_at) ?></td>
        </tr>
        <tr>
           <td>評価</td>
           
           <td> 
        <select name="score"> 
              <option value="1">☆</option>
              <option value="2">☆☆</option>
              <option value="3">☆☆☆</option>
              <option value="4">☆☆☆☆</option>
              <option value="5">☆☆☆☆☆</option>
          </select>
           </td>
        </tr>
    </table>
 </fieldset>


<?= $this->Form->button(__('評価して戻る')) ?>
    
</div>
