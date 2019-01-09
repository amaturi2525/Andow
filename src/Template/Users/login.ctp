<div class="logins">
<h3 class="foo">
    <span class="letter" data-letter="A">A</span>
    <span class="letter" data-letter="n">n</span>
    <span class="letter" data-letter="d">d</span>
    <span class="letter" data-letter="o">o</span>
    <span class="letter" data-letter="w">w</span>
</h3>

<div class="login-container-wrapper">
    <?= $this->Form->create($user, ['class' => 'login-container','data-ajax' => 'false']) ?>
    <?= $this->Form->input('username', [
        'label' => 'ログインID :',
        ]) ?>
    <?= $this->Form->input('password', [
        'label' => 'パスワード :',
        ]) ?>
    <div class="login-container-footer">
        <div class="login-container-footer-content">
            <?= $this->Html->link('新規登録', ['action' => 'add'],['rel'=>'external']) ?>
        </div>
        <div class="login-container-footer-content">
            <?= $this->Form->button('ログイン') ?>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>
</div>

