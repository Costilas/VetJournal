<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class OwnerFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function name(string $name): self
    {
        return $this->where('name', 'LIKE', "$name%");
    }

    public function lastName(string $lastName): self
    {
        return $this->where('last_name','LIKE', "$lastName%");
    }

    public function patronymic(string $patronymic): self
    {
        return $this->where('patronymic','LIKE', "$patronymic%");
    }

    public function phone(string $phone): self
    {
        return $this->where('phone', 'LIKE', "$phone%");
    }

    public function pets(string $pet_name): self
    {
        return $this->related('pets', 'pet_name', 'LIKE', "$pet_name%");
    }

    public function additionalPhone(string $additionalPhone): self
    {
        return $this->where('additional_phone', 'LIKE', "$additionalPhone%");
    }

    public function email(string $email): self
    {
        return $this->where('email', 'LIKE', "$email%");
    }
}
