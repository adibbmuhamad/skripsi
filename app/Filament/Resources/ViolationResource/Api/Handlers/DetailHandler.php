<?php

namespace App\Filament\Resources\ViolationResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\ViolationResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\ViolationResource\Api\Transformers\ViolationTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = ViolationResource::class;

    //Public API
    public static bool $public = true;


    /**
     * Show Violation
     *
     * @param Request $request
     * @return ViolationTransformer
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

        return new ViolationTransformer($query);
    }
}
