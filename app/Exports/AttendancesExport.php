<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class AttendancesExport implements FromCollection, WithHeadings, WithMapping
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
            'Student Name',
            'Class',
            'Status',
            'Date',
            'Permission Reason',
            'Parent Email',
            'NISN',
            'Address',
        ];
    }

    public function map($attendance): array
    {
        return [
            $attendance->student->name,
            $attendance->student->class,
            $attendance->status,
            $attendance->date,
            $attendance->permission_reason ?? '-',
            $attendance->student->parent_email,
            $attendance->student->nisn,
            $attendance->student->address,
        ];
    }
}
