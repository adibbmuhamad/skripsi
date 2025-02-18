<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AttendanceStats extends BaseWidget
{
    protected function getStats(): array
    {
        $total = Attendance::count();
        $present = Attendance::where('status', 'present')->count();
        $absent = Attendance::where('status', 'absent')->count();
        $permission = Attendance::where('status', 'permission')->count();

        return [
            Stat::make('Absence', $total)
                ->color('primary')
                ->icon('heroicon-o-calendar-days')
                ->description('Total attendance records'),

            Stat::make('Present', $present)
                ->description(round(($present/$total)*100, 2).'%')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 9])
                ->icon('heroicon-o-check-circle'),

            Stat::make('Absent', $absent)
                ->description(round(($absent/$total)*100, 2).'%')
                ->color('danger')
                ->chart([7, 2, 10, 3, 15, 4, 9])
                ->icon('heroicon-o-x-circle'),

            Stat::make('Permission', $permission)
                ->description(round(($permission/$total)*100, 2).'%')
                ->color('warning')
                ->chart([7, 2, 10, 3, 15, 4, 9])
                ->icon('heroicon-o-clipboard-document-check'),

            Stat::make('Students', Student::count())
                ->description('Total registered students')
                ->icon('heroicon-o-academic-cap')
                ->color('success'),
        ];
    }
}
