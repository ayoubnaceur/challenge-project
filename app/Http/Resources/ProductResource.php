<?php

namespace App\Http\Resources;

use Illuminate\Support\Arr;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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

        $categories = $this->categories;
        $categoriesIds = Arr::pluck($categories, 'id');
        $categoriesNames = Arr::pluck($categories, 'name');

        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'image' => $this->image,
            'categories' => ['names' => $categoriesNames, 'ids' => $categoriesIds]
        ];
    }
}
