<?php

namespace App\Http\Controllers\centre;

use App\Http\Controllers\Controller;
use App\Models\StudentBasicDetails;
use App\Models\Batch;
use App\Models\PlacementDetails;
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Dashboard';
        $totalStudent = StudentBasicDetails::where('created_by', Auth::guard('centre')->user()->id)->count();
        $totalBatch = Batch::where('created_by', Auth::guard('centre')->user()->id)->count();
        $totalPlacement = PlacementDetails::all()->count();
        return view('centre.dashboard', compact('title', 'totalStudent', 'totalBatch', 'totalPlacement'));
    }
}
