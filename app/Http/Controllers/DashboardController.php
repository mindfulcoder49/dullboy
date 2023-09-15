<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Vice;
use App\Models\Virtue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $virtues = Auth::user()->virtues;
        $vices = Auth::user()->vices;
        
        return Inertia::render('Dashboard', ['virtues' => $virtues, 'vices' => $vices]);
    }
}