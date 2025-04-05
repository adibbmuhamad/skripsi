<?php
namespace App\Filament\Resources\AchievementResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use App\Filament\Resources\AchievementResource;
use App\Filament\Resources\AchievementResource\Api\Transformers\AchievementTransformer;

class PaginationHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = AchievementResource::class;

    //public api key
    public static bool $public = true;


    /**
     * List of Achievement
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function handler()
    {
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for($query)
        ->allowedFields($this->getAllowedFields() ?? [])
        ->allowedSorts($this->getAllowedSorts() ?? [])
        ->allowedFilters($this->getAllowedFilters() ?? [])
        ->allowedIncludes($this->getAllowedIncludes() ?? [])
        ->allowedIncludes(['student'])
        ->paginate(request()->query('per_page'))
        ->appends(request()->query());

        return AchievementTransformer::collection($query);
    }
}
