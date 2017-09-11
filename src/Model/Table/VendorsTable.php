<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Model\Entity\Vendor;
use Cake\Core\Configure;

/**
 * Vendors Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\HasMany $Users
 * @property \App\Model\Table\VendorActionsTable|\Cake\ORM\Association\HasMany $VendorActions
 * @property \App\Model\Table\VendorBadgesTable|\Cake\ORM\Association\HasMany $VendorBadges
 * @property \App\Model\Table\VendorDomainsTable|\Cake\ORM\Association\HasMany $VendorDomains
 * @property \App\Model\Table\VendorLevelsTable|\Cake\ORM\Association\HasMany $VendorLevels
 * @property \App\Model\Table\VendorPlayersTable|\Cake\ORM\Association\HasMany $VendorPlayers
 *
 * @method \App\Model\Entity\Vendor get($primaryKey, $options = [])
 * @method \App\Model\Entity\Vendor newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Vendor[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Vendor|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Vendor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Vendor[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Vendor findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VendorsTable extends Table
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

        $this->setTable('vendors');
        $this->setDisplayField('org_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Users', [
            'foreignKey' => 'vendor_id'
        ]);
        $this->hasMany('VendorActions', [
            'foreignKey' => 'vendor_id'
        ]);
        $this->hasMany('VendorBadges', [
            'foreignKey' => 'vendor_id'
        ]);
        $this->hasMany('VendorDomains', [
            'foreignKey' => 'vendor_id'
        ]);
        $this->hasMany('VendorLevels', [
            'foreignKey' => 'vendor_id'
        ]);
        $this->hasMany('VendorPlayers', [
            'foreignKey' => 'vendor_id'
        ]);
        $this->addBehavior('Josegonzalez/Upload.Upload', [
          'image_name' => [
            'path' => Configure::read('ImageUpload.uploadPathForVendorImages'),
            'fields' => [
              'dir' => 'image_path'
            ],
            'nameCallback' => function ($data, $settings) {
              return time(). $data['name'];
            },
          ],
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
            ->scalar('org_name')
            ->allowEmpty('org_name');

        $validator
            ->allowEmpty('image_path');

        $validator
            ->allowEmpty('image_name');

        $validator
            ->boolean('status')
            ->allowEmpty('status');

        $validator
            ->scalar('client_identifier')
            ->requirePresence('client_identifier', 'create')
            ->notEmpty('client_identifier');

        $validator
            ->dateTime('is_deleted')
            ->allowEmpty('is_deleted');

        return $validator;
    }

    public function beforeSave( \Cake\Event\Event $event, $entity, \ArrayObject $options){
    if($entity->isNew()){
      $entity->client_identifier = $this->_cryptographicString('alnum',32);
    }
  }
  private function _cryptographicString( $type = 'alnum', $length = 8 )
  {
    switch ( $type ) {
      case 'alnum':
      $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      break;
      case 'alpha':
      $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      break;
      case 'hexdec':
      $pool = '0123456789abcdef';
      break;
      case 'numeric':
      $pool = '0123456789';
      break;
      case 'nozero':
      $pool = '123456789';
      break;
      case 'distinct':
      $pool = '2345679ACDEFHJKLMNPRSTUVWXYZ';
      break;
      default:
      $pool = (string) $type;
      break;
    }


    $crypto_rand_secure = function ( $min, $max ) {
      $range = $max - $min;
      if ( $range < 0 ) return $min; // not so random...
      $log    = log( $range, 2 );
      $bytes  = (int) ( $log / 8 ) + 1; // length in bytes
      $bits   = (int) $log + 1; // length in bits
      $filter = (int) ( 1 << $bits ) - 1; // set all lower bits to 1
      do {
        $rnd = hexdec( bin2hex( openssl_random_pseudo_bytes( $bytes ) ) );
        $rnd = $rnd & $filter; // discard irrelevant bits
      } while ( $rnd >= $range );
      return $min + $rnd;
    };

    $token = "";
    $max   = strlen( $pool );
    for ( $i = 0; $i < $length; $i++ ) {
      $token .= $pool[$crypto_rand_secure( 0, $max )];
    }
    return $token;
  }
}
