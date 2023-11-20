<?php

namespace App\Http\Controllers\Web;

use App\Models\Bleach;
use App\Models\Service;
use App\Models\Barangay;
use App\Models\Detergent;
use App\Models\LaundryKilo;
use App\Models\LaundryLoad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class LaundrySettingController extends Controller
{
    // LAUNDRY LOAD
    public function getLaundryLoads() {
        $getLaundryLoads = LaundryLoad::all();

        return response()->json($getLaundryLoads, 200);
    }

    public function updateLaundryLoads(Request $request, $id) {
        $updateLaundryLoads = LaundryLoad::find($id);
        $updateLaundryLoads->update([
            'price' => $request->price
        ]);

        return response()->json($updateLaundryLoads, 200);
    }


    // LAUNDRY KILO
    public function getLaundryKilos() {
        $getLaundryKilos = LaundryKilo::orderBy('type', 'asc')->get();

        return response()->json($getLaundryKilos, 200);
    }

    public function addLaundryKilo(Request $request) {
        $addLaundryKilo = LaundryKilo::create($request->all());

        return response()->json($addLaundryKilo, 200);
    }

    public function updateLaundryKilo(Request $request, $id) {
        $updateLaundryKilo = LaundryKilo::find($id);
        $updateLaundryKilo->update([
            'type' => $request->type,
            'price' => $request->price,
        ]);

        return response()->json($updateLaundryKilo, 200);
    }

    public function deleteLaundryKilo($id) {
        $deleteLaundryKilo = LaundryKilo::find($id);
        $deleteLaundryKilo->delete();

        return response()->json($deleteLaundryKilo, 200);
    }


    // SERVICE
    public function getServices() {
        $getServices = Service::orderBy('type', 'asc')->get();

        return response()->json($getServices, 200);
    }

    public function addService(Request $request) {
        $addService = Service::create($request->all());

        return response()->json($addService, 200);
    }

    public function updateService(Request $request, $id) {
        $updateService = Service::find($id);
        $updateService->update([
            'type' => $request->type,
            'price' => $request->price,
        ]);

        return response()->json($updateService, 200);
    }

    public function deleteService($id) {
        $deleteService = Service::find($id);
        $deleteService->delete();

        return response()->json($deleteService, 200);
    }


    // DETERGENT
    public function getDetergents() {
        $getDetergents = Detergent::orderByRaw("CASE WHEN type = 'Customer Provided' THEN 0 ELSE 1 END, type ASC")->get();

        return response()->json($getDetergents, 200);
    }

    public function addDetergent(Request $request) {
        $addDetergent = Detergent::create($request->all());

        return response()->json($addDetergent, 200);
    }

    public function updateDetergent(Request $request, $id) {
        $updateDetergent = Detergent::find($id);
        $updateDetergent->update([
            'type' => $request->type,
            'price' => $request->price,
        ]);

        return response()->json($updateDetergent, 200);
    }

    public function deleteDetergent($id) {
        $deleteDetergent = Detergent::find($id);
        $deleteDetergent->delete();

        return response()->json($deleteDetergent, 200);
    }


    // BLEACH
    public function getBleaches() {
        $getBleaches = Bleach::orderByRaw('
        CASE
            WHEN type = "N/A" THEN 0
            WHEN type = "Customer Provided" THEN 1
            ELSE 2
        END, type ASC')
        ->get();

        return response()->json($getBleaches, 200);
    }

    public function addBleach(Request $request) {
        $addBleach = Bleach::create($request->all());

        return response()->json($addBleach, 200);
    }

    public function updateBleach(Request $request, $id) {
        $updateBleach = Bleach::find($id);
        $updateBleach->update([
            'type' => $request->type,
            'price' => $request->price,
        ]);

        return response()->json($updateBleach, 200);
    }

    public function deleteBleach($id) {
        $deleteBleach = Bleach::find($id);
        $deleteBleach->delete();

        return response()->json($deleteBleach, 200);
    }


    // BARANGAY
    public function getBarangays() {
        $getBarangays = Barangay::orderBy('barangay', 'asc')->get();

        return response()->json($getBarangays, 200);
    }

    public function addBarangay(Request $request) {
        $addBarangay = Barangay::create($request->all());

        return response()->json($addBarangay, 200);
    }

    public function updateBarangay(Request $request, $id) {
        $updateBarangay = Barangay::find($id);
        $updateBarangay->update([
            'barangay' => $request->barangay,
            'price' => $request->price,
        ]);

        return response()->json($updateBarangay, 200);
    }

    public function deleteBarangay($id) {
        $deleteBarangay = Barangay::find($id);
        $deleteBarangay->delete();

        return response()->json($deleteBarangay, 200);
    }

}
