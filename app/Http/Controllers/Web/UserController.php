<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers()
    {
        $user = User::with('barangay')
        ->where('role', 'USER')->get();

        return response()->json($user);
    }

    public function updateBlock($id, Request $request)
    {
        $user = User::find($id);
        $user->update([
            'status' => $request->status
        ]);
    }
}
