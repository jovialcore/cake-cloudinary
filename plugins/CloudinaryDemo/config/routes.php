<?php

use Cake\Routing\Route\DashedRoute;

$routes->plugin(
    'CloudinaryDemo',
    ['path' => '/cloudinary-demo'],
    function ($routes) {
        $routes->setRouteClass(DashedRoute::class);

        $routes->get('/cloudinaries', ['controller' => 'Cloudinaries']);
        $routes->get('/cloudinaries/{id}', ['controller' => 'Contacts', 'action' => 'view']);
        $routes->put('/cloudinaries/{id}', ['controller' => 'Contacts', 'action' => 'update']);
    }
);
