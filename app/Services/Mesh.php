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
    public function getPeoplesPositions()
    {

        /* это тн. транспонирование неск. строк в одну(строку) в mysql. (пивотная табл position_staff)
           запрос делает в строку сотрудника и его неск. отделов через запятую (GROUP_CONCAT)... PMA

        SELECT staff_id, CONCAT(first_name,' ', last_name) as fio,
        GROUP_CONCAT(position_staff.position_id ORDER BY position_id) as positions
        FROM position_staff
        LEFT JOIN staff ON position_staff.staff_id = staff.id
        GROUP By staff_id

        ну и записали это все в ларин квери билдер */

        $query = DB::table('position_staff')
            ->leftJoin('staff', 'position_staff.staff_id', '=', 'staff.id')
            ->select('staff_id as id', DB::raw("CONCAT(first_name,' ', last_name) as fio"),
                DB::raw("GROUP_CONCAT(position_staff.position_id ORDER BY position_id) as positions")
            );

        //dd($query->groupByRaw('staff_id')->get());
        return $query->groupByRaw('staff_id')->get();
    }

    /**
     * Это выродившийся код но оставил для понимания предистории.
     * Подход ущербный тк. по удалению и вставке отделов id отдела меняется...
     * сетка не строится... так можно делать токо на неизменяемом (фиксиров.) наборе полей...
     */
    public function peoplesPositions()
    {

        return DB::table('position_staff')
            ->leftJoin('staff', 'position_staff.staff_id', '=', 'staff.id')
            ->select('staff_id as id', DB::raw("CONCAT(first_name,' ', last_name) as fio"),
                DB::raw("MAX(CASE WHEN position_id = 1  THEN 1 ELSE 0 END) AS p1"),
                DB::raw("MAX(CASE WHEN position_id = 2  THEN 1 ELSE 0 END) AS p2"),
                DB::raw("MAX(CASE WHEN position_id = 3  THEN 1 ELSE 0 END) AS p3"),
                DB::raw("MAX(CASE WHEN position_id = 4  THEN 1 ELSE 0 END) AS p4"),
                )
            ->groupByRaw('staff_id')
            ->get();

        /*  это отлажено в пма... код выше тоже самое, но в ларином кверибилдере.
            SELECT staff_id as id, CONCAT(first_name,' ', last_name) as fio,
            MAX(CASE WHEN position_id = 1  THEN 1 ELSE 0 END) AS p1,
            MAX(CASE WHEN position_id = 2  THEN 1 ELSE 0 END) AS p2,
            MAX(CASE WHEN position_id = 3  THEN 1 ELSE 0 END) AS p3,
            MAX(CASE WHEN position_id = 4  THEN 1 ELSE 0 END) AS p4
            FROM position_staff
            LEFT JOIN staff ON position_staff.staff_id = staff.id
            GROUP By staff_id
        */

    }

}
