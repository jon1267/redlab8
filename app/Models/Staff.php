<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';

    protected $guarded = [];

    public function positions()
    {
        return $this->belongsToMany('App\Models\Position');
    }

    /**
     * get all peoples list, with positions, separated by ','
     * @return mixed
     */
    public function getPeoplesPositions()
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
