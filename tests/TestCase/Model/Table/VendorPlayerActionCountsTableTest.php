<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VendorPlayerActionCountsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VendorPlayerActionCountsTable Test Case
 */
class VendorPlayerActionCountsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VendorPlayerActionCountsTable
     */
    public $VendorPlayerActionCounts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.vendor_player_action_counts',
        'app.vendor_players',
        'app.vendor_actions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('VendorPlayerActionCounts') ? [] : ['className' => VendorPlayerActionCountsTable::class];
        $this->VendorPlayerActionCounts = TableRegistry::get('VendorPlayerActionCounts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VendorPlayerActionCounts);

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
