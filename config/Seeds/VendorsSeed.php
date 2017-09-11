<?php
use Migrations\AbstractSeed;

/**
 * ProductType seed.
 */
class VendorsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
                    [
                      'id'       => 1,
                      'org_name' => 'admin',
                      'status'   => 1,
                      'created'  => date('Y-m-d H:i:s'),
                      'modified' => date('Y-m-d H:i:s'),
                      'is_deleted' => NULL,
                      'client_identifier' => '123456789',
                      ],
                      [
                      'id'       => 2,
                      'org_name' => 'Charizad',
                      'status'   => 1,
                      'created'  => date('Y-m-d H:i:s'),
                      'modified' => date('Y-m-d H:i:s'),
                      'is_deleted' => NULL,
                      'client_identifier' => '123456789',
                      ]
                ];

        $table = $this->table('vendors');
        $table->insert($data)->save();
    }
}