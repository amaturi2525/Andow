<a href="#panel" class="ui-btn ui-icon-bars ui-btn-icon-left">課題レビュー検索</a>
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
               <?php 
               if($user->paid_service_day!=0||$user->ｆree_service_num!=0){
               foreach ($Task as $task):
                $count=0;
                $sum=0;
                $ave=0;
                foreach ($evals as $eval):
                if($eval->review_id==$task->id){
                $count++;
                $sum+=$eval->score;
                   }
                endforeach;
                if($count!=0){
                $ave=$sum/$count;
                 } 
                if($ave<1){$star='';}
                if($ave>=1&&$ave<2){$star='☆';}
                if($ave>=2&&$ave<3){$star='☆☆';}
                if($ave>=3&&$ave<4){$star='☆☆☆';}
                if($ave>=4&&$ave<5){$star='☆☆☆☆';}
                if($ave==5){$star='☆☆☆☆☆';}
                ?>
                
                if($(this).children(':selected').text() ==="<?= h($task->lecture) ?>"){ 
                $('table#tb-test2 tbody').append('<tr><td><?= $this->Html->link(__($task->name), ['action' => 'view', $task->id],['rel'=>'external']) ?></td><td><?= h($task->lecture) ?></td><td><?= h($count) ?></td><td><?= h($star) ?></td><td><?= h($task->created_at) ?></td></tr>');
                 }
               <?php endforeach;} 
               else{
               foreach ($Task as $task):
                $count=0;
                $sum=0;
                $ave=0;
                foreach ($evals as $eval):
                if($eval->review_id==$task->id){
                $count++;
                $sum+=$eval->score;
                   }
                endforeach;
                if($count!=0){
                $ave=$sum/$count;
                 } 
                if($ave<1){$star='';}
                if($ave>=1&&$ave<2){$star='☆';}
                if($ave>=2&&$ave<3){$star='☆☆';}
                if($ave>=3&&$ave<4){$star='☆☆☆';}
                if($ave>=4&&$ave<5){$star='☆☆☆☆';}
               if($ave==5){$star='☆☆☆☆☆';}
                ?>
                
                if($(this).children(':selected').text() ==="<?= h($task->lecture) ?>"){ 
                $('table#tb-test2 tbody').append('<tr><td><?=  h($task->name) ?></td><td><?= h($task->lecture) ?></td><td><?= h($count) ?></td><td><?= h($star) ?></td><td><?= h($task->created_at) ?></td></tr>');
            }
               <?php
               endforeach;}
               ?>
               
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
            <th scope="col">講義名</th>
            <th scope="col">評価数</th>
            <th scope="col">平均評価</th>
            <th scope="col">登録日</th>
            
            
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
