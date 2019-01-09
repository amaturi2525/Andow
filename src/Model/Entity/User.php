<?php
namespace App\Model\Entity;
use Cake\Auth\DefaultPasswordHasher; 
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property int $group_id
 * @property int $point
 * @property int $high_eval_review_num
 * @property int $penalty_review_num
 * @property int $ｆree_service_num
 * @property int $paid_service_day
 * @property bool $malicious_user_flag
 *
 * @property \App\Model\Entity\Grade $grade
 * @property \App\Model\Entity\Report[] $reports
 * @property \App\Model\Entity\ReviewEval[] $review_evals
 * @property \App\Model\Entity\Schedule[] $schedules
 * @property \App\Model\Entity\Taskreview[] $taskreview
 * @property \App\Model\Entity\Taskreview[] $taskreviews
 */
class User extends Entity
{

    protected function _setPassword($value) {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($value);
    }
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
