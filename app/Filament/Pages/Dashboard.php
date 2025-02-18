<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Widgets\AttendanceStats;
use App\Filament\Widgets\AttendanceOverview;
use App\Filament\Widgets\StudentCountWidget;


class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-pie';

    protected static string $view = 'filament.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            AttendanceStats::class,
            StudentCountWidget::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            AttendanceOverview::class,
        ];
    }
}
