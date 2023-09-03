<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployerDetails extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'user_detail' => new EmployerProfile($this->employerUser),
            'gallery_images' => $this->galleryUser,
            'video_link' => $this->videoGalleryUser,
        ];
    }
}
