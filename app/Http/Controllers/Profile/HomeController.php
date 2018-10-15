<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Client;
use App\Service;
use App\Schedule;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if (!Auth::user()->first_access) {
            $user = User::find(Auth::user()->id);
            $user->first_access = true;
            $user->save();
        }

        $usuarios = User::where('is_active', true)
            ->where('id', '!=', 1)
            ->get()
            ->count();

        $clientes = Client::count('id');

        $servicos = Service::count('id');
        
        $valor = Schedule::sum('value');

        return view('profile.dashboard')->with(compact('usuarios','clientes', 'servicos', 'valor'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = User::find(Auth::user()->id);
        return view('profile.profile')->with(compact('user'));
    }


}
