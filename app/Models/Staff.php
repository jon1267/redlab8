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
}
