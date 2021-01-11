<?php

namespace App\Http\Resources;

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

        $c = $this->categories;
        $cids = Arr::pluck($c, 'id');
        $cnames = Arr::pluck($c, 'name');

        return [
            'id' => $p->id,
            'name' => $p->name,
            'price' => $p->price,
            'image' => $p->image,
            'categories' => ['names' => $cnames, 'ids' => $cids]
        ];
    }
}
