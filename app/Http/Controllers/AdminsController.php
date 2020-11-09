<?php

namespace VRSAdmin\Http\Controllers;

use Illuminate\Http\Request;
use VRSAdmin\User;
use VRSAdmin\Vehicle;
use VRSAdmin\Customer;
use VRSAdmin\RentalRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Support\Facades\Input;
use DB;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createAdmin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|unique:admins|string|email',
            'password' => 'required|string'
        ]);
        $admin = new User();
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->role = Input::get("role");
        $admin->password = Hash::make ($request->input('password'));
        $admin->save();

        return redirect('/index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicle=Vehicle::find($id);
        $vehicle->delete();

        return redirect('/manageVehicles');
    }

    public function destroyAdmins($id)
    {
        $admin=User::find($id);
        $admin->delete();

        return redirect('/manageAdmins');
    }

    public function updateUserStatus(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->status = Input::get("status");
        $customer->save();

        $customerId = Customer::find($id);
        $vehicleStatus = Vehicle::where('user_id', $id)
        ->update(['availability' => 'Unavailable']);

        return redirect('/manageUsers')->with('success', 'User status was updated successfully (:');
    }

    public function updateAdminRole(Request $request, $id)
    {
        $admin = User::find($id);
        $admin->role = Input::get("role");
        $admin->save();

        return redirect('/manageAdmins')->with('success', 'Admins role was updated successfully (:');
    }

    public function updateAds(Request $request, $id)
    {
        $vehicle = Vehicle::find($id);
        $vehicle->ads = Input::get("ads");
        $vehicle->save();

        return redirect('/manageVehicles');
    }

    public function profitReceived(Request $request, $id)
    {
        $rentalRecord = RentalRecord::find($id);
        $rentalRecord->profit_received = $request->input("profitStatus");
        $rentalRecord->save();

        return redirect('/rentalRecords');
    }
}
