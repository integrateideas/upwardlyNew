<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VendorPlayerActivitiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VendorPlayerActivitiesTable Test Case
 */
class VendorPlayerActivitiesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VendorPlayerActivitiesTable
     */
    public $VendorPlayerActivities;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.vendor_player_activities',
        'app.vendor_players',
        'app.vendor_actions',
        'app.vendor_badges',
        'app.vendor_levels'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('VendorPlayerActivities') ? [] : ['className' => VendorPlayerActivitiesTable::class];
        $this->VendorPlayerActivities = TableRegistry::get('VendorPlayerActivities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VendorPlayerActivities);

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
