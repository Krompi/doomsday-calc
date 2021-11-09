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

    protected $outputs = [];

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
    public function getOutput()
    {
        return $this->outputs;
    }

    /**
     * Determines the anchor day a century.
     *
     * @param int $yyyy Year, 1-4 digits
     * @return int Anchor day number
     */
    function getCenturyAnchorday(int $yyyy): int {
        // Output
        $this->outputs["century"]          = floor($yyyy / 100);
        $this->outputs["century_steps"]    = floor($yyyy / 100) % 4;
        $this->outputs["century_doomsday"] = (9 - (floor($yyyy / 100) % 4) * 2) % 7;
        $this->outputs["century_doomsday_text"] = $this->translate($this->outputs["century_doomsday"]);

        return (9 - (floor($yyyy / 100) % 4) * 2) % 7;
    }

    /**
     * Determines the year's anchor day.
     *
     * @param int $yyyy Year, 1-4 digits
     * @return int Year anchor day
     */
    function getYearAnchorDay(int $yyyy): int {
        // Preparation
        $centuryAnchorday = $this->getCenturyAnchorday($yyyy);
        $yy = $yyyy % 100; // Year, 1-2 digits

        // Output
        $this->outputs["year"]               = $yy;
        $this->outputs["year_dozen"]         = floor($yy / 12);
        $this->outputs["year_mod_12"]        = $yy % 12;
        $this->outputs["year_mod_leap"]      = floor(($yy % 12) / 4);
        $this->outputs["year_doomsday"]      = (floor($yy / 12) +($yy % 12) + (floor(($yy % 12) / 4)) + $centuryAnchorday) % 7;
        $this->outputs["year_doomsday_text"] = $this->translate($this->outputs["year_doomsday"]);

        return (floor($yy / 12) +($yy % 12) + (floor(($yy % 12) / 4)) + $centuryAnchorday) % 7;
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
            3 => 14,
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
    // function getWeekday(int $yyyy, int $m, int $d): int {
    function getWeekday(string $date): string {
        // Preparation
        $yyyy = date('Y', strtotime($date));
        $m    = date('n', strtotime($date));
        $d    = date('j', strtotime($date));
        $doomsday = $this->getNearestDoomsday($yyyy, $m);
        $yearAnchorDay = $this->getYearAnchorDay($yyyy);

        // Output
        $this->outputs["month_nearest"]   = $doomsday;
        $this->outputs["month_day"]       = $d;
        $this->outputs["result_day"]      = ($yearAnchorDay + ($d - $doomsday) + 35) % 7;
        $this->outputs["result_day_text"] = $this->translate($this->outputs["result_day"]);

        return ($yearAnchorDay + ($d - $doomsday) + 35) % 7;
    }

    public function translate(int $day): string {
        return $this->weekdays[$day];
    }

}
