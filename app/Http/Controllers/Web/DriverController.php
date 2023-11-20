<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DriverController extends Controller
{
    public function getDrivers()
    {
        $getDrivers = User::where('role', 'DRIVER')->get();

        return response()->json($getDrivers);
    }

    public function addDriver(Request $request)
    {
        $addDriver = User::create([
            'role' => 'DRIVER',
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phoneNum' => $request->phoneNum,
            'barangayID' => 16,
        ]);

        return response()->json($addDriver);
    }

    public function updateDriver(Request $request, $id)
    {
        $updateDriver = User::find($id);
        $updateDriver->update($request->all());
    }

    public function deleteRider($id)
    {
        $deleteRider = User::find($id);
        $deleteRider->delete();

        return response()->json($deleteRider, 200);
    }
}
