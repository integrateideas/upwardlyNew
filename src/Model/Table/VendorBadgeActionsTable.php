<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VendorBadgeActions Model
 *
 * @property \App\Model\Table\VendorBadgesTable|\Cake\ORM\Association\BelongsTo $VendorBadges
 * @property \App\Model\Table\VendorActionsTable|\Cake\ORM\Association\BelongsTo $VendorActions
 *
 * @method \App\Model\Entity\VendorBadgeAction get($primaryKey, $options = [])
 * @method \App\Model\Entity\VendorBadgeAction newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VendorBadgeAction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VendorBadgeAction|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VendorBadgeAction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VendorBadgeAction[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VendorBadgeAction findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VendorBadgeActionsTable extends Table
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

        $this->setTable('vendor_badge_actions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('VendorBadges', [
            'foreignKey' => 'vendor_badge_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('VendorActions', [
            'foreignKey' => 'vendor_action_id',
            'joinType' => 'INNER'
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
            ->integer('frequency')
            ->requirePresence('frequency', 'create')
            ->notEmpty('frequency');

        $validator
            ->boolean('status')
            ->allowEmpty('status', 'create');

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
        $rules->add($rules->existsIn(['vendor_badge_id'], 'VendorBadges'));
        $rules->add($rules->existsIn(['vendor_action_id'], 'VendorActions'));

        return $rules;
    }
}
