<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Position;
use App\Services\Mesh;

class SiteController extends Controller
{
    private $mesh;

    public function __construct(Mesh $mesh)
    {
        $this->mesh = $mesh;
    }

    public function index()
    {
        $positions = Position::all();
        $peoples = $this->mesh->getPeoplesPositions();
        //dd($peoples, $positions, $positions->count());

        return view('site.index', [
            'positions' => $positions,
            'positionsCount' => $positions->count(),
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
