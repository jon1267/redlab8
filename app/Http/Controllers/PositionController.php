<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Requests\PositionRequest;

class PositionController extends Controller
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
        return view('site.position.position-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PositionRequest  $request
     * @return mixed
     */
    public function store(PositionRequest $request)
    {
        //dd($request);

        if (Position::create($request->except('_token'))) {
            return redirect()->route('site.positions')
                ->with(['status' => 'Отдел был успешно добавлен']);
        }

        $request->flash();
        return redirect()->back()
            ->with(['error' => 'Ошибка добавления отдела']);



    }

    /**
     * Display the specified resource.
     *
     * @param  Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Position  $position
     * @return mixed
     */
    public function edit(Position $position)
    {
        return view('site.position.position-create', ['position' => $position]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PositionRequest  $request
     * @param  Position  $position
     * @return mixed
     */
    public function update(PositionRequest $request, Position $position)
    {
        //dd($request, $position);
        $data = $request->except('_token', '_method');

        if ($position->update($data)) {
            return redirect()->route('site.positions')
                ->with(['status' => 'Данные отдела изменены']);
        }

        $request->flash();
        return redirect()->back()
            ->with(['error' => 'Ошибка сохранения данных']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        try {
            $position->delete();
            return redirect()->route('site.positions')
                ->with(['status' => 'Отдел был успешно удален']);

        } catch (\Throwable $e) {
            return redirect()->back()
                ->with(['error' => 'Ошибка удаления. Возможно в отделе есть сотрудники.']);
        }



    }
}
