<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReviewEvals Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Reviews
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\ReviewEval get($primaryKey, $options = [])
 * @method \App\Model\Entity\ReviewEval newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ReviewEval[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ReviewEval|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReviewEval patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ReviewEval[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ReviewEval findOrCreate($search, callable $callback = null)
 */
class ReviewEvalsTable extends Table
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

        $this->table('review_evals');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Reviews', [
            'foreignKey' => 'review_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->integer('score')
            ->requirePresence('score', 'create')
            ->notEmpty('score');

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
        $rules->add($rules->existsIn(['review_id'], 'Reviews'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
