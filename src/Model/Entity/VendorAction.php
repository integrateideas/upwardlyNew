<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VendorAction Entity
 *
 * @property int $id
 * @property int $action_id
 * @property string $custom_action_name
 * @property int $vendor_id
 * @property int $points
 * @property string $image_path
 * @property string $image_name
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $label
 *
 * @property \App\Model\Entity\Action $action
 * @property \App\Model\Entity\Vendor $vendor
 * @property \App\Model\Entity\VendorBadgeAction[] $vendor_badge_actions
 * @property \App\Model\Entity\VendorPlayerActionCount[] $vendor_player_action_counts
 * @property \App\Model\Entity\VendorPlayerActivity[] $vendor_player_activities
 * @property \App\Model\Entity\VendorPlayerBadgeActivity[] $vendor_player_badge_activities
 */
class VendorAction extends Entity
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
