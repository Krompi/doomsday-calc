<?php

namespace App\Providers;
// namespace Krompi\Services;

use Illuminate\Support\ServiceProvider;

class DoomsdayServiceProvider extends ServiceProvider
{

    protected $weekdays = [
        0 => 'Sunday',
        1 => 'Monday',
        2 => 'Tuesday',
        3 => 'Wednesday',
        4 => 'Thursday',
        5 => 'Friday',  
        6 => 'Saturday',
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determines the anchor day a century.
     *
     * @param int $yyyy Year, 1-4 digits
     * @return int Anchor day number
     */
    function getCenturyAnchorday(int $yyyy): int {
        return (9 - (floor($yyyy / 100) % 4) * 2) % 7;
    }

    /**
     * Determines the year's anchor day.
     *
     * @param int $yyyy Year, 1-4 digits
     * @return int Year anchor day
     */
    function getYearAnchorDay(int $yyyy): int {
        $centuryAnchorday = $this->getCenturyAnchorday($yyyy);
        $yy = $yyyy % 100; // Year, 1-2 digits

        return ($yy + floor($yy / 4) + $centuryAnchorday) % 7;
    }

    /**
     * Determines if a given year is a leap year.
     *
     * @param int $year
     * @return bool
     */
    function isLeapYear(int $year): bool {
        return $year % 4 === 0 && ($year % 100 !== 0 || $year % 400 === 0);
    }

    /**
     * Determines the Doomsday of a given month.
     *
     * @param int $yyyy Year, 1-4 digits
     * @param int $m Month, 1-2 digits
     * @return int
     */
    function getNearestDoomsday(int $yyyy, int $m): int {
        $isLeapYear = $this->isLeapYear($yyyy);
        return [
            1 => !$isLeapYear ? 3 : 4,
            2 => !$isLeapYear ? 28 : 29,
            3 => 0,
            4 => 4,
            5 => 9,
            6 => 6,
            7 => 11,
            8 => 8,
            9 => 5,
            10 => 10,
            11 => 7,
            12 => 12,
        ][$m];
    }

    /**
     * Determines the weekday of a given date.
     *
     * @param int $yyyy Year, 1-4 digits
     * @param int $m Month, 1-2 digits
     * @param int $d Day, 1-2 digits
     * @return int Number of the weekday, 0 = Sun, 6 = Sat
     */
    function getWeekday(int $yyyy, int $m, int $d): int {
        $doomsday = $this->getNearestDoomsday($yyyy, $m);
        $yearAnchorDay = $this->getYearAnchorDay($yyyy);

        return ($yearAnchorDay + ($d - $doomsday) + 35) % 7;
    }
}
