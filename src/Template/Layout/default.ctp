
<!DOCTYPE html>
<html>
    <head>
    <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
        <?= $this->fetch('title') ?>
        </title>
    <?= $this->Html->meta('icon') ?>
        <!--    
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
        -->

    <?= $this->Html->script([
        'lib/jquery.js',
        'lib/jquery-ui.min.js',
        'lib/bootstrap.min.js',
        ]) ?>



    <?= $this->Html->css([
        'main.css',
        'main_self',
        'lib/bootstrap.min.css'
        ]) ?>

   <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.css" />
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js"></script> 
    <script src="https://use.fontawesome.com/b98e9ca7cf.js"></script>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <script>
    $(function(){
    var topBtn=$('#pageTop');

    // ◇ボタンをクリックしたら、スクロールして上に戻る
    topBtn.click(function(){
    $('body,html').animate({
    scrollTop: 0},500);
    return false;
    });
    });
    </script>

    </head>
    <body>
        <div class="container clearfix">
        <div data-role="page"> 
        <div id="panel" data-role="panel" >
            <h3>ページ選択</h3>
                <ul data-role="listview" data-inset="true">
                    <li><?= $this->Html->link(__('予定一覧'), ['controller'=>'Schedules','action' => 'index'],['rel'=>'external']) ?></li>
                    <li><?= $this->Html->link(__('予定登録'), ['controller'=>'Schedules','action' => 'add'], ['rel'=>'external']) ?></li>
                    <li><?= $this->Html->link(__('予定検索'), ['controller'=>'Schedules','action' => 'search'], ['rel'=>'external']) ?></li>
                    <li><?= $this->Html->link(__('課題レビュー作成'), ['controller'=>'Taskreviews','action' => 'add'], ['rel'=>'external']) ?></li>
                    <li><?= $this->Html->link(__('課題レビュー検索'), ['controller'=>'Taskreviews','action' => 'search'], ['rel'=>'external']) ?></li>
                    <li><?= $this->Html->link(__('マイページ'),  ['controller'=>'Users','action' => 'mypage'], ['rel'=>'external']) ?></li>
                </ul>
            <p><a href="#" data-rel="close" class="ui-btn ui-corner-all ui-icon-delete ui-btn-icon-left">閉じる</a></p>
        </div>
  
        <div class="ui-content">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
        <p id="pageTop"><a href="#"><i class="fa fa-chevron-up"></i></a></p>
        </div>
        </div>
        </div>
      

       
    </body>
</html>
