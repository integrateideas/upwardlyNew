<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VendorPlayers Model
 *
 * @property \App\Model\Table\PlayersTable|\Cake\ORM\Association\BelongsTo $Players
 * @property \App\Model\Table\VendorsTable|\Cake\ORM\Association\BelongsTo $Vendors
 * @property \App\Model\Table\VendorLevelsTable|\Cake\ORM\Association\BelongsTo $VendorLevels
 * @property \App\Model\Table\VendorPlayerActionCountsTable|\Cake\ORM\Association\HasMany $VendorPlayerActionCounts
 * @property \App\Model\Table\VendorPlayerActivitiesTable|\Cake\ORM\Association\HasMany $VendorPlayerActivities
 * @property \App\Model\Table\VendorPlayerBadgeActivitiesTable|\Cake\ORM\Association\HasMany $VendorPlayerBadgeActivities
 * @property \App\Model\Table\VendorPlayerBadgesTable|\Cake\ORM\Association\HasMany $VendorPlayerBadges
 *
 * @method \App\Model\Entity\VendorPlayer get($primaryKey, $options = [])
 * @method \App\Model\Entity\VendorPlayer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VendorPlayer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VendorPlayer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VendorPlayer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VendorPlayer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VendorPlayer findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VendorPlayersTable extends Table
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

        $this->setTable('vendor_players');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Players', [
            'foreignKey' => 'player_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Vendors', [
            'foreignKey' => 'vendor_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('VendorLevels', [
            'foreignKey' => 'vendor_level_id'
        ]);
        $this->hasMany('VendorPlayerActionCounts', [
            'foreignKey' => 'vendor_player_id'
        ]);
        $this->hasMany('VendorPlayerActivities', [
            'foreignKey' => 'vendor_player_id'
        ]);
        $this->hasMany('VendorPlayerBadgeActivities', [
            'foreignKey' => 'vendor_player_id'
        ]);
        $this->hasMany('VendorPlayerBadges', [
            'foreignKey' => 'vendor_player_id'
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
            ->scalar('ref_code')
            ->allowEmpty('ref_code');

        $validator
            ->numeric('points')
            ->allowEmpty('points');

        $validator
            ->boolean('status')
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
        $rules->add($rules->existsIn(['player_id'], 'Players'));
        $rules->add($rules->existsIn(['vendor_id'], 'Vendors'));
        $rules->add($rules->existsIn(['vendor_level_id'], 'VendorLevels'));

        return $rules;
    }
}
