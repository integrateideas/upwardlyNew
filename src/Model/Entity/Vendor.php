<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Routing\Router;

/**
 * Vendor Entity
 *
 * @property int $id
 * @property string $org_name
 * @property string $image_path
 * @property string $image_name
 * @property bool $status
 * @property string $client_identifier
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $is_deleted
 *
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\VendorAction[] $vendor_actions
 * @property \App\Model\Entity\VendorBadge[] $vendor_badges
 * @property \App\Model\Entity\VendorDomain[] $vendor_domains
 * @property \App\Model\Entity\VendorLevel[] $vendor_levels
 * @property \App\Model\Entity\VendorPlayer[] $vendor_players
 */
class Vendor extends Entity
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
            $url = Router::url('/vendors_images/'.$this->_properties['image_name'],true);
        }else{
            $url = Router::url('/img/default-img.jpeg',true);
        }
        return $url;

    }
}
