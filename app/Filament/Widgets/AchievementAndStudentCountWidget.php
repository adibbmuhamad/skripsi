<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use App\Models\Achievement;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AchievementAndStudentCountWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Achievements', Achievement::count())
                ->description('Total Achievements')
                ->icon('heroicon-o-trophy')
                ->color('success'),

            Stat::make('Students', Student::count())
                ->description('Total registered students')
                ->icon('heroicon-o-academic-cap')
                ->color('success'),
        ];
    }
}
