<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VendorPlayersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VendorPlayersTable Test Case
 */
class VendorPlayersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VendorPlayersTable
     */
    public $VendorPlayers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.vendor_players',
        'app.players',
        'app.social_profiles',
        'app.users',
        'app.vendors',
        'app.vendor_actions',
        'app.actions',
        'app.vendor_badge_actions',
        'app.vendor_badges',
        'app.vendor_player_activities',
        'app.vendor_levels',
        'app.vendor_player_badges',
        'app.vendor_player_action_counts',
        'app.vendor_player_badge_activities',
        'app.vendor_domains',
        'app.roles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('VendorPlayers') ? [] : ['className' => VendorPlayersTable::class];
        $this->VendorPlayers = TableRegistry::get('VendorPlayers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VendorPlayers);

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
