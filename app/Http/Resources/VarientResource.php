<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VarientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image' => $this->image,
            'name' => $this->name,
            'category_id' => $this->category_id,
            'mime_type' => $this->mime_type,
            'description_en' => $this->description_en,
            'description_bn' => $this->description_bn,
            'status' => $this->status,
            'type' => $this->type,
            'file_name' => $this->file_name,
            'file_original_name' => $this->file_original_name,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
