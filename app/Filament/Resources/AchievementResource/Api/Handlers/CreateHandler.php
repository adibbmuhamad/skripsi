<?php
namespace App\Filament\Resources\AchievementResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\AchievementResource;
use App\Filament\Resources\AchievementResource\Api\Requests\CreateAchievementRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = AchievementResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Achievement
     *
     * @param CreateAchievementRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateAchievementRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}