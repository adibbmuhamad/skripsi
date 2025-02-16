<?php

namespace App\Filament\Resources\AchievementResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\AchievementResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\AchievementResource\Api\Transformers\AchievementTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = AchievementResource::class;

    //public api key
    public static bool $public = true;


    /**
     * Show Achievement
     *
     * @param Request $request
     * @return AchievementTransformer
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

        return new AchievementTransformer($query);
    }
}
