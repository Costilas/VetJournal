<?php

namespace App\Helpers;

use Symfony\Component\Yaml\Yaml;

class FilterConditionDescriber
{
    private array $config;

    public function __construct(
        private Yaml $yaml
    ) {}

    public function describeFilterCondition(array $validatedInputs):array
    {
        $this->setConfig();
        return $this->filtrateInputData($validatedInputs);
    }

    private function filtrateInputData(array $validatedInputs):array
    {
        $inputsToTranslate =  $this->config;
        $filterCondition = [];
        foreach(array_filter($validatedInputs) as $inputName => $inputCondition){
            if(is_array($inputCondition)){
                $filterCondition = $this->filtrateInputData($inputCondition);
            }
            if(key_exists($inputName, $inputsToTranslate)) {
                $filterCondition[$inputsToTranslate[$inputName]] = $inputCondition;
            }
        }

        return $filterCondition;
    }

    private function setConfig():void
    {
        $this->config = $this->yaml->parse(file_get_contents(public_path() . '/config/filter.yaml'));
    }


}
