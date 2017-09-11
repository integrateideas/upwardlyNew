<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VendorPlayerActivities Model
 *
 * @property \App\Model\Table\VendorPlayersTable|\Cake\ORM\Association\BelongsTo $VendorPlayers
 * @property \App\Model\Table\VendorActionsTable|\Cake\ORM\Association\BelongsTo $VendorActions
 * @property \App\Model\Table\VendorBadgesTable|\Cake\ORM\Association\BelongsTo $VendorBadges
 * @property \App\Model\Table\VendorLevelsTable|\Cake\ORM\Association\BelongsTo $VendorLevels
 *
 * @method \App\Model\Entity\VendorPlayerActivity get($primaryKey, $options = [])
 * @method \App\Model\Entity\VendorPlayerActivity newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VendorPlayerActivity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VendorPlayerActivity|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VendorPlayerActivity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VendorPlayerActivity[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VendorPlayerActivity findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VendorPlayerActivitiesTable extends Table
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

        $this->setTable('vendor_player_activities');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('VendorPlayers', [
            'foreignKey' => 'vendor_player_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('VendorActions', [
            'foreignKey' => 'vendor_action_id'
        ]);
        $this->belongsTo('VendorBadges', [
            'foreignKey' => 'vendor_badge_id'
        ]);
        $this->belongsTo('VendorLevels', [
            'foreignKey' => 'vendor_level_id'
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
            ->integer('points')
            ->allowEmpty('points');

        $validator
            ->scalar('feed_text')
            ->allowEmpty('feed_text');

        $validator
            ->scalar('meta_data')
            ->allowEmpty('meta_data');

        $validator
            ->integer('status')
            ->allowEmpty('status');

        $validator
            ->dateTime('is_deleted')
            ->allowEmpty('is_deleted');

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
        $rules->add($rules->existsIn(['vendor_player_id'], 'VendorPlayers'));
        $rules->add($rules->existsIn(['vendor_action_id'], 'VendorActions'));
        $rules->add($rules->existsIn(['vendor_badge_id'], 'VendorBadges'));
        $rules->add($rules->existsIn(['vendor_level_id'], 'VendorLevels'));

        return $rules;
    }
}
