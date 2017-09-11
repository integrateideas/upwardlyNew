<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Model\Entity\VendorBadge;
use Cake\Core\Configure;

/**
 * VendorBadges Model
 *
 * @property \App\Model\Table\VendorsTable|\Cake\ORM\Association\BelongsTo $Vendors
 * @property \App\Model\Table\VendorBadgeActionsTable|\Cake\ORM\Association\HasMany $VendorBadgeActions
 * @property \App\Model\Table\VendorPlayerActivitiesTable|\Cake\ORM\Association\HasMany $VendorPlayerActivities
 * @property \App\Model\Table\VendorPlayerBadgesTable|\Cake\ORM\Association\HasMany $VendorPlayerBadges
 *
 * @method \App\Model\Entity\VendorBadge get($primaryKey, $options = [])
 * @method \App\Model\Entity\VendorBadge newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VendorBadge[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VendorBadge|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VendorBadge patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VendorBadge[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VendorBadge findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VendorBadgesTable extends Table
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

        $this->setTable('vendor_badges');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Vendors', [
            'foreignKey' => 'vendor_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('VendorBadgeActions', [
            'foreignKey' => 'vendor_badge_id'
        ]);
        $this->hasMany('VendorPlayerActivities', [
            'foreignKey' => 'vendor_badge_id'
        ]);
        $this->hasMany('VendorPlayerBadges', [
            'foreignKey' => 'vendor_badge_id'
        ]);
        
        $this->addBehavior('Josegonzalez/Upload.Upload', [
          'image_name' => [
            'path' => Configure::read('ImageUpload.uploadPathForVendorBadgesImages'),
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
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->integer('points')
            ->requirePresence('points', 'create')
            ->notEmpty('points');

        $validator
            // ->scalar('image_name')
            ->allowEmpty('image_name');

        $validator
            ->scalar('image_path')
            ->allowEmpty('image_path');

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->scalar('description')
            ->allowEmpty('description');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['vendor_id'], 'Vendors'));

        return $rules;
    }
}
