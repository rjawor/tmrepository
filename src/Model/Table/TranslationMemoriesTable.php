<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TranslationMemories Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Languages
 * @property \Cake\ORM\Association\BelongsTo $Languages
 * @property \Cake\ORM\Association\BelongsTo $TmTypes
 * @property \Cake\ORM\Association\BelongsTo $Domains
 *
 * @method \App\Model\Entity\TranslationMemory get($primaryKey, $options = [])
 * @method \App\Model\Entity\TranslationMemory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TranslationMemory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TranslationMemory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TranslationMemory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TranslationMemory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TranslationMemory findOrCreate($search, callable $callback = null)
 */
class TranslationMemoriesTable extends Table
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

        $this->table('translation_memories');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('SourceLanguage', [
        	'className' => 'Languages',
            'foreignKey' => 'source_language_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('TargetLanguage', [
        	'className' => 'Languages',
            'foreignKey' => 'target_language_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('TmTypes', [
            'foreignKey' => 'tm_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Domains', [
            'foreignKey' => 'domain_id',
            'joinType' => 'LEFT'
        ]);
        $this->hasMany('Units', [
        	'dependent' => true
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
            ->allowEmpty('title');

        $validator
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['source_language_id'], 'SourceLanguage'));
        $rules->add($rules->existsIn(['target_language_id'], 'TargetLanguage'));
        $rules->add($rules->existsIn(['tm_type_id'], 'TmTypes'));
        $rules->add($rules->existsIn(['domain_id'], 'Domains'));

        return $rules;
    }
}
