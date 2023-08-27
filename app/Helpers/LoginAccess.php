<?php

namespace App\Helpers;

use Symfony\Component\Yaml\Yaml;

class LoginAccess
{
    private array $config;

    public function __construct(private Yaml $yaml)
    {
        $this->setConfig();
    }

    private function setConfig():void
    {
        $this->config = $this->yaml->parse(file_get_contents('config/access.yaml'));
    }

   public function formUserCredentials(array $validatedData):array
   {
       return array_merge($validatedData, $this->config);
   }

}
