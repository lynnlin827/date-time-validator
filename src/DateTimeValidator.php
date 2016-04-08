<?php

namespace DateTimeValidator;

use Carbon\Carbon;

class DateTimeValidator
{
    const YEAR = 'Y';
    const MONTH = 'm';
    const DAY = 'd';
    const WEEK = 'w';

    const SIX_MONTHS = '6m';

    /**
     * To validate the value whether is in the given time period, which is 6 months by default
     *
     * @param  string       attribute
     * @param  string       value
     * @param  array        parameters
     * @param  validator    Illuminate\Support\Validator
     * @return boolean
     */
    public function during($attribute, $value, $parameters, $validator)
    {
        $result = false;

        $startDate = Carbon::parse($value);
        $endDate = (isset($parameters[0]) && isset($validator->getData()[$parameters[0]])) ? Carbon::parse($validator->getData()[$parameters[0]]) : Carbon::today();

        $timeInterval = (isset($parameters[1])) ? $parameters[1] : self::SIX_MONTHS;
        $timeIntervalUnit = substr($timeInterval, -1);
        $timeIntervalLength = substr($timeInterval, 0, strlen($timeInterval) - 1);

        switch ($timeIntervalUnit) {
            case self::YEAR:
                $endDate->subYears($timeIntervalLength);
                break;
            case self::MONTH:
                $endDate->subMonths($timeIntervalLength);
                break;
            case self::DAY:
                $endDate->subDays($timeIntervalLength);
                break;
            case self::WEEK:
                $endDate->subWeeks($timeIntervalLength);
                break;
        }

        $result = ($startDate >= $endDate) ? true : false ;
        return $result;
    }

    public function duringMessage($message, $attribute, $rule, $parameters)
    {
        return 'The given time interval is longer than the specific period';
    }
}
