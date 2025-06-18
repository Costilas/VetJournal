<?php

namespace App\Rules\Visit;

use Illuminate\Contracts\Validation\Rule;

class VisitDecimalRule implements Rule
{
    private int $maxIntegerDigits;
    private int $maxDecimalDigits;
    private string $attributeName;

    public function __construct(string $attributeName, int $maxIntegerDigits, int $maxDecimalDigits)
    {
        $this->maxIntegerDigits = $maxIntegerDigits;
        $this->maxDecimalDigits = $maxDecimalDigits;
        $this->attributeName = $attributeName;
    }

    public function passes($attribute, $value): bool
    {
        $value = str_replace(',', '.', $value);

        if (!preg_match('/^\d+(\.\d+)?$/', $value)) {
            return false;
        }

        [$integer, $decimal] = explode('.', $value . '.', 2);

        if (strlen($integer) > 1 && str_starts_with($integer, '0')) {
            return false;
        }

        return strlen($integer) <= $this->maxIntegerDigits
            && strlen(rtrim($decimal, '.')) <= $this->maxDecimalDigits;
    }

    public function message(): string
    {
        return "Неверный формат поля '{$this->attributeName}': максимальное число знаков перед разделителем - {$this->maxIntegerDigits}
                и {$this->maxDecimalDigits} после разделителя. Разделитель либо точка, либо запятая";
    }
}
