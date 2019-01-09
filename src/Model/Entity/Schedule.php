<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Schedule Entity
 *
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property string $lecture
 * @property string $memo
 * @property string $image_pass
 * @property \Cake\I18n\Time $notification_date
 * @property bool $public_flag
 *
 * @property \App\Model\Entity\User $user
 */
class Schedule extends Entity
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
