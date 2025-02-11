<?php

namespace App\Filament\Resources\HealthReportResource\Pages;

use App\Filament\Resources\HealthReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHealthReports extends ListRecords
{
    protected static string $resource = HealthReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
