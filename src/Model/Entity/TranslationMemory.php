<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TranslationMemory Entity
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $user_id
 * @property int $source_language_id
 * @property int $target_language_id
 * @property int $tm_type_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Language $language
 * @property \App\Model\Entity\TmType $tm_type
 */
class TranslationMemory extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
