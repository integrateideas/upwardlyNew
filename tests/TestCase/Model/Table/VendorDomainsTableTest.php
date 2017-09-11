<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VendorDomainsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VendorDomainsTable Test Case
 */
class VendorDomainsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VendorDomainsTable
     */
    public $VendorDomains;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.vendor_domains',
        'app.vendors',
        'app.users',
        'app.roles',
        'app.social_profiles',
        'app.vendor_actions',
        'app.actions',
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
        $config = TableRegistry::exists('VendorDomains') ? [] : ['className' => VendorDomainsTable::class];
        $this->VendorDomains = TableRegistry::get('VendorDomains', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VendorDomains);

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
