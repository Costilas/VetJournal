<?php

namespace App\Models;

use Carbon\Carbon;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Propaganistas\LaravelPhone\Exceptions\NumberFormatException;
use Propaganistas\LaravelPhone\Exceptions\NumberParseException;

class Owner extends Model
{

    protected $fillable = ['name', 'patronymic', 'last_name', 'address', 'phone', 'additional_phone', 'email'];

    use Filterable;
    use HasFactory;

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

    public function registerDate()
    {
        return Carbon::create($this->created_at)->format('d-m-Y');
    }

    public function phone(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (empty($value)) {
                    return null;
                }

                try {
                    // case when clinic moved to other country but in database stored numbers from previous country
                    // in this case they won't be able to store it but still can search
                    return phone($value, env('COUNTRY_OF_CLINIC'))->formatNational();
                } catch (NumberParseException|NumberFormatException $exception) {
                    Log::info($exception->getMessage());
                    return $value;
                }
            },
            set: function ($value) {
                $value = phone($value, env('COUNTRY_OF_CLINIC'))->formatNational();

                return preg_replace('/[^0-9]/', '', $value);
            }
        );
    }
}
