<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use Apps\Core\Controller\FastRouteCore;

// Gestion des fichiers environnement
$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

// Couche Controller
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $route) {
    $route->addRoute(['GET','POST'], '/', 'Apps\Controller\HomeController');
    $route->addRoute(['GET','POST'], '/inscription', 'Apps\Controller\Users\InscriptionController');
    $route->addRoute(['GET','POST'], '/demande', 'Apps\Controller\Users\DemandeController');
    $route->addRoute(['GET','POST'], '/Acceuil', 'Apps\Controller\Users\AcceuilTableauAssisterController');
    $route->addRoute(['GET','POST'], '/modifier', 'Apps\Controller\Users\ModifierController');
});
// Dispatcher -> Couche view
echo FastRouteCore::getDispatcher($dispatcher);

