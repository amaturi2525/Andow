<a href="#panel" class="ui-btn ui-icon-bars ui-btn-icon-left">予定検索</a>
<?php
    // セレクトボックスが未選択であることを示す値
    $NO_SELECTED = -1;
?>
<script>
    (function () {
        // セレクトボックスが未選択であることを示すグローバル変数
        // グローバル変数は使用したくないが，マジックナンバーをなくすために仕方なく
        var NO_SELECTED = <?= $NO_SELECTED ?>;

        /**
         * セレクトボックスを更新する
         * @param id 更新するセレクトボックスの id
         * @param contents 新しいセレクトボックスの値(連想配列)
         */
        function updateSelectBox(id, contents) {
            $("select#" + id).empty();
            $("select#" + id).append(
                    $("<option></option>")
                    .attr("value", NO_SELECTED)
                    .text("▼選択してください"));
            $.each(contents, function (key, value) {
                $("select#" + id).append(
                        $("<option></option>")
                        .attr("value", key)
                        .text(value));
            });
            $("select#" + id).selectmenu('refresh', true);
        }

        /**
         * セレクトボックスの内容をリセットする
         * 「▼選択してください」という文言のみの状態にリセットする
         * @param id リセットするセレクトボックスの id
         */
        function resetSelectBox(id) {
            $("select#" + id).empty();
            $("select#" + id).append(
                    $("<option></option>")
                    .attr("value", NO_SELECTED)
                    .text("▼選択してください"));
            $("select#" + id).selectmenu('refresh', true);
        }

        $(document).ready(function () {
            var universities = <?= json_encode($universities_array) ?>;
            var faculties = <?= json_encode($faculties_per_univ) ?>;
            var departments = <?= json_encode($departments_per_faculty) ?>;
            var grades = <?= json_encode($grades_per_department) ?>;
            var lectures =<?= json_encode($lectures_per_grade) ?>;

            // セレクトボックスの更新
            $("select#university").change(function () {
                resetSelectBox("faculty");
                resetSelectBox("department");
                resetSelectBox("grade");
                resetSelectBox("lecture");

                if ($(this).val() != NO_SELECTED) {
                    updateSelectBox("faculty", faculties[$(this).val()])
                }
            });
            $("select#faculty").change(function () {
                resetSelectBox("department");
                resetSelectBox("grade");
                resetSelectBox("lecture");

                if ($(this).val() != NO_SELECTED) {
                    updateSelectBox("department", departments[$(this).val()])
                }
            });
            $("select#department").change(function () {
                resetSelectBox("grade");
                resetSelectBox("lecture");

                if ($(this).val() != NO_SELECTED) {
                    updateSelectBox("grade", grades[$(this).val()])
                }
            });
            $("select#grade").change(function () {
                resetSelectBox("lecture");

                if ($(this).val() != NO_SELECTED) {
                    updateSelectBox("lecture", lectures[$(this).val()])
                }
            });

            $("select#lecture").change(function () {
                $('table#tb-test2 tbody *').remove();
                if ($(this).val() != NO_SELECTED) {
                <?php foreach ($user_schedules as $schedule): 
                    if(!$schedule->public_flag){continue;}
                ?>
                
                if($(this).children(':selected').text() ==="<?= ($schedule->lecture) ?>"){ 
                $('table#tb-test2 tbody').append('<tr><td><?= $this->Html->link(($schedule->name), ['action' => 'otherview', $schedule->id], ['rel'=>'external']) ?></td><td><?=($schedule->user->username) ?></td><td><?= ($schedule->notification_date) ?></td></tr>');
                 }
                <?php endforeach; ?>
                }
            });


        });
    })();
</script>

<fieldset>
        <?php
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
            echo $this->Form->input('lecture', [
                'options' => [$NO_SELECTED => "▼選択してください"],
                'id' => 'lecture',
                'label' => '講義名 : '
            ]);
            
            
            
        ?>
</fieldset>


<table cellpadding="0" cellspacing="0" id="tb-test2">
    <thead>
        <tr>
            <th scope="col">課題名</th>
            <th scope="col">作成者</th>
            <th scope="col">通知日時</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
