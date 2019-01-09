<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lectures Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Grades
 *
 * @method \App\Model\Entity\Lecture get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lecture newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Lecture[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lecture|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lecture patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lecture[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lecture findOrCreate($search, callable $callback = null)
 */
class LecturesTable extends Table
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

        $this->table('lectures');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Grades', [
            'foreignKey' => 'grade_id',
            'joinType' => 'INNER'
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
            ->requirePresence('lecture_name', 'create')
            ->notEmpty('lecture_name');

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
        $rules->add($rules->existsIn(['grade_id'], 'Grades'));

        return $rules;
    }
}
