<?php
namespace Controller;

class MapRoutes implements IRouter
{

    public function addRouteHandling(\Slim\App $app)
    {
        $app->get('/', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {
            return $this->view->render($response, 'map.html', [
                'token' => $this->settings['default_token']
            ]);
        })
            ->setName('map');
    }
}