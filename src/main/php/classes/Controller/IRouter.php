<?php
namespace Controller;

interface IRouter
{

    public function addRouteHandling(\Slim\App $app);
}