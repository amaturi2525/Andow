<?php

namespace App\Controller;

use App\Controller\AppController;

use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['logout', 'add']);

    }
    
   public function login() {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $id=$this->Auth->user('id');
                $persons = TableRegistry::get("Users")
                ->find('all')
                ->where('users.id = ' . $id)
                ->toArray();
                
                if($persons[0]->malicious_user_flag==0){
                //echo "<pre>";var_dump($this->redirect($this->Auth->redirectUrl()));echo "</pre>";exit();
                return $this->redirect(['controller' => 'Schedules','action' => 'index']);
            }
            else{
                $this->Flash->error('このアカウントは停止されています。');
            }
                }
            else{
            $this->Flash->error('IDまたはパスワードが不正です');}
        }
        $user = $this->Users->newEntity();
        $this->set(compact('user'));
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Grades']
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
    
    
    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $user = $this->Users->get($id, [
            'contain' => ['Grades', 'Reports', 'ReviewEvals', 'Schedules', 'Taskreview', 'Taskreviews']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    public function add() {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user->point =0;
            $user = $this->Users->patchEntity($user, $this->request->data);

            if ($this->Users->save($user)) {
                $this->Flash->success(__('登録が完了しました。'));
                $this->Auth->setUser($user);
                return $this->redirect(['controller' => 'Schedules', 'action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }

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

        $this->set(compact(
                        'user', 'universities_array', 'faculties_per_univ', 'departments_per_faculty', 'grades_per_department'
        ));
        $this->set('_serialize', ['user']);
    }

    public function edit($id = null) {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $grades = $this->Users->Grades->find('list', ['limit' => 200]);
        $this->set(compact('user', 'grades'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    
    public function mypage(){
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        $userData = $connection
                ->newQuery()
                ->select('*')
                ->from('users')
                ->where((['id'=>$this->Auth->user('id')]))
                ->execute()
                ->fetchAll('assoc');
        $userData = array_shift($userData);
        
        $list_univ =$connection
                ->newQuery()
                ->select('*')
                ->from('universities')
                ->execute()
                ->fetchAll('assoc');
        $list_department =$connection
                ->newQuery()
                ->select('*')
                ->from('departments')
                ->execute()
                ->fetchAll('assoc');
        $list_faculty= $connection
                ->newQuery()
                ->select('*')
                ->from('faculties')
                ->execute()
                ->fetchAll('assoc');
        $list_grade =$connection
                ->newQuery()
                ->select('*')
                ->from('grades')
                ->execute()
                ->fetchAll('assoc');
       
        $user = $userData['username'];
        $user_id = $userData['id'];
        $email = $userData['email'];
        $group_id = intval($userData['group_id']);
        $point= intval($userData['point']);
        $days_left = intval($userData['paid_service_day']);
       
        
        //taken from senpai
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
                ->where('Faculties.univ_id = '.$id)
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
                    ->where('Departments.faculty_id = '.$id)
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
                    ->where('Grades.department_id = '.$id)
                    ->toArray();
                $grades_per_department[$id] = [];
                foreach ($grades as $grade) {
                    $grades_per_department[$id][$grade["id"]] = $grade["grade"];
                }
            }
        }

        $this->set(compact(
            'user',
            'universities_array',
            'faculties_per_univ',
            'departments_per_faculty',
            'grades_per_department'
        ));
        //fin taken from sempai
        
        $grade = TableRegistry::get("Grades")
                    ->find('all')
                    ->where('Grades.id = '.$group_id)
                    ->toArray()[0];
       
        $department = TableRegistry::get("Departments")
                    ->find('all')
                    ->where('Departments.id = '.$grade['department_id'])
                    ->toArray()[0];
        $faculty = TableRegistry::get("Faculties")
                    ->find('all')
                    ->where('Faculties.id = '.$department['faculty_id'])
                    ->toArray()[0];
        $university = TableRegistry::get("Universities")
                    ->find('all')
                    ->where('Universities.id = '.$faculty['univ_id'])
                    ->toArray()[0];
        
        $this->set(compact(
            'user',
            'email',
            'user_id',
            'grade',
            'department',
            'faculty',
            'university',
            'point',
            'days_left',
            'list_univ',
            'list_department',
            'list_faculty',
            'list_grade'
        ));
        
    }
    
    
    public function delete($id,$flag)
    {
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        $default_id = 1;
        if($flag == "1")
        {
            $connection->update('taskreviews',['user_id'=>$default_id],['user_id'=>$this->Auth->user('id')]);
            $connection->delete('schedules',['user_id'=>$id]);
            $connection->delete('users',['id'=>$id]);
        }
        else 
        {
            $connection->delete('taskreviews',['user_id'=>$id]);
            $connection->delete('schedules',['user_id'=>$id]);
            $connection->delete('users',['id'=>$id]);
        }
        
        $this->Flash->success('アカウントを停止しました。');
        return $this->redirect($this->Auth->logout());        
        
    }

    
    public function addMoney()
    {
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        $daysLeft = $connection
                ->newQuery()
                ->select('paid_service_day')
                ->from('users')
                ->where((['id'=>$this->Auth->user('id')]))
                ->execute()
                ->fetchAll('assoc');
        /*
        echo "<pre>";
        var_dump($daysLeft);
        echo "</pre>";
        exit();
       */
        $daysLeft = array_shift($daysLeft);
        $daysLeft = intval($daysLeft['paid_service_day']) + 30;
        $connection->update('users',['paid_service_day'=>$daysLeft],['id'=>$this->Auth->user('id')]);
        $this->Flash->success('課金しました');
        return $this->redirect(['controller'=>'Users','action'=>'mypage']);
        
    }
    
    public function exchangePoints()
    {
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        $userData = $connection
                ->newQuery()
                ->select('*')
                ->from('users')
                ->where((['id'=>$this->Auth->user('id')]))
                ->execute()
                ->fetchAll('assoc');
        $userData = array_shift($userData);
        $point = intval($userData['point']);
        $daysLeft = intval($userData['paid_service_day']);
        if($point >= 10)
        {
            $daysLeft += 30;
            $point -= 10;
            $connection->update('users',['paid_service_day'=>$daysLeft],['id'=>$this->Auth->user('id')]);
            $connection->update('users',['point'=>$point],['id'=>$this->Auth->user('id')]);
            $this->Flash->success('ポイント交換しました');
            return $this->redirect(['controller'=>'Users','action'=>'mypage']);
        }
        else
        {
            $this->Flash->error('ポイント交換できませんでした');
            return $this->redirect(['controller'=>'Users','action'=>'mypage']);
        }
    }
    
    public function update()
    {
        $user = $this->Users->get($this->Auth->user('id'), [
            'contain' => []
        ]);
        if($this->request->is('post'))
        {
            if (empty($this->request->data["password"])) {
                unset($this->request->data["password"]);
            }
            if (strcmp($this->request->data["group_id"],"-1")==0) {
                unset($this->request->data["group_id"]);
            }
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('User info saved'));
                return $this->redirect(['action'=>'mypage']);
            } else {
                $this->Flash->error(__('User info not saved'));
                  return $this->redirect(['action'=>'mypage']);
            }
        }   
        return $this->redirect(['action'=>'mypage']);
    }
}
