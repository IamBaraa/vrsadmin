<?php

namespace VRSAdmin\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    public function manageUsers()
    {
        return view('manageUsers');
    }

    public function manageVehicles()
    {
        return view('manageVehicles');
    }

    public function rentalRecords()
    {
        return view('rentalRecords');
    }

    public function manageAdmins()
    {
        return view('manageAdmins');
    }

    public function Chart(){

        return view('chart');

    }

}
