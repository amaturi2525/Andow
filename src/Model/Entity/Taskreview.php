<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Taskreview Entity
 *
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property string $lecture
 * @property string $took_time
 * @property string $difficulty
 * @property string $advice
 * @property string $image_pass
 * @property \Cake\I18n\Time $created_at
 *
 * @property \App\Model\Entity\User $user
 */
class Taskreview extends Entity
{

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
}
