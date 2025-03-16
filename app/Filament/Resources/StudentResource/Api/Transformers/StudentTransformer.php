<?php
namespace App\Filament\Resources\StudentResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Student;

/**
 * @property Student $resource
 */
class StudentTransformer extends JsonResource
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
            'name' => $this->resource->name,
            'parent_email' => $this->resource->parent_email,
            'nisn' => $this->resource->nisn,
            'address' => $this->resource->address,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
            'class_room_id' => $this->resource->class_room_id,
            'class_room_name' => $this->resource->classRoom ? $this->resource->classRoom->name : null, // Tambahkan nama kelas
            'gender' => $this->resource->gender,
            'parent_name' => $this->resource->parent_name,
            'phone_number' => $this->resource->phone_number,
        ];
    }
}
