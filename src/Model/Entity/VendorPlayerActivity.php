<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VendorPlayerActivity Entity
 *
 * @property int $id
 * @property int $vendor_player_id
 * @property int $vendor_action_id
 * @property int $vendor_badge_id
 * @property int $vendor_level_id
 * @property int $points
 * @property string $feed_text
 * @property string $meta_data
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $is_deleted
 *
 * @property \App\Model\Entity\VendorPlayer $vendor_player
 * @property \App\Model\Entity\VendorAction $vendor_action
 * @property \App\Model\Entity\VendorBadge $vendor_badge
 * @property \App\Model\Entity\VendorLevel $vendor_level
 */
class VendorPlayerActivity extends Entity
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
