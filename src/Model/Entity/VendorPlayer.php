<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VendorPlayer Entity
 *
 * @property int $id
 * @property int $player_id
 * @property int $vendor_id
 * @property string $ref_code
 * @property float $points
 * @property int $vendor_level_id
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $is_deleted
 *
 * @property \App\Model\Entity\Player $player
 * @property \App\Model\Entity\Vendor $vendor
 * @property \App\Model\Entity\VendorLevel $vendor_level
 * @property \App\Model\Entity\VendorPlayerActionCount[] $vendor_player_action_counts
 * @property \App\Model\Entity\VendorPlayerActivity[] $vendor_player_activities
 * @property \App\Model\Entity\VendorPlayerBadgeActivity[] $vendor_player_badge_activities
 * @property \App\Model\Entity\VendorPlayerBadge[] $vendor_player_badges
 */
class VendorPlayer extends Entity
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
