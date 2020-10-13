<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Position;

class SiteController extends Controller
{
    private $staff;

    public function __construct(Staff $staff)
    {
        $this->staff = $staff;
    }

    public function index()
    {
        $positions = Position::all();
        $peoples = $this->staff->getPeoplesPositions();
        //dd($peoples, $positions);

        return view('site.index', [
            'positions' => $positions,
            'peoples' => $peoples
        ]);
    }

    public function staff()
    {
        $peoples = Staff::with('positions')->simplePaginate(10);

        return view('site.staff', [
            'peoples' => $peoples
        ]);
    }

    public function positions()
    {
        $positions = Position::withCount('staff')->simplePaginate(10);

        return view('site.positions', [
            'positions' => $positions
        ]);
    }
}
