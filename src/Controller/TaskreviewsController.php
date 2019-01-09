<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use DateTime;
use Cake\ORM\TableRegistry;

/**
 * Description of Plan
 *
 * @author pei-PC2
 */
class TaskreviewsController extends AppController {

    public function add() {
        $Task = TableRegistry::get("Taskreviews")
                ->find('all')
                ->toArray();
        $Task = $this->Taskreviews->newEntity();

        if ($this->request->is('post')) {
            $Task = $this->Taskreviews->patchEntity($Task, $this->request->data);
            $Task->user_id = $this->Auth->user('id');
           $Task->created_at= new DateTime();

            if ($this->Taskreviews->save($Task)) {
                $this->Flash->success(__('登録しました.'));
               return $this->redirect(['controller' => 'Taskreviews', 'action' => 'add']);
            } else {
                $this->Flash->error(__('登録できませんでした.'));
            }
        }

        // ログインしたユーザの講義群
        // [講義ID => 講義名]
        $lectures = TableRegistry::get("Lectures")
                ->find('all')
                ->where("Lectures.grade_id = " . $this->request->session()->read("Auth.User.group_id"));
        $lectures_array = [];
        foreach ($lectures as $lecture) {
            $lectures_array[$lecture["lecture_name"]] = $lecture["lecture_name"];
        }

        $users = $this->Taskreviews->Users->find('list', ['limit' => 200]);
        $this->set(compact('Task', 'users', 'lectures_array'));
        $this->set('_serialize', ['Task']);
    }

    public function search() {
        $this->paginate = [
            'contain' => ['Users']
        ];

        $taskreview = $this->paginate($this->Taskreviews);
        $id = $this->Auth->user('id');
        $report = TableRegistry::get("reports")
                ->find('all')
                ->toArray();

        $task = TableRegistry::get("Taskreviews")
                ->find('all')
                ->where('Taskreviews.user_id <> ' . $id)
                ->toArray();
  
  $users= TableRegistry::get("Users")
                ->find('all')
                ->where('users.id = ' . $id)
                ->toArray();
$b=0;
$a=0;
$count3=0;
$Task = [];
while($b<sizeof($task)){
    $a=0;
    $flag=0;
    while($a<sizeof($report)){
        if($task[$b]->id==$report[$a]->review_id){
            $flag+=1;
        }    
        $a++;
    }
    if($flag<3){
        $Task[$count3] = $task[$b];
        $count3++;
    }
    $b++;
}

      $evals = TableRegistry::get("review_evals")
                ->find('all')
                ->toArray();
     
        // 大学取得
        // [大学ID => 大学名]
        $universities = TableRegistry::get("Universities")
                ->find('all')
                ->toArray();
        $universities_array = [];
        foreach ($universities as $university) {
            $universities_array[$university["id"]] = $university["univ_name"];
        }

        // 学部取得
        // [大学ID => [学部ID => 学部名]]
        $faculties_per_univ = [];
        foreach ($universities_array as $id => $name) {
            $faculties = TableRegistry::get("Faculties")
                    ->find('all')
                    ->where('Faculties.univ_id = ' . $id)
                    ->toArray();
            $faculties_per_univ[$id] = [];
            foreach ($faculties as $faculty) {
                $faculties_per_univ[$id][$faculty["id"]] = $faculty["faculty_name"];
            }
        }

        // 学科取得
        // [学部ID => [学科ID => 学科名]]
        $departments_per_faculty = [];
        foreach ($faculties_per_univ as $faculty) {
            foreach ($faculty as $id => $name) {
                $departments = TableRegistry::get("Departments")
                        ->find('all')
                        ->where('Departments.faculty_id = ' . $id)
                        ->toArray();
                $departments_per_faculty[$id] = [];
                foreach ($departments as $department) {
                    $departments_per_faculty[$id][$department["id"]] = $department["department_name"];
                }
            }
        }

        // 学年取得
        // [学科ID => [学年ID => 学年]]
        $grades_per_department = [];
        foreach ($departments_per_faculty as $department) {
            foreach ($department as $id => $name) {
                $grades = TableRegistry::get("Grades")
                        ->find('all')
                        ->where('Grades.department_id = ' . $id)
                        ->toArray();
                $grades_per_department[$id] = [];
                foreach ($grades as $grade) {
                    $grades_per_department[$id][$grade["id"]] = $grade["grade"];
                }
            }
        }

        // 講義名取得
        // [学年ID => [講義ID => 講義名]]
        $lectures_per_grade = [];
        foreach ($grades_per_department as $grade) {
            foreach ($grade as $id => $name) {
                $lectures = TableRegistry::get("Lectures")
                        ->find('all')
                        ->where('Lectures.grade_id = ' . $id)
                        ->toArray();
                $lectures_per_grade[$id] = [];
                foreach ($lectures as $lecture) {
                    $lectures_per_grade[$id][$lecture["id"]] = $lecture["lecture_name"];
                }
            }
        }
$user=$users[0];
        $this->set(compact('Task', 'user', 'report','evals', 'universities_array', 'faculties_per_univ', 'departments_per_faculty', 'grades_per_department', 'lectures_per_grade'));
        $this->set('_serialize', ['Task']);
    }

