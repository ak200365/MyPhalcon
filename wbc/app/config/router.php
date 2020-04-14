<?php

$router = $di->getRouter();

$router->add(
    '/signup',
    [
        'controller' => 'index',
        'action'     => 'register',
    ]
);

$router->handle($_SERVER['REQUEST_URI']);
