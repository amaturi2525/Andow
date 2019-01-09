<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UniversitiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UniversitiesTable Test Case
 */
class UniversitiesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UniversitiesTable
     */
    public $Universities;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.universities'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Universities') ? [] : ['className' => 'App\Model\Table\UniversitiesTable'];
        $this->Universities = TableRegistry::get('Universities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Universities);

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
