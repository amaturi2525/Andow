<?= $this->element('formContainerTemplate') ?>

<a href="#panel" class="ui-btn ui-icon-bars ui-btn-icon-left">課題レビュー作成</a>


    <?= $this->Form->create($Task,['type' => 'file','data-ajax' => 'false']) ?>
    <fieldset>
    
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('lecture',[
            'options' => $lectures_array
            ]);
            echo $this->Form->input('advice');
            echo $this->Form->input('img', ['type' => 'file']);
       
            ?>
          <select name="difficulty"> 
              <option value="1">簡単</option>
              <option value="2">普通</option>
              <option value="3">難しい</option>
              <option value="4">ものすごく難しい</option>
          </select>
          <select name="took_time"> 
              <option value="1">0~1時間</option>
              <option value="2">1~2時間</option>
              <option value="3">2~3時間</option>
              <option value="4">3~4時間</option>
              <option value="5">4時間以上</option>
          </select>
    </fieldset>
    <?= $this->Form->button(__('登録')) ?>
    <?= $this->Form->end() ?>

