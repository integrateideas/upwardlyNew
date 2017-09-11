<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VendorPlayerActionCount Entity
 *
 * @property int $id
 * @property int $vendor_player_id
 * @property int $vendor_action_id
 * @property int $activity_count
 *
 * @property \App\Model\Entity\VendorPlayer $vendor_player
 * @property \App\Model\Entity\VendorAction $vendor_action
 */
class VendorPlayerActionCount extends Entity
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
