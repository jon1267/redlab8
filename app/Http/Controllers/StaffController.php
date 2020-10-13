<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Position;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StaffCreateRequest;
use App\Http\Requests\StaffEditRequest;

class StaffController extends Controller
{
    public function staffCreate()
    {
        //$positions = Position::pluck('position', 'id');
        $positions = Position::all('position', 'id')->toArray();
        //dd($positions);
        return view('site.staff.staff-create', ['positions' => $positions] );
    }

    public function staffStore(StaffCreateRequest $request)
    {
        $data = $request->except('_token', 'positions');
        $positions = $request->positions;
        //dd($data, $positions);

        if ($people = Staff::create($data)) {

            $people->positions()->attach($positions);

            return redirect()->route('site.staff')
                ->with(['status' => 'Сотрудник был успешно добавлен']);
        }

        $request->flash();
        return redirect()->back()
            ->with(['error' => 'Ошибка добавления сотрудника']);

    }

    public function staffEditForm($id)
    {
        $positions = Position::all('position', 'id')->toArray();

        $selectPositions = DB::table('position_staff')
            ->select('position_id')
            ->where('staff_id', $id)
            ->get()->toArray();

        $people = Staff::where('id', $id)->first();

        return view('site.staff.staff-edit', [
            'positions' => $positions,
            'people' => $people,
            'selectPositions' => $selectPositions,
            'gender' => ['мужской', 'женский'],
            //'gender' => ['мужской', 'женский', 'не определился'],
        ]);
    }

    // StaffRequest
    public function staffUpdate(StaffEditRequest $request, $id)
    {
        //dd($request);
        $staff = Staff::where('id', $id)->first();
        $data = $request->except('_token');

        if ($staff->update($data)) {
            return redirect()->route('site.staff')
                ->with(['status' => 'Данные сотрудника изменены']);
        }

        $request->flash();
        return redirect()->back()
            ->with(['error' => 'Ошибка сохранения данных']);

    }

    public function staffDestroy($id)
    {
        $people = Staff::where('id', $id)->first();

        $people->positions()->detach();

        if($people->delete()) {
            return redirect()->route('site.staff')
                ->with(['status' => 'Сотрудник был успешно удален']);
        }

        return redirect()->route('site.staff')
            ->with(['error' => 'Ошибка удаления данных']);
    }
}
