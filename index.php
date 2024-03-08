<?php

use JustinMueller\Flugplanung\Helper;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . '/vendor/autoload.php';

Helper::checkLogin();

// Access additional user data stored in the session, if available
$mitgliederData = $_SESSION['mitgliederData'] ?? [];

// Milan club id
$clubId = 150;

// set up Twig
$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader);

// populate tabs
$tabs = [
    'flugplanung' => [
        'label' => 'Flugplanung',
        'content' => $twig->render('flugplanung.twig.html')
    ]
];
if ($mitgliederData['dienste_admin']) {
    $tabs['flugtage'] = [
        'label' => 'Flugtage',
        'content' => $twig->render('flugtage.twig.html')
    ];
}

echo $twig->render(
    'index.twig.html',
    [
        'clubId' => $clubId,
        'mitgliederData' => $mitgliederData,
        'tabs' => $tabs
    ]
);
