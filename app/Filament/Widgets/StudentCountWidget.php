<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StudentCountWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Students', Student::count())
                ->description('Jumlah siswa terdaftar')
                ->descriptionIcon('heroicon-o-academic-cap')
                ->color('success'),
        ];
    }
}
