<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VendorPlayerBadges Model
 *
 * @property \App\Model\Table\VendorPlayersTable|\Cake\ORM\Association\BelongsTo $VendorPlayers
 * @property \App\Model\Table\VendorBadgesTable|\Cake\ORM\Association\BelongsTo $VendorBadges
 *
 * @method \App\Model\Entity\VendorPlayerBadge get($primaryKey, $options = [])
 * @method \App\Model\Entity\VendorPlayerBadge newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VendorPlayerBadge[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VendorPlayerBadge|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VendorPlayerBadge patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VendorPlayerBadge[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VendorPlayerBadge findOrCreate($search, callable $callback = null, $options = [])
 */
class VendorPlayerBadgesTable extends Table
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

        $this->setTable('vendor_player_badges');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('VendorPlayers', [
            'foreignKey' => 'vendor_player_id'
        ]);
        $this->belongsTo('VendorBadges', [
            'foreignKey' => 'vendor_badge_id'
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
        $rules->add($rules->existsIn(['vendor_badge_id'], 'VendorBadges'));

        return $rules;
    }
}
