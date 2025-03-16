<?php
namespace App\Filament\Resources\StudentResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use App\Filament\Resources\StudentResource;
use App\Filament\Resources\StudentResource\Api\Transformers\StudentTransformer;

class PaginationHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = StudentResource::class;

    // Public API
    public static bool $public = true;

    /**
     * List of Student
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
            ->get();

        return StudentTransformer::collection($query);
    }
}
