<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;
use Cake\Routing\Router;

/**
 * Players Model
 *
 * @property \App\Model\Table\VendorPlayersTable|\Cake\ORM\Association\HasMany $VendorPlayers
 *
 * @method \App\Model\Entity\Player get($primaryKey, $options = [])
 * @method \App\Model\Entity\Player newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Player[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Player|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Player patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Player[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Player findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PlayersTable extends Table
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

        $this->setTable('players');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('VendorPlayers', [
            'foreignKey' => 'player_id'
        ]);

        $this->hasMany('ADmad/HybridAuth.SocialProfiles');
        \Cake\Event\EventManager::instance()->on('HybridAuth.newUser', [$this, 'createUser']);
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
            ->scalar('username')
            ->allowEmpty('username');

        $validator
            ->scalar('first_name')
            ->allowEmpty('first_name');

        $validator
            ->scalar('last_name')
            ->allowEmpty('last_name');

        $validator
            ->scalar('password')
            ->allowEmpty('password');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->uuid('uuid')
            ->requirePresence('uuid', 'create')
            ->notEmpty('uuid');

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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }

    public function beforeMarshal( \Cake\Event\Event $event, \ArrayObject $data, \ArrayObject $options){
        if (!isset($data['uuid'])) {
            $data['uuid'] = Text::uuid();
        }
    }

    public function createUser(\Cake\Event\Event $event) {
        $request = (Router::getRequest());
        //pr($request); die('sss model');
        $vendorId = $request->query['vendor_id'];
        $profile = $event->data()['profile'];
        $req = [
          'email' => $profile->email,
          'username'=>$this->_suggestUsername($profile->first_name.$profile->last_name),
          'first_name' => $profile->first_name,
          'last_name' => $profile->last_name,
          'vendor_players'=>[
            [
              'vendor_id'=>$vendorId
            ]
          ]
        ];
        $user = $this->newEntity($req,['associated'=>['VendorPlayers']]);
        $user = $this->patchEntity($user,$req,['associated'=>['VendorPlayers']]);
        $user = $this->save($user,['associated'=>['VendorPlayers']]);
        if (!$user) {
          throw new \RuntimeException('Unable to save new user');
        }
        return $user;
    }

    protected function _suggestUsername($name){
        $name = trim(strtolower($name));
        // pr($tempUsername); die;
        $usernameCheck1 = $this->find()->where(['username' => $name])->first();
        if(!$usernameCheck1){
            $username = $name;
        }else{
            $usernameCheck2 = $this->find()->where(['username LIKE' => $name.'%'])->all()->toArray();
            if(!count($usernameCheck2)){
              $username = $name;
            }else{
              $username = $name.count($usernameCheck2);
            }
        }
        return $username;
    }

}
