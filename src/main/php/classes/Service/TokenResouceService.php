<?php
namespace Service;

class TokenResouceService
{

    public function loadConfigurations($token)
    {
        return $this->loadTokenFile($token, 'configuration.json');
    }

    public function loadPoints($token)
    {
        return $this->loadTokenFile($token, 'points.json');
    }

    public function loadFeatures($token)
    {
        return $this->loadTokenFile($token, 'feature.json');
    }

    public function loadTokenFile($token, $file)
    {
        return file_get_contents('../resources/token/' . $token . '/' . $file);
    }
}