<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Model\Entity\VendorLevel;
use Cake\Core\Configure;

/**
 * VendorLevels Model
 *
 * @property \App\Model\Table\VendorsTable|\Cake\ORM\Association\BelongsTo $Vendors
 * @property \App\Model\Table\VendorPlayerActivitiesTable|\Cake\ORM\Association\HasMany $VendorPlayerActivities
 * @property \App\Model\Table\VendorPlayersTable|\Cake\ORM\Association\HasMany $VendorPlayers
 *
 * @method \App\Model\Entity\VendorLevel get($primaryKey, $options = [])
 * @method \App\Model\Entity\VendorLevel newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VendorLevel[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VendorLevel|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VendorLevel patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VendorLevel[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VendorLevel findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VendorLevelsTable extends Table
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

        $this->setTable('vendor_levels');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Vendors', [
            'foreignKey' => 'vendor_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('VendorPlayerActivities', [
            'foreignKey' => 'vendor_level_id'
        ]);
        $this->hasMany('VendorPlayers', [
            'foreignKey' => 'vendor_level_id'
        ]);
        $this->addBehavior('Josegonzalez/Upload.Upload', [
          'image_name' => [
            'path' => Configure::read('ImageUpload.uploadPathForVendorLevelImages'),
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
            ->scalar('level_name')
            ->requirePresence('level_name', 'create')
            ->notEmpty('level_name');

        $validator
            ->integer('level_rank')
            ->requirePresence('level_rank', 'create')
            ->notEmpty('level_rank');

        $validator
            ->scalar('image_path')
            ->allowEmpty('image_path');

        $validator
            //->scalar('image_name')
            ->allowEmpty('image_name');

        $validator
            ->integer('points')
            ->requirePresence('points', 'create')
            ->notEmpty('points');

        $validator
            ->boolean('status')
            ->allowEmpty('status');

        $validator
            ->dateTime('is_deleted')
            ->allowEmpty('is_deleted');

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
