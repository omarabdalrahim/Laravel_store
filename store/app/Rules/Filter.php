<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Filter implements Rule
{
    protected $forbidden;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($forbidden)
    {
        $this->forbidden = $forbidden;
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
        // if(strtolower($value)== $this->forbidden){
        //     // لازم ترجع false
        //     return false;
        // }
        // return true;
    //   in_array لو تحقق الشرط بترجع ترو او فولس
        return !in_array(strtolower($value), $this->forbidden);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The value is not allowed ';
    }
}
