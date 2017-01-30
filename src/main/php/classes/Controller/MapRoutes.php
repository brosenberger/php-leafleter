<?php
namespace Controller;

class MapRoutes implements IRouter
{

    public function addRouteHandling(\Slim\App $app)
    {
        $that = $this;
        $app->get('/', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) use ($that) {
            return $this->view->render($response, 'map.html', $that->_prepareMapConfiguration($this->resourceService, $this->settings['default_token']));
        })
            ->setName('map');
        $app->get('/t/{token}', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) use ($that) {
            return $this->view->render($response, 'map.html', $that->_prepareMapConfiguration($this->resourceService, $request->getAttribute('token')));
        })
            ->setName('tmap');
    }

    private function _prepareMapConfiguration(\Service\TokenResouceService $tokenService, $token)
    {
        $configuration = array();
        $configuration['config'] = json_decode($tokenService->loadConfigurations($token));
        $configuration['token'] = $token;
        return $configuration;
    }
}
