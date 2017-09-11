<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VendorActions Model
 *
 * @property \App\Model\Table\ActionsTable|\Cake\ORM\Association\BelongsTo $Actions
 * @property \App\Model\Table\VendorsTable|\Cake\ORM\Association\BelongsTo $Vendors
 * @property \App\Model\Table\VendorBadgeActionsTable|\Cake\ORM\Association\HasMany $VendorBadgeActions
 * @property \App\Model\Table\VendorPlayerActionCountsTable|\Cake\ORM\Association\HasMany $VendorPlayerActionCounts
 * @property \App\Model\Table\VendorPlayerActivitiesTable|\Cake\ORM\Association\HasMany $VendorPlayerActivities
 * @property \App\Model\Table\VendorPlayerBadgeActivitiesTable|\Cake\ORM\Association\HasMany $VendorPlayerBadgeActivities
 *
 * @method \App\Model\Entity\VendorAction get($primaryKey, $options = [])
 * @method \App\Model\Entity\VendorAction newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VendorAction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VendorAction|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VendorAction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VendorAction[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VendorAction findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VendorActionsTable extends Table
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

        $this->setTable('vendor_actions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Actions', [
            'foreignKey' => 'action_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Vendors', [
            'foreignKey' => 'vendor_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('VendorBadgeActions', [
            'foreignKey' => 'vendor_action_id'
        ]);
        $this->hasMany('VendorPlayerActionCounts', [
            'foreignKey' => 'vendor_action_id'
        ]);
        $this->hasMany('VendorPlayerActivities', [
            'foreignKey' => 'vendor_action_id'
        ]);
        $this->hasMany('VendorPlayerBadgeActivities', [
            'foreignKey' => 'vendor_action_id'
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
            ->scalar('custom_action_name')
            ->allowEmpty('custom_action_name');

        $validator
            ->integer('points')
            ->requirePresence('points', 'create')
            ->notEmpty('points');

        $validator
            ->scalar('image_path')
            ->allowEmpty('image_path');

        $validator
            ->scalar('image_name')
            ->allowEmpty('image_name');

        $validator
            ->scalar('label')
            ->allowEmpty('label');

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
        $rules->add($rules->existsIn(['action_id'], 'Actions'));
        $rules->add($rules->existsIn(['vendor_id'], 'Vendors'));

        return $rules;
    }
}
