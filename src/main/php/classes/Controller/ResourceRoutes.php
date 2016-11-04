<?php
namespace Controller;

class ResourceRoutes implements IRouter
{

    public function addRouteHandling(\Slim\App $app)
    {
        /**
         * @SWG\Get(
         * path="/images/{picture}",
         * @SWG\Response(response="200", description="the requested picture for the given API-Token")
         * )
         */
        $app->get('/images/{token}/{picture}', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {
            $name = $request->getAttribute('picture');
            $token = $request->getAttribute('token');
            return $response->withStatus(200)
                ->write($this->resourceService->loadTokenfile($token, $name . '.png'));
        });
        /**
         * @SWG\Get(
         * path="/js/{version}/php-leafleter-js.js",
         * @SWG\Response(response="200", description="the requested picture for the given API-Token")
         * )
         */
        $app->get('/js/{version}/php-leafleter-js', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {
            $version = $request->getAttribute('version');
            $js = file_get_contents('./../resources/js/' . $version . '/php-leafleter-js.js');
            return $response->withHeader('Content-Type', 'application/javascript')
                ->withStatus(200)
                ->write($js);
        });
    }
}