<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Virtue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index( $message = null )
    {
        $virtues = Auth::user()->virtues()->orderBy('harmful', 'asc')->orderBy('name','asc')->get();
        return Inertia::render('Dashboard', ['virtues' => $virtues, 'message' => $message]);
    }

    public function update(Request $request)
    {
 
        $virtueId = $request->input('id'); // Assuming virtue ID is passed as virtue.id
        $virtue = Virtue::where('id', $virtueId)->where('user_id', Auth::id())->first();
        
        if (!$virtue) {
            abort(403);
        } else {
            //call the virtueController update method
            $virtueController = new VirtueController();
            return $virtueController->update($request, $virtue);
        }
    }
    
}
