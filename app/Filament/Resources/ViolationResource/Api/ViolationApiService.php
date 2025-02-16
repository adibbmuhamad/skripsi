<?php
namespace App\Filament\Resources\ViolationResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\ViolationResource;
use Illuminate\Routing\Router;


class ViolationApiService extends ApiService
{
    protected static string | null $resource = ViolationResource::class;

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
