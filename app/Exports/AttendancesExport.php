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
            'Class Room',
            'Status',
            'Date',
            'Clock In',
            'Clock Out',
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
            $attendance->student->classRoom->name,
            $attendance->status,
            $attendance->date,
            $attendance->clock_in ?? '-', // Add clock_in
            $attendance->clock_out ?? '-', // Add clock_out
            $attendance->permission_reason ?? '-',
            $attendance->student->parent_email,
            $attendance->student->nisn,
            $attendance->student->address,
        ];
    }
}
