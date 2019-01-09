<?php
    // セレクトボックスが未選択であることを示す値
    $NO_SELECTED = -1;
?>
<?= $this->element('formContainerTemplate') ?>
<a href="#panel" class="ui-btn ui-icon-bars ui-btn-icon-left">マイページ</a>
<!--<form method="post" action="/Andow/users/update " accept-charset="utf-8" type-ajax="false" >-->
<?= $this->Form->create($this,['type' => 'file','data-ajax' => 'false','action'=>'update']) ?>
    <br>
    <p>
        <?php 
            $this->Form->templates([
                'inputContainer' => '{{content}}'
            ]);
        ?>
        
        <p> <?php 
            echo $this->Form->input('username',['value'=>$user,'label'=>'ID:']); 
        ?></p>
        <p> <?php  echo $this->Form->input('email',['value'=>$email,'label'=>'通知メールアドレス:']); ?></p>
        
                <?= $this->Form->input('password', [
            'value' => "",
            'placeholder' => '新しいパスワードを入力',
            'required' => false,
            'label' => 'パスワード : ',
            ]) ?>
        
        <div><h3>大学: <span class="label label-primary"><?php echo $university['univ_name'];?> </span></h3>
            <?php
            echo $this->Form->input('univ_id', [
                'options' => [$NO_SELECTED => "▼選択してください"] + $universities_array,
                'id'=>'university',
                'label'=>FALSE
            ]);
            ?>
        </div>
        <div><h3>学部: <span class="label label-primary"><?php echo $faculty['faculty_name'];?> </span></h3>
        <?php
            echo $this->Form->input('faculty_id', [
                'options' => [$NO_SELECTED => "▼選択してください"],
                'id'=>'faculty',
                'label'=>FALSE
            ]);
            ?>
        </div>
        <div><h3>学科: <span class="label label-primary"><?php echo $department['department_name'];?> </span></h3>
        <?php
            echo $this->Form->input('department_id', [
                'options' => [$NO_SELECTED => "▼選択してください"],
                'id' => 'department',
                'label'=>FALSE
            ]);
            ?>
        </div>
        <div><h3>学年: <span class="label label-primary"><?php echo $grade['grade'];?> </span></h3>
            <?php
            echo $this->Form->input('group_id', [
                'options' => [$NO_SELECTED => "▼選択してください"],
                'id' => 'grade',
                'label'=>FALSE
            ]);
            ?>
        </div>
        <p><h3>レビュー自由閲覧日数: <span class="label label-primary"><?php echo $days_left;?> </span></h3></p>
        <p><h3>ポイント: <span class="label label-primary"><?php echo $point;?> </span></h3></p>
        
            <?= $this->Form->button("変更保存") ?>
      <!--  <input type="submit" value="変更保存" > -->
        <input id="exchangePointsAccount" type="button" value="10ポイント交換" />
        <input id="addMoneyAccount" type="button" value="課金" />
        <input id="logoutAccount" type="button" value="ログアウト" />
        <input id="stopAccount" type="button" value="アカウント停止" />
        <br><br>

      
    </p>
</form>
<script>
    document.getElementById("stopAccount").onclick = function() {confirmationDelete();};

    function confirmationDelete() 
    {
        if(confirm("do you want to delete ?"))
        {
            if(confirm("do you want to leave your reviews ?"))
            {
                location.href='/Andow/users/delete/<?php echo $user_id ?>/1';
            }
            else
            {
                location.href='/Andow/users/delete/<?php echo $user_id ?>/0';
            }
            
        }
    }
</script>
<script>
    document.getElementById("logoutAccount").onclick = function() {confirmationLogout();};

    function confirmationLogout() 
    {
        if(confirm("do you want to logout ?"))
        {
            location.href='/Andow/users/logout';
        }
    }
</script>
<script>
    document.getElementById("addMoneyAccount").onclick = function() {confirmationAdd();};

    function confirmationAdd() 
    {
        var code;
        if((code = prompt("コードを入力してください","t5AAHyVo"))!==null)
        {
            location.href='/Andow/users/add-money';
        }
        
    }
    
</script>
<script>
    document.getElementById("exchangePointsAccount").onclick = function() {confirmationPoints();};

    function confirmationPoints() 
    {
        if(confirm("do you want to Exchange points ?"))
        {
            location.href='/Andow/users/exchangePoints';
        }
    }
</script>


<script>
    (function(){
        // セレクトボックスが未選択であることを示すグローバル変数
        // グローバル変数は使用したくないが，マジックナンバーをなくすために仕方なく
        var NO_SELECTED = <?= $NO_SELECTED ?>;

        /**
         * セレクトボックスを更新する
         * @param id 更新するセレクトボックスの id
         * @param contents 新しいセレクトボックスの値(連想配列)
         */
        function updateSelectBox(id, contents) {
            $("select#"+id).empty();
            $("select#"+id).append(
                $("<option></option>")
                    .attr("value", NO_SELECTED)
                    .text("▼選択してください"));
            $.each(contents, function(key, value) {
                $("select#"+id).append(
                    $("<option></option>")
                        .attr("value", key)
                        .text(value));
            });
            $("select#"+id).selectmenu('refresh', true);
        }

        /**
         * セレクトボックスの内容をリセットする
         * 「▼選択してください」という文言のみの状態にリセットする
         * @param id リセットするセレクトボックスの id
         */
        function resetSelectBox(id) {
            $("select#"+id).empty();
            $("select#"+id).append(
                $("<option></option>")
                    .attr("value", NO_SELECTED)
                    .text("▼選択してください"));
            $("select#"+id).selectmenu('refresh', true);
        }

        $(document).ready(function () {
            var universities = <?= json_encode($universities_array) ?>;
            var faculties = <?= json_encode($faculties_per_univ) ?>;
            var departments = <?= json_encode($departments_per_faculty) ?>;
            var grades = <?= json_encode($grades_per_department) ?>;

            // セレクトボックスの更新
            $("select#university").change(function() {
                resetSelectBox("faculty");
                resetSelectBox("department");
                resetSelectBox("grade");

                if ($(this).val() != NO_SELECTED) {
                    updateSelectBox("faculty", faculties[$(this).val()])
                }
            });
            $("select#faculty").change(function() {
                resetSelectBox("department");
                resetSelectBox("grade");

                if ($(this).val() != NO_SELECTED) {
                    updateSelectBox("department", departments[$(this).val()])
                }
            });
            $("select#department").change(function() {
                resetSelectBox("grade");

                if ($(this).val() != NO_SELECTED) {
                    updateSelectBox("grade", grades[$(this).val()])
                }
            });
        });
    })();
</script>