<?php

namespace App\Rules;

use App\Employee;
use App\Establishment;
use Illuminate\Contracts\Validation\Rule;

class isEmployee implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
    
        $establishmentCode = Establishment::where('id', $value)->first();

        if ((!is_null($establishmentCode)) && ($value == $establishmentCode->id) && ($establishmentCode->tipo == 'P')) {
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No existe ningún proveedor con este código';
    }
}