    public function view($id = null) {
        $my_id = $this->Auth->user('id');
        $im=TableRegistry::get("users")
                ->find('all')
                ->where('users.id = ' . $my_id)
                ->toArray();
        $connection = \Cake\Datasource\ConnectionManager::get('default');
            $connection->update('users', ['ｆree_service_num' => 0], ['id' => $my_id]);
        $Task = $this->Taskreviews->get($id, [
            'contain' => ['Users']
        ]);
       $this->loadModel('review_evals');
       $eval= $this->review_evals->newEntity();
        if ($this->request->is('post')) {
      
           $eval= $this->review_evals->patchEntity($eval, $this->request->data);
          
            
               return $this->redirect(['action' => 'evalsadd', $Task->id,$eval->score]);
            
            }
            
 $users = TableRegistry::get("users")
                ->find('all')
                ->where('users.id = ' . $Task->user_id)
                ->toArray();
 $user=$users[0];
        
$this->set(compact('Task', 'user','eval'));
        $this->set('_serialize', ['Task']);
    }


     public function report($id = null) {
        $task = TableRegistry::get("Taskreviews")
                ->find('all')
                ->where('Taskreviews.id = ' . $id)
                ->toArray();
        $reports = TableRegistry::get("reports")
                ->find('all')
                ->where('reports.review_id = ' . $id)
                ->toArray();
        $my_id = $this->Auth->user('id');
        
        $flag=0;
        foreach($reports as $report):
            if($report->user_id==$my_id){
                $flag=1;
                break;
            }
        endforeach;
        
        if($flag==0){
            $this->Flash->success(__('通報しました'));
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        $connection->insert('reports', [
            'review_id' => $task[0]->id,
            'user_id' => $my_id, 'report' => 0]);
        }
        else{
             $this->Flash->error(__('すでに通報済みです'));
        }
        return $this->redirect(['action' => 'search']);
    }

    public function evalsadd($id = null, $score = null) {

        $this->loadModel('review_evals');
        $evals = TableRegistry::get("review_evals")
                ->find('all')
                ->where('review_evals.review_id = ' . $id)
                ->toArray();
         $my_id = $this->Auth->user('id');
         $task = TableRegistry::get("Taskreviews")
                ->find('all')
                ->where('Taskreviews.id = ' . $id)
                ->toArray();
        $my_id = $this->Auth->user('id');
        $point=(int)$score;
        
        $flag=0;
        foreach($evals as $eval):
            if($eval->user_id==$my_id){
                $flag=1;
                break;
            }
        endforeach;
               
         if($flag==0){
        $connection1 = \Cake\Datasource\ConnectionManager::get('default');
        $connection1->insert('review_evals', [
            'review_id' => $task[0]->id,
            'user_id' => $my_id, 'score' => $point]);
       
         }
      
        
        if (sizeof($evals)%3==0) {
            return $this->redirect(['action' => 'pointadd', $id]);
       }
        return $this->redirect(['action' => 'search']);
    }

    public function pointadd($id = null) {

        $tasks = TableRegistry::get("Taskreviews")
                ->find('all')
                ->where('Taskreviews.id = ' . $id)
                ->toArray();
        $task=$tasks[0];
        $user_id = $task->user_id;
        $this->loadModel('users');
        $users = TableRegistry::get("users")
                ->find('all')
                ->where('users.id = ' . $user_id)
                ->toArray();
        $person=$users[0];
        $person->point += 1;
         $connection = \Cake\Datasource\ConnectionManager::get('default');
            $connection->update('users', ['point' => $person->point], ['id' => $person->id]);
         return $this->redirect(['action' => 'search']);
    }

    

}
