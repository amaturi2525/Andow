<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;
use App\Controller\AppController;

/**
 * Schedules Controller
 *
 * @property \App\Model\Table\SchedulesTable $Schedules
 */
class SchedulesController extends AppController
{    
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $schedules = $this->paginate($this->Schedules);
        
        $id = $this->Auth->user('id');
        $user_schedules = TableRegistry::get("Schedules")
                ->find('all')
                ->where('Schedules.user_id = ' . $id)
                ->toArray();

        $this->set(compact('user_schedules'));
        $this->set('_serialize', ['user_schedules']);
    }
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $schedule = $this->Schedules->newEntity();
        if ($this->request->is('post')) {
            $schedule = $this->Schedules->patchEntity($schedule, $this->request->data);
            $schedule->user_id = $this->Auth->user('id');
            if ($this->Schedules->save($schedule)) {
                $this->Flash->success(__('予定を登録しました。'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('予定の登録に失敗しました。'));
            }
        }

        // ログインしたユーザの講義群
        // [講義ID => 講義名]
        $lectures = TableRegistry::get("Lectures")
                ->find('all')
                ->where("Lectures.grade_id = " .
                $this->request->session()->read("Auth.User.group_id"));
        $lectures_array = [];
        foreach ($lectures as $lecture) {
            $lectures_array[$lecture["lecture_name"]] = $lecture["lecture_name"];
        }

        $users = $this->Schedules->Users->find('list', ['limit' => 200]);
        $this->set(compact('schedule', 'users', 'lectures_array'));
        $this->set('_serialize', ['schedule']);
    }

    
    public function search()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $schedules = $this->paginate($this->Schedules);
        $id = $this->Auth->user('id');
        $user_schedules = TableRegistry::get("Schedules")
                ->find('all')->contain("Users")
                ->where('Schedules.user_id <> ' . $id)
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
        
        $this->set(compact('schedules', 'user_schedules',
                        'user', 'universities_array', 'faculties_per_univ', 'departments_per_faculty', 'grades_per_department', 'lectures_per_grade'
        ));
        $this->set('_serialize', ['schedules']);
    }
            
    public function view($id = null)
    {
        $schedule = $this->Schedules->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $schedule = $this->Schedules->patchEntity($schedule, $this->request->data);
            $schedule->user_id = $this->Auth->user('id');
            if ($this->Schedules->save($schedule)) {
                $this->Flash->success(__('予定を登録しました。'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('予定の登録に失敗しました。'));
            }
        }
        $users = $this->Schedules->Users->find('list', ['limit' => 200]);
        $this->set(compact('schedule', 'users'));
        $this->set('_serialize', ['schedule']);

        // ログインしたユーザの講義群
        // [講義ID => 講義名]
        $lectures = TableRegistry::get("Lectures")
                ->find('all')
                ->where("Lectures.grade_id = " .
                $this->request->session()->read("Auth.User.group_id"));
        $lectures_array = [];
        foreach ($lectures as $lecture) {
            $lectures_array[$lecture["lecture_name"]] = $lecture["lecture_name"];
        }

        $users = $this->Schedules->Users->find('list', ['limit' => 200]);
        $this->set(compact('schedule', 'users', 'lectures_array'));
        $this->set('_serialize', ['schedule']);     
    }
    
    
    
    public function otherview($id = null)
    {
        $schedule = $this->Schedules->newEntity();
        $other_schedule = $this->Schedules->get($id, [
            'contain' => []
        ]);        
        
        if ($this->request->is(['post', 'put'])) {
            $schedule = $this->Schedules->patchEntity($schedule, $this->request->data);
            $schedule->user_id = $this->Auth->user('id');
            //$schedule->lecture = $other_schedule->lecture;
            if($schedule->image_pass==NULL){
                $schedule->image_pass = $other_schedule->image_pass;
            }
            if ($this->Schedules->save($schedule)) {
                $this->Flash->success(__('予定を登録しました。'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('予定の登録に失敗しました。'));
            }
        }

        // ログインしたユーザの講義群
        // [講義ID => 講義名]
        $lectures = TableRegistry::get("Lectures")
                ->find('all')
                ->where("Lectures.grade_id = " .
                $this->request->session()->read("Auth.User.group_id"));
        $lectures_array = [];
        foreach ($lectures as $lecture) {
            $lectures_array[$lecture["lecture_name"]] = $lecture["lecture_name"];
        }

        $users = $this->Schedules->Users->find('list', ['limit' => 200]);
        $this->set(compact('other_schedule', 'users', 'lectures_array'));
        $this->set('_serialize', ['schedule']);     
    }
    
    

    public function delete($id) {
        $this->request->allowMethod(['post', 'delete']);
        $schedule = $this->Schedules->get($id);
        if ($this->Schedules->delete($schedule)) {
            $this->Flash->success(__('削除は完了しました。'));
        } else {
            $this->Flash->error(__('削除に失敗しました。'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
}
