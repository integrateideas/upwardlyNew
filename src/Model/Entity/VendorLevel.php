<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Routing\Router;
/**
 * VendorLevel Entity
 *
 * @property int $id
 * @property int $vendor_id
 * @property string $level_name
 * @property int $level_rank
 * @property string $image_path
 * @property string $image_name
 * @property int $points
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $is_deleted
 * @property string $description
 *
 * @property \App\Model\Entity\Vendor $vendor
 * @property \App\Model\Entity\VendorPlayerActivity[] $vendor_player_activities
 * @property \App\Model\Entity\VendorPlayer[] $vendor_players
 */
class VendorLevel extends Entity
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

    protected $_virtual = ['image_url'];
    protected function _getImageUrl()
    {
        if(isset($this->_properties['image_name']) && !empty($this->_properties['image_name'])) {
            $url = Router::url('/vendor_levels_images/'.$this->_properties['image_name'],true);
        }else{
            $url = Router::url('/img/default-img.jpeg',true);
        }
        return $url;

    }
}
