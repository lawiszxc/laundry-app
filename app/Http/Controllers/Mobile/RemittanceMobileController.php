<?php

namespace App\Http\Controllers\Mobile;

use App\Models\Remittance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RemittanceMobileController extends Controller
{
    public function getRemittances()
    {
        $auth = Auth::user()->id;

        $remittances = Remittance::selectRaw('userID, SUM(collected) as totalCollected')
        ->selectRaw('userID, (status) as remittanceStatus')
        ->selectRaw('userID, (created_at) as remittanceDate')
        ->where('userID', $auth)
        // ->with('user')
        ->whereDate('created_at', Carbon::today())
        ->groupBy('userID')
        ->get();

        return response()->json($remittances);
    }
}
