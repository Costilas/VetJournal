<?php

namespace App\Actions\Common;

class DescribeFilterAction
{
    private const FILTER_INPUTS = [
        'lastName',
        'name',
        'patronymic',
        'phone',
        'pets',
        'from',
        'to',
        'additionalPhone',
        'email',
    ];

    public function __invoke(array $validatedInputs):array
    {
        $describedFilters = [];

        foreach($validatedInputs as $inputName => $inputCondition){
            if(in_array($inputName, static::FILTER_INPUTS)){
                $describedFilters[__('filter_inputs.inputs.' . $inputName)] = $inputCondition;
            }
        }

        return $describedFilters;
    }
}
