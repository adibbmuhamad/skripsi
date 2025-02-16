<?php
namespace App\Filament\Resources\AchievementResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\AchievementResource;
use App\Filament\Resources\AchievementResource\Api\Requests\UpdateAchievementRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = AchievementResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update Achievement
     *
     * @param UpdateAchievementRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdateAchievementRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}