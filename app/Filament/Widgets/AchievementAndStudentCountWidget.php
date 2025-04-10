<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use App\Models\Achievement;
use App\Models\ClassRoom;
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

            Stat::make('Class Rooms', ClassRoom::count())
                ->description('Total Class Rooms')
                ->icon('heroicon-o-building-office')
                ->color('success'),
        ];
    }
}
