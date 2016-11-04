<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once 'conf.php';

$container = new \Slim\Container([
    'settings' => $config
]);
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('../resources/templates', [
        'cache' => '../resources/cache',
        'auto_reload' => true
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};
$container['resourceService'] = function ($container) {
    return new Service\TokenResouceService();
};

$app = new \Slim\App($container);

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(new Service\CorsServiceMiddleware());

/**
 * @SWG\Info(title="PHP-Leafleter", version="0.1")
 */
(new Controller\SwaggerRoutes())->addRouteHandling($app);
(new Controller\LeafletRoutes())->addRouteHandling($app);
(new Controller\ResourceRoutes())->addRouteHandling($app);
(new Controller\MapRoutes())->addRouteHandling($app);

$app->run();