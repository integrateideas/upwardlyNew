<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VendorActionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VendorActionsTable Test Case
 */
class VendorActionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VendorActionsTable
     */
    public $VendorActions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.vendor_actions',
        'app.actions',
        'app.vendors',
        'app.vendor_badge_actions',
        'app.vendor_player_action_counts',
        'app.vendor_players',
        'app.vendor_player_activities',
        'app.vendor_badges',
        'app.vendor_levels',
        'app.vendor_player_badge_activities'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('VendorActions') ? [] : ['className' => VendorActionsTable::class];
        $this->VendorActions = TableRegistry::get('VendorActions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VendorActions);

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
