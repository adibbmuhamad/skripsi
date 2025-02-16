<?php
namespace App\Filament\Resources\HealthReportResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\HealthReport;

/**
 * @property HealthReport $resource
 */
class HealthReportTransformer extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource->toArray();
    }
}
