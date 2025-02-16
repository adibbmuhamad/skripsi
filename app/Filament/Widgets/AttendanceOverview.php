<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class AttendanceOverview extends ChartWidget
{
    protected static ?string $heading = 'Last 30 Days Attendance Statistics';
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = Trend::model(Attendance::class)
            ->between(
                start: now()->subDays(30),
                end: now(),
            )
            ->perDay()
            ->dateColumn('date')
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Total Attendance',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor' => '#3B82F6',
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
