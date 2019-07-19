<?php

namespace StubVendor\StubPackage\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StubModelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        // fields
        return parent::toArray($request);
    }
}
