<?php

namespace App\Filament\Resources\HealthReportResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\HealthReportResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\HealthReportResource\Api\Transformers\HealthReportTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = HealthReportResource::class;

    //Public API
    public static bool $public = true;


    /**
     * Show HealthReport
     *
     * @param Request $request
     * @return HealthReportTransformer
     */
    public function handler(Request $request)
    {
        $id = $request->route('id');

        $query = static::getEloquentQuery();

        $query = QueryBuilder::for(
            $query->where(static::getKeyName(), $id)
        )
            ->first();

        if (!$query) return static::sendNotFoundResponse();

        return new HealthReportTransformer($query);
    }
}
