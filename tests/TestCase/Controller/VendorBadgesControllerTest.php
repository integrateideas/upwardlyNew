<?php
namespace App\Test\TestCase\Controller;

use App\Controller\VendorBadgesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\VendorBadgesController Test Case
 */
class VendorBadgesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.vendor_badges',
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
        'app.vendor_levels',
        'app.vendor_player_badge_activities',
        'app.vendor_domains',
        'app.vendor_player_badges'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
