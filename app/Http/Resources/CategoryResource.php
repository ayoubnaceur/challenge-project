<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Support\Arr;
use App\Http\Resources\CategoryResource;    
use Illuminate\Http\Resources\Json\JsonResource;


class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        // return required fields only
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category_id' => $this ->category_id
        ];
    }
}
