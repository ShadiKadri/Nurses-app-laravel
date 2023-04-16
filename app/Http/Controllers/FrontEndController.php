<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index(Request $request)
    {
        // Set timezone
        date_default_timezone_set('America/New_York');

        if (request('date')) {

            $formatDate = date('m-d-Y', strtotime(request('date')));

            return view('welcome', compact('formatDate'));
        };
        return view('welcome');
    }
}
