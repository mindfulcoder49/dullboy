<?php

namespace App\Http\Controllers;

use App\Models\Virtue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Controllers\DashboardController;

class VirtueController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $virtues = Auth::user()->virtues;
        
        return Inertia::render('Virtues/Index', ['virtues' => $virtues]);
    }

    public function create()
    {
        return Inertia::render('Virtues/Create');
    }

    public function store(Request $request)
    {
        
        $data = $request->validate([
            'name' => 'required|string',
            'count' => 'required|integer',
            'timeinterval' => 'required|integer',
            'harmful' => 'boolean',
        ]);
        
        Auth::user()->virtues()->create($data);

        //call reward function on this if harmful is false
        if ($data['harmful'] == false) {
            $rewardedVirtue = $this->reward();
        }
    
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
            'name' => 'required|string',
            'count' => 'required|integer',
            'timeinterval' => 'required|integer',
            'harmful' => 'boolean'
        ]);
        
        $virtue->update($data);

        
        //call reward function on this if harmful is false
        if ($data['harmful'] == false) {
            $rewardedVirtue = $this->reward();
        }

        //return redirect to dashboard controllers index function
        //return redirect()->route('dashboard');

    }

    public function destroy(Virtue $virtue)
    {
        // Ensure the virtue belongs to the user
        if ($virtue->user_id !== Auth::id()) {
            abort(403);
        }

        $virtue->delete();
        //return redirect()->route('virtues.index');
    }

    //public function reward that chooses a random virtue with harmful = true and subtracts 1 from count. the chosen harmful virtue should be weighted by the percentage the count of each harmful virtue is the total count of all harmful virtues.
    public function reward() {
        $harmfulVirtues = Auth::user()->virtues()->where('harmful', true)->get();
        //check if harmful virtues is empty and return null if it is
        if ($harmfulVirtues->isEmpty()) {
            return null;
        }
        $totalHarmfulCount = 0;
        foreach ($harmfulVirtues as $harmfulVirtue) {
            $totalHarmfulCount += $harmfulVirtue->count + 10;
        }
        $randomNumber = rand(0, $totalHarmfulCount);
        $currentCount = 0;
        foreach ($harmfulVirtues as $harmfulVirtue) {
            $currentCount += $harmfulVirtue->count + 10;
            if ($currentCount >= $randomNumber) {
                $harmfulVirtue->count -= 1;
                $harmfulVirtue->save();
                return $harmfulVirtue;
                break;
            }
        }
    }
}
