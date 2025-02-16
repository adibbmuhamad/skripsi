<?php
namespace App\Filament\Resources\HealthReportResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\HealthReportResource;
use Illuminate\Routing\Router;


class HealthReportApiService extends ApiService
{
    protected static string | null $resource = HealthReportResource::class;

    public static function handlers() : array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class
        ];

    }
}
