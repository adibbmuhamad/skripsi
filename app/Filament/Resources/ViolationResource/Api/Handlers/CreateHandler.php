<?php
namespace App\Filament\Resources\ViolationResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\ViolationResource;
use App\Filament\Resources\ViolationResource\Api\Requests\CreateViolationRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = ViolationResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Violation
     *
     * @param CreateViolationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateViolationRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}