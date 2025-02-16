<?php
namespace App\Filament\Resources\AchievementResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\AchievementResource;
use Illuminate\Routing\Router;


class AchievementApiService extends ApiService
{
    protected static string | null $resource = AchievementResource::class;

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
