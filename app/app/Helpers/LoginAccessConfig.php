<?php

namespace App\Helpers;

use Symfony\Component\Yaml\Yaml;

class LoginAccessConfig
{
    private array $config;

    public function __construct(private Yaml $yaml)
    {
        $this->setConfig();
    }

    private function setConfig()
    {
        $this->config = $this->yaml->parse(file_get_contents('config/access.yaml'));
    }

    public function getConfig():array
    {
        return $this->config;
    }

}
