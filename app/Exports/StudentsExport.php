<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $filteredData;

    public function __construct($filteredData)
    {
        $this->filteredData = $filteredData;
    }

    public function collection()
    {
        return $this->filteredData;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Class Room',
            'Parent Email',
            'NISN',
            'Address',
        ];
    }

    public function map($student): array
    {
        return [
            $student->name,
            $student->classRoom->name ?? 'N/A',
            $student->parent_email,
            $student->nisn,
            $student->address,
        ];
    }
}
