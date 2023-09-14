<?php

namespace App\Http\Controllers;

use App\Models\Virtue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class VirtueController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $virtues = Auth::user()->virtues;
        
        return Inertia::render('Dashboard', ['virtues' => $virtues]);
    }

    public function create()
    {
        return Inertia::render('Virtues/Create');
    }

    public function store(Request $request)
    {
        
        $data = $request->validate([
            'virtueData' => 'required|json'
        ]);

        $data['data'] = $request->input('virtueData');
        Auth::user()->virtues()->create($data);
    
        //return redirect()->route('virtues.index');
    }

    public function show(Virtue $virtue)
    {
        // Ensure the virtue belongs to the user
        if ($virtue->user_id !== Auth::id()) {
            abort(403);
        }

        return Inertia::render('Virtues/Show', ['virtue' => $virtue]);
    }

    public function update(Request $request, Virtue $virtue)
    {
        // Ensure the virtue belongs to the user
        if ($virtue->user_id !== Auth::id()) {
            abort(403);
        }

        $data = $request->validate([
            'data' => 'required|json'
        ]);

        $virtue->update($data);

        return redirect()->route('virtues.index');
    }

    public function destroy(Virtue $virtue)
    {
        // Ensure the virtue belongs to the user
        if ($virtue->user_id !== Auth::id()) {
            abort(403);
        }

        $virtue->delete();
        return redirect()->route('virtues.index');
    }
}
