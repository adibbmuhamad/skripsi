<?php
namespace App\Filament\Resources\AchievementResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Achievement;

/**
 * @property Achievement $resource
 */
class AchievementTransformer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'student_name' => $this->resource->student ? $this->resource->student->name : null,
            'class_room' => $this->resource->student && $this->resource->student->classRoom ? $this->resource->student->classRoom->name : null,
            'nisn' => $this->resource->student ? $this->resource->student->nisn : null,
            'achievement_name' => $this->resource->achievement_name,
            'category' => $this->resource->category,
            'description' => $this->resource->description,
            'created_at' => $this->resource->created_at->toDateTimeString(),
            'updated_at' => $this->resource->updated_at->toDateTimeString(),
        ];
    }
}
