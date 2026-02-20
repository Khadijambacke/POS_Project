<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Http\Requests\Auth\LoginRequest;

class DashboardController extends Controller
{
    //
    public function index()
    { 
        $user = Auth::user(); 
        ///check
        //dd($user):permet de voir l'errur comme cho
        if (!$user) {
            return redirect()->route('show.register'); 
        }
       if ($user->role === 'admin') {
    return view('dashboard.dashboardAdmin');
} elseif ($user->role === 'caissier') {
    return view('dashboard.dashboarCaissier');
} 

    }
}
