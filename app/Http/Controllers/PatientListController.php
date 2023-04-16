<?php

namespace App\Http\Controllers;

use App\Caring;
use Illuminate\Http\Request;

class PatientListController extends Controller
{
    public function index(Request $request)
    {
        // Set timezone
        date_default_timezone_set('America/New_York');
        if ($request->date) {
            $date = str_replace('-', '/', $request->date);
            $formatDate = date('Y-m-d', strtotime($date . $request->time));

            $bookings = array();
            if (auth()->user()->role->name == 'admin') {
                $bookings = Caring::latest()
                    ->where('time', 'like', "$formatDate %")
                    ->get();
            } else {
                $bookings = Caring::latest()
                    ->where('nurse_id', auth()->user()->id)
                    ->where('time', 'like', "$formatDate %")
                    ->get();
            }

            return view('admin.patientlist.index', compact('bookings', 'date'));
        };

        $formatDate = date('Y-m-d', strtotime(now()));

        $bookings = array();

        if (auth()->user()->role->name == 'admin') {
            $bookings = Caring::latest()
                ->where('time', 'like', "$formatDate %")
                ->get();
        } else {
            $bookings = Caring::latest()
                ->where('nurse_id', auth()->user()->id)
                ->where('time', 'like', "$formatDate %")
                ->get();
        }

        return view('admin.patientlist.index', compact('bookings'));
    }

    public function allTimeAppointment()
    {
        $bookings = array();

        if (auth()->user()->role->name == 'admin') {
            $bookings = Caring::latest()
                ->paginate(20);
        } else {
            $bookings = Caring::latest()
                ->where('nurse_id', auth()->user()->id)
                ->paginate(20);
        }
        return view('admin.patientlist.all', compact('bookings'));
    }
}
