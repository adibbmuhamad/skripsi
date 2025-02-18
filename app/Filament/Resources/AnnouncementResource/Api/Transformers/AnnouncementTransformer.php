<?php
namespace App\Filament\Resources\AnnouncementResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Announcement;

/**
 * @property Announcement $resource
 */
class AnnouncementTransformer extends JsonResource
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
