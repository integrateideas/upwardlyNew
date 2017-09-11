<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SocialProfiles Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\SocialProfile get($primaryKey, $options = [])
 * @method \App\Model\Entity\SocialProfile newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SocialProfile[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SocialProfile|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SocialProfile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SocialProfile[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SocialProfile findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SocialProfilesTable extends Table
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

        $this->setTable('social_profiles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
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
            ->scalar('provider')
            ->requirePresence('provider', 'create')
            ->notEmpty('provider');

        $validator
            ->scalar('identifier')
            ->requirePresence('identifier', 'create')
            ->notEmpty('identifier');

        $validator
            ->scalar('profile_url')
            ->allowEmpty('profile_url');

        $validator
            ->scalar('website_url')
            ->allowEmpty('website_url');

        $validator
            ->scalar('photo_url')
            ->allowEmpty('photo_url');

        $validator
            ->scalar('display_name')
            ->allowEmpty('display_name');

        $validator
            ->scalar('description')
            ->allowEmpty('description');

        $validator
            ->scalar('first_name')
            ->allowEmpty('first_name');

        $validator
            ->scalar('last_name')
            ->allowEmpty('last_name');

        $validator
            ->scalar('gender')
            ->allowEmpty('gender');

        $validator
            ->scalar('language')
            ->allowEmpty('language');

        $validator
            ->scalar('age')
            ->allowEmpty('age');

        $validator
            ->scalar('birth_day')
            ->allowEmpty('birth_day');

        $validator
            ->scalar('birth_month')
            ->allowEmpty('birth_month');

        $validator
            ->scalar('birth_year')
            ->allowEmpty('birth_year');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->scalar('email_verified')
            ->allowEmpty('email_verified');

        $validator
            ->scalar('phone')
            ->allowEmpty('phone');

        $validator
            ->scalar('address')
            ->allowEmpty('address');

        $validator
            ->scalar('country')
            ->allowEmpty('country');

        $validator
            ->scalar('region')
            ->allowEmpty('region');

        $validator
            ->scalar('city')
            ->allowEmpty('city');

        $validator
            ->scalar('zip')
            ->allowEmpty('zip');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
