<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return collect(Student::getAllStudents());
    }

    public function headings(): array
    {
        return [
            'id',
            'name',
            'gender',
            'birth',
        ];
    }
}
