<?php
use Migrations\AbstractSeed;

/**
 * Actions seed.
 */
class ActionsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
                    [
                        'name'=> 'SignUp',
                        'created' => date('Y-m-d H:i:s'),
                        'modified'=> date('Y-m-d H:i:s'),
                    ],
                    [
                        'name'=> 'Like',
                        'created' => date('Y-m-d H:i:s'),
                        'modified'=> date('Y-m-d H:i:s'),
                    ],
                    [
                        'name'=> 'Share',
                        'created' => date('Y-m-d H:i:s'),
                        'modified'=> date('Y-m-d H:i:s'),
                    ],
                    [
                        'name'=> 'Tweet',
                        'created' => date('Y-m-d H:i:s'),
                        'modified'=> date('Y-m-d H:i:s'),
                    ],
                    [
                        'name'=> 'View',
                        'created' => date('Y-m-d H:i:s'),
                        'modified'=> date('Y-m-d H:i:s'),
                    ],
                    [
                        'name'=> 'Custom',
                        'created' => date('Y-m-d H:i:s'),
                        'modified'=> date('Y-m-d H:i:s'),
                    ],

                ];

        $table = $this->table('actions');
        $table->insert($data)->save();
    }
}
