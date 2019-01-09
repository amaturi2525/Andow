<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TaskreviewsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TaskreviewsTable Test Case
 */
class TaskreviewsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TaskreviewsTable
     */
    public $Taskreviews;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.taskreviews',
        'app.users',
        'app.grades',
        'app.departments',
        'app.faculties',
        'app.universities',
        'app.lectures',
        'app.reports',
        'app.taskreview',
        'app.review_evals',
        'app.schedules'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Taskreviews') ? [] : ['className' => 'App\Model\Table\TaskreviewsTable'];
        $this->Taskreviews = TableRegistry::get('Taskreviews', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Taskreviews);

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
