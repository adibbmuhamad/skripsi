<?php
namespace App\Filament\Resources\AnnouncementResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\AnnouncementResource;
use App\Filament\Resources\AnnouncementResource\Api\Requests\UpdateAnnouncementRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = AnnouncementResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update Announcement
     *
     * @param UpdateAnnouncementRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdateAnnouncementRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}