<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

/**
 * Class Mesh (сетка)
 * Строит "сетку с псицами" из отделов - сотрудников, когда сотрудник
 * может числиться в нескольких отделах. По горизонтали -  названия отделов,
 * по вертикали первого столбца - ФИО. В строке, на пересечении столбца
 * и строки если человек числится в отделе стоит "псица". (см ПДФ в папке work)
 * Чтоб понять этот код см в App\Models\Staff метод getPeoplesPositions()
 * Токо там все тупо работает в расчете на 4 отдела. Тут парам. $positionsCount
 * (!) глючит при неск. удалениях отделов. Наверное не p1p2p3p4, а  p_id ???
 */
class Mesh
{
    public function getPeoplesPositions(int $positionsCount)
    {
        // попытка сделать универсальнее чтоб при добавлении отделов сетка тоже строилась.
        $rawString = [];
        $query = DB::table('position_staff')
            ->leftJoin('staff', 'position_staff.staff_id', '=', 'staff.id')
            ->select('staff_id as id', DB::raw("CONCAT(first_name,' ', last_name) as fio"));

        for ($i = 0; $i < $positionsCount; $i++) {
            $rawString[] = "MAX(CASE WHEN position_id = " . ($i+1) .  " THEN 1 ELSE 0 END) AS p". ($i+1);
            $query = $query->addSelect(DB::raw($rawString[$i]));
        }

        //dd($rawString);
        //dd($query->groupByRaw('staff_id')->get());
        return $query->groupByRaw('staff_id')->get();
    }

}
