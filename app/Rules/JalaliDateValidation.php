<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Morilog\Jalali\Jalalian;

class JalaliDateValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(public $attribute)
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
        try {
            $dateString = \Morilog\Jalali\CalendarUtils::convertNumbers($value, true); // 1395-02-19
            $date = \Morilog\Jalali\CalendarUtils::createCarbonFromFormat($this->attribute, $dateString);
            return \Morilog\Jalali\CalendarUtils::checkDate($date->year,$date->month,$date->day,false);
        }catch (\Exception $exception){
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
        return 'فرمت تاریخ ورودی درست نیست';
    }
}
