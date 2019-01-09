<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Taskreviews Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Taskreview get($primaryKey, $options = [])
 * @method \App\Model\Entity\Taskreview newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Taskreview[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Taskreview|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Taskreview patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Taskreview[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Taskreview findOrCreate($search, callable $callback = null)
 */
class TaskreviewsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('taskreviews');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
                $this->addBehavior('Utils.Uploadable', [
            'img' => [
                'field' => 'id',
                'path' => '{ROOT}{DS}{WEBROOT}{DS}uploads{DS}{model}{DS}',
                'fileName' => '{field}.{extension}'
                , 'fields' => [
                    'url' => 'image_pass'
                ],
            ],
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('lecture', 'create')
            ->notEmpty('lecture');

        $validator
            ->requirePresence('took_time', 'create')
            ->notEmpty('took_time');

        $validator
            ->requirePresence('difficulty', 'create')
            ->notEmpty('difficulty');

        $validator
            ->allowEmpty('advice');

        $validator
            ->allowEmpty('image_pass');

        $validator
            ->dateTime('created_at')
            ->requirePresence('created_at', 'create')
            ->notEmpty('created_at');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
