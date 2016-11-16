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
        $app->get('/t/{token}', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {
            return $this->view->render($response, 'map.html', [
                'token' => $request->getAttribute('token')
            ]);
        })
            ->setName('tmap');
    }
}
