
<?php
    // セレクトボックスが未選択であることを示す値
    $NO_SELECTED = -1;
?>
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
    <?= $this->Form->create($user,['data-ajax' => 'false']) ?>
    <fieldset>
        <legend style="background-color:lightcyan;"><?= __('Add User') ?></legend>
        <?php
/*
            echo "<pre>";
            var_dump($universities_array);
            echo "</pre>";
            exit();
*/
            echo $this->Form->input('username', [
                'label' => 'ログインID : ']);
            echo $this->Form->input('email', [
                'label' => '通知アドレス : ']);
            echo $this->Form->input('password', [
                'label' => 'パスワード : ']);
            echo $this->Form->input('univ_id', [
                'options' => [$NO_SELECTED => "▼選択してください"] + $universities_array,
                'id'=>'university',
                'label' => '大学 : '
            ]);
            echo $this->Form->input('faculty_id', [
                'options' => [$NO_SELECTED => "▼選択してください"],
                'id'=>'faculty',
                'label' => '学部 : '
            ]);
            echo $this->Form->input('department_id', [
                'options' => [$NO_SELECTED => "▼選択してください"],
                'id' => 'department',
                'label' => '学科 : '
            ]);
            echo $this->Form->input('group_id', [
                'options' => [$NO_SELECTED => "▼選択してください"],
                'id' => 'grade',
                'label' => '学年 : '
            ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('登録')) ?>
<?= $this->Form->end() ?>
