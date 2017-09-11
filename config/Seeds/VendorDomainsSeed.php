<?php
use Migrations\AbstractSeed;

/**
 * ProductType seed.
 */
class VendorDomainsSeed extends AbstractSeed
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
                      'vendor_id' => 1,
                      'domain'   => 'www.admindomain.com',
                      'created'  => date('Y-m-d H:i:s'),
                      'modified' => date('Y-m-d H:i:s'),
                      ],
                      [
                      'id'       => 2,
                      'vendor_id' => 2,
                      'domain'   => 'www.charizaddomain.com',
                      'created'  => date('Y-m-d H:i:s'),
                      'modified' => date('Y-m-d H:i:s'),
                      ],
                      [
                      'id'       => 3,
                      'vendor_id' => 3,
                      'domain'   => 'www.blastoisedomain.com',
                      'created'  => date('Y-m-d H:i:s'),
                      'modified' => date('Y-m-d H:i:s'),
                      ],
                      [
                      'id'       => 4,
                      'vendor_id' => 4,
                      'domain'   => 'www.venasaurdomain.com',
                      'created'  => date('Y-m-d H:i:s'),
                      'modified' => date('Y-m-d H:i:s'),
                      ]
                ];

        $table = $this->table('vendor_domains');
        $table->insert($data)->save();
    }
}