<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TranslationMemoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TranslationMemoriesTable Test Case
 */
class TranslationMemoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TranslationMemoriesTable
     */
    public $TranslationMemories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.translation_memories',
        'app.users',
        'app.languages',
        'app.tm_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TranslationMemories') ? [] : ['className' => 'App\Model\Table\TranslationMemoriesTable'];
        $this->TranslationMemories = TableRegistry::get('TranslationMemories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TranslationMemories);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
