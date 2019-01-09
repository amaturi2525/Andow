<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReviewEvalsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReviewEvalsTable Test Case
 */
class ReviewEvalsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReviewEvalsTable
     */
    public $ReviewEvals;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.review_evals',
        'app.taskreview',
        'app.users',
        'app.grades',
        'app.departments',
        'app.faculties',
        'app.universities',
        'app.lectures',
        'app.reports',
        'app.reviews',
        'app.schedules',
        'app.taskreviews'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ReviewEvals') ? [] : ['className' => 'App\Model\Table\ReviewEvalsTable'];
        $this->ReviewEvals = TableRegistry::get('ReviewEvals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ReviewEvals);

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
