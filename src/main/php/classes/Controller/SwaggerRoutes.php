<?php
namespace Controller;

class SwaggerRoutes implements IRouter
{

    public function addRouteHandling(\Slim\App $app)
    {
        $app->get('/api', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) use ($app) {
            return $response->withRedirect('/swagger-ui/');
        });
        $app->get('/api/', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) use ($app) {
            return $response->withRedirect('/swagger-ui/');
        });
        /**
         * @SWG\Get(
         * path="/api/swagger",
         * @SWG\Response(response="200", description="the swagger.json for the api")
         * )
         */
        $app->get('/api/swagger', function (\Slim\Http\Request $request, \Slim\Http\Response $response) {
            $swagger = \Swagger\scan([
                '../classes',
                './'
            ]);

            return $response->withHeader('Content-Type', 'application/json')
                ->withStatus(200)
                ->write($swagger);
        });
    }
}