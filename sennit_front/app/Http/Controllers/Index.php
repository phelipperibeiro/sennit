<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Cep as Cep_Model;

class Index extends Controller
{

    public function home()
    {
        if (!session()->get('token')) {
            return redirect('login');
        }
        
        return view('index', ['token' => session()->get('token')]);
    }

    public function company()
    {   
        if (!session()->get('token')) {
            return redirect('login');
        }
        
        return view('company', ['token' => session()->get('token')]);
    }

}
