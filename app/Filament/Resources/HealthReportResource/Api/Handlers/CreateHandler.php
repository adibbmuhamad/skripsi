<?php
namespace App\Filament\Resources\HealthReportResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\HealthReportResource;
use App\Filament\Resources\HealthReportResource\Api\Requests\CreateHealthReportRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = HealthReportResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create HealthReport
     *
     * @param CreateHealthReportRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateHealthReportRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}