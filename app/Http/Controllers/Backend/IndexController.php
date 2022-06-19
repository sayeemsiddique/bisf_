<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

/* included models */
use App\Models\User;

use App\Models\Division;
use App\Models\Role;

class IndexController extends Controller
{
    public function adminDashboard()
    {
        menuSubmenu('dashboard', 'dashboard');
        
        return view('backend.index');
    }
}
