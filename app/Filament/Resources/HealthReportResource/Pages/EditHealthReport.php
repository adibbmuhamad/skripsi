<?php

namespace App\Filament\Resources\HealthReportResource\Pages;

use App\Filament\Resources\HealthReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHealthReport extends EditRecord
{
    protected static string $resource = HealthReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
