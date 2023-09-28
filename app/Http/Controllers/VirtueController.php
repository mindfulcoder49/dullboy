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
        //create a boolean to check if the count has increased by one
        $countIncreased = false;
        //check if the count has increased by one
        if ($data['count'] == $virtue->count + 1) {
            $countIncreased = true;
        }
        
        $virtue->update($data);

        
        //call reward function on this if harmful is false
        if ($data['harmful'] == false && $countIncreased == true) {
            $rewardedVirtueArray = [];

            //get random number between 1 and 5
            $randomNumber = rand(0,100);

            //define an array 0 to 5
            $rewardArray = [0,1,2,3,4,5];

            //define a weights array 10, 50, 80, 90, 98, 100
            $weightArray = [10, 50, 80, 90, 98, 100];

            $randomReward = 0;
            $rewardMessage = "";

            //loop through the weights array and check if the random number is less than the weight
            for ($i = 0; $i < count($weightArray); $i++) {
                if ($randomNumber < $weightArray[$i]) {
                    $randomReward = $rewardArray[$i];
                    break;
                }
            }

            //call reward $randomReward times
            for ($i = 0; $i < $randomReward; $i++) {
                $rewardedVirtueArray[] = $this->reward();
            }

            //check if the array is empty
            if (count ($rewardedVirtueArray) == 0) {
                $rewardMessage = "You have not been rewarded.";
            } 
            else if (count($rewardedVirtueArray) == 1) {
                $rewardMessage = count($rewardedVirtueArray) . " reward! " . $rewardedVirtueArray[0]->name . ".";
            }
            else if (count($rewardedVirtueArray) > 1) {
                //list all reward names
                $rewardMessage = count($rewardedVirtueArray) . " rewards! ";
                foreach ($rewardedVirtueArray as $rewardedVirtue) {
                    $rewardMessage .= $rewardedVirtue->name . ", ";
                }
            }
        
            //return redirect to dashboard controllers index function
            return app(DashboardController::class)->index($rewardMessage);


        }

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

    public function reward() {
        $harmfulVirtues = Auth::user()->virtues()->where('harmful', true)->get();
        
        // Check if harmful virtues is empty and return null if it is
        if ($harmfulVirtues->isEmpty()) {
            return null;
        }
    
        // Find the minimum count among all harmful virtues
        $minCount = $harmfulVirtues->min('count');
    
        // Calculate the base value to make all counts positive
        $baseValue = abs($minCount) + 1;
    
        // Create an array to hold the virtues, repeated according to their adjusted counts
        $virtueArray = [];
    
        foreach ($harmfulVirtues as $harmfulVirtue) {
            // Adjust the count to make it positive
            $adjustedCount = $harmfulVirtue->count + $baseValue;
    
            // Repeat each virtue in the array according to its adjusted count
            for ($i = 0; $i < $adjustedCount; $i++) {
                $virtueArray[] = $harmfulVirtue;
            }
        }
        // Pick a random virtue from the array

        $randomIndex = array_rand($virtueArray);
        $selectedVirtue = $virtueArray[$randomIndex];
    
        // Update the count of the selected virtue
        $selectedVirtue->count -= 1;
        $selectedVirtue->save();
    
        return $selectedVirtue;
    }
    
}
