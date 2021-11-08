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
        $doomsday = new DoomsdayServiceProvider('');
        return view('quiz', compact('date'));
        // dd($doomsday->getWeekday($date));
    }
}
