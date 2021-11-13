<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\DoomsdayServiceProvider;

class QuizController extends Controller
{
    public function getRandom(Request $request) {
        $validated = $request->validate([
            'from' => 'required|date|before:to',
            'to'   => 'required|date|after:from',
        ]);
        return redirect('/date/' . date('Y-m-d', mt_rand(strtotime($validated['from']), strtotime($validated['to']))));
    }

    public function start($date) {
        $doomsday  = new DoomsdayServiceProvider('');
        $doomsday->getWeekday($date);
        // $centuryDD = $doomsday->translate($doomsday->getCenturyAnchorday(date('Y', strtotime($date))));
        // $yearDD    = $doomsday->translate($doomsday->getYearAnchorDay(date('Y', strtotime($date))));
        // $weekDD     = $doomsday->translate($doomsday->getWeekday(date('Y', strtotime($date))));
        // dd($doomsday->getOutput());
        return view(
                'quiz', 
                [
                    "date"   => $date,
                    "weekdays"   => $doomsday->getWeekdays(),
                    "output" => $doomsday->getOutput()
                ]
            );
        // dd($doomsday->getWeekday($date));
    }
}
