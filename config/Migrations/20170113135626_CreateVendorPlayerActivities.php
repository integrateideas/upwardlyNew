<?php
use Migrations\AbstractMigration;

class CreateVendorPlayerActivities extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('vendor_player_activities');
        $table->addColumn('vendor_player_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('vendor_action_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
         $table->addColumn('vendor_badge_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
          $table->addColumn('vendor_level_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('points', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);

        $table->addColumn('feed_text', 'text', [
            'default' => null,
            'null' => true,
        ]);  
        $table->addColumn('meta_data', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('status', 'integer', [
            'default' => 1,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('is_deleted', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->create();
    }
}
