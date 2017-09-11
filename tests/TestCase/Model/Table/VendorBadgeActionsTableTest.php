<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VendorBadgeActionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VendorBadgeActionsTable Test Case
 */
class VendorBadgeActionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VendorBadgeActionsTable
     */
    public $VendorBadgeActions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.vendor_badge_actions',
        'app.vendor_badges',
        'app.vendors',
        'app.users',
        'app.roles',
        'app.social_profiles',
        'app.vendor_actions',
        'app.actions',
        'app.vendor_player_action_counts',
        'app.vendor_players',
        'app.vendor_player_activities',
        'app.vendor_levels',
        'app.vendor_player_badge_activities',
        'app.vendor_domains',
        'app.vendor_player_badges'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('VendorBadgeActions') ? [] : ['className' => VendorBadgeActionsTable::class];
        $this->VendorBadgeActions = TableRegistry::get('VendorBadgeActions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VendorBadgeActions);

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
