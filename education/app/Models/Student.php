<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'birth',
        'course_id'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public static function getAllStudents()
    {
        $result = DB::table('students')
            ->select(
                'id',
                'name',
                'gender',
                'birth',
            )
            ->get()->toArray();
        return $result;
    }
}
