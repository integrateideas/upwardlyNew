<?php
use Cake\Core\Configure;

return [
    'HybridAuth' => [
        'providers' => [
            'Google' => [
                'enabled' => true,
                'keys' => [
                    'id' => '509569279451-1imf8gonil2cp2or1uqtklme6c5a15c6.apps.googleusercontent.com',
                    'secret' => 'hLLtDcOks6jePI1mHF0gWu8l'
                ]
            ],
            'Facebook' => [
                'enabled' => true,
                'keys' => [
                    'id' => '1855404831396267',
                    'secret' => '5e3b24db22eec320c56b5b0eade6e967'
                ],
                'scope' => 'email, user_about_me, user_birthday, user_hometown',
                 "display" => "popup"
            ],
            'Twitter' => [
                'enabled' => true,
                'keys' => [
                    'key' => '6CwgvX95HG8GIS418hfbbO7yv',
                    'secret' => 'bS4QmF0sFMSgD3PxsHBO3ZNTpHRNJDlxHsxFsHyxGhtkY5SinV'
                ],
                'includeEmail' => true // Only if your app is whitelisted by Twitter Support
            ]
        ],
        'debug_mode' => Configure::read('debug'),
        'debug_file' => LOGS . 'hybridauth.log',
    ]
];
?>