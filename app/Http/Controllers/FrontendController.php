<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use App\Models\Service;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $barbers = Barber::where('is_active', true)->get();
        $services = Service::where('is_active', true)->get();
        
        return view('welcome', compact('barbers', 'services'));
    }
}
