<?php
namespace Controller;

class LeafletRoutes implements IRouter
{

    public function addRouteHandling(\Slim\App $app)
    {

        /**
         * @SWG\Get(
         * path="/api/configuration",
         * @SWG\Response(response="200", description="the configuration according to the API-Token")
         * )
         */
        $app->get('/api/configuration', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {
            $configuration = $this->resourceService->loadConfigurations($request->getQueryParam('token'));
            return $response->withHeader('Content-Type', 'application/json')
                ->withStatus(200)
                ->write($configuration);
        });
        /**
         * @SWG\Get(
         * path="/api/points",
         * @SWG\Response(response="200", description="the points to display according to the API-Token")
         * )
         */
        $app->get('/api/points', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {
            $points = $this->resourceService->loadPoints($request->getQueryParam('token'));
            return $response->withHeader('Content-Type', 'application/json')
                ->withStatus(200)
                ->write($points);
        });
        /**
         * @SWG\Get(
         * path="/api/features",
         * @SWG\Response(response="200", description="the features to display according to the API-token")
         * )
         */
        $app->get('/api/features', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {
            $features = $this->resourceService->loadFeatures($request->getQueryParam('token'));
            return $response->withHeader('Content-Type', 'application/json')
                ->withStatus(200)
                ->write($features);
        });
    }
}