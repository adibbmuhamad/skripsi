<?php

namespace App\Filament\Resources\AnnouncementResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\AnnouncementResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\AnnouncementResource\Api\Transformers\AnnouncementTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = AnnouncementResource::class;

    //Public API
    public static bool $public = true;


    /**
     * Show Announcement
     *
     * @param Request $request
     * @return AnnouncementTransformer
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

        return new AnnouncementTransformer($query);
    }
}
