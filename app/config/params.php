<?php

use Cekurte\Environment\Environment;
return [
//    'adminEmail' => 'admin@example.com',
//    'senderEmail' => 'noreply@example.com',
//    'senderName' => 'Example.com mailer',
    'icon-framework' => \kartik\icons\Icon::TYP,
    'yandex' => [
        'apikey' => Environment::get('YANDEX_MAP_APIKEY')
    ],
    'frontendUrl' => Environment::get('FRONTEND_LINK'),
    'social' => [
        'vk' => [
            'id' => '7275539',
            'secret' => 'fYQExXIhmgtipJ47XSVN',
            'access_token' => '3ee7bc7b3ee7bc7b3ee7bc7bb23e88b86833ee73ee7bc7b60f080098c1a8526fe888cc5',
        ],
        'ok' => [
            'id' => '512000437874',
            'public' => 'CDHPKLJGDIHBABABA',
            'secret' => '2E9B6EBBA80171BD9A3A4F84',
        ],
    ], 
    'reCaptcha' => [
        'v2' => [
            'siteKey' => '6LfjZawaAAAAAKDotRyFZERYeXpqX48lZrvj7Bgn',
            'secret' => '6LfjZawaAAAAABsAbCyuRuOleIgEaZ5q-VZbCrWA'
        ],
    ],
];
