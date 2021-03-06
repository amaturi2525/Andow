<?php
    $this->Html->css([
        'lib/jquery-ui.min.css',
        'lib/jquery-ui.theme.min.css',
        'lib/jquery-ui.structure.min.css',
        'lib/jquery.datetimepicker.css',
    ], ['block' => true]);
    $this->Html->script([
        'lib/jquery.datetimepicker.full.js'
    ], ['block' => true]);
?>

<script>
    $(function () {
        $('#datetimepicker').datetimepicker({
        minDate: new Date(),
        step:30
        });
        $('#datetimepicker').datetimepicker({
        setDate: new Date()
        });
    });
</script>

<?= $this->element('formContainerTemplate') ?>
<a href="#panel" class="ui-btn ui-icon-bars ui-btn-icon-left">他人予定詳細</a>
<?= $this->Form->create($other_schedule,['type' => 'file','data-ajax' => 'false','class'=>'form-container add-schedule','onsubmit'=>'return confirm("登録しますか？")']) ?>



<fieldset>
    <legend ><?= __('Other View&Edit Schedule') ?></legend>
    <?= $this->Html->image($other_schedule->image_pass,['style'=>'width:100%']) ?>
    <div class="form-container-fields add-schedule ">
        <?php
            echo $this->Form->input('lecture',[
                'options' => $lectures_array,
                'label' => '講義名 : '
            ]);
            echo $this->Form->input('name', [
                'label' => '課題名 : ',
                'placeholder' => '例）レポート#1',
            ]);
            echo $this->Form->input('memo',[
                'type'=>'textarea',
                'label' => '通知内容 : ',
                'placeholder' => '通知メモ',
            ]);
        ?> 
        <div class="form-container-field">
            <div class="form-container-field-column">
                <label for="img">
                <div class="form-container-field-column-label-img">＋画像を追加する</div>
                <span id="file_name"></span>
                <input type="file" id="img" name="img" style="display:none;" onchange="$('#file_name').text($(this).val())">
                </label>
            </div>
        </div>
        
        <div class="form-container-field">
            <div class="form-container-field-column">
                <label class="form-container-field-column-label" >通知日時 : </label>
                <input class="form-container-field-column-input" name="notification_date" type="text" maxlength="255" id="datetimepicker" value="<?= date('Y/m/d G:i',strtotime($other_schedule->notification_date)) ?>" /> 
            </div>
        </div>
        
        <?php
            echo $this->Form->input('public_flag',[
                'label' => '他者への公開を許可']);
        ?>
        
    </div>
</fieldset>
<div class="form-container-footer">
    <?= $this->Form->button("自分の予定に登録") ?>
</div>