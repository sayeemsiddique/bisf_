<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TechnologyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'main_id' => $this->main_id,
            'type' => $this->type,
            'image' => $this->image,
            'name' => $this->name,
            'mime_type' => $this->mime_type,
            'file_name' => $this->file_name,
            'file_original_name' => $this->file_original_name,
            'description_en' => $this->description_en,
            'description_bn' => $this->description_bn,
            'file_original_name' => $this->file_original_name,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
