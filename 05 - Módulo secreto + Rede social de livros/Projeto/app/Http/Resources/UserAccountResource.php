<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $photo = '';

        if ($this->photo == null) {
            $photo = asset('assets/img/user_profile.png');
        } else {
            $dir = env('USER_DIR_PROFILE_UPLOAD');

            $photo =  "/storage/{$dir}{$this->photo}";
        }

        return [
            'name'  => $this->name,
            'bio'   => $this->bio,
            'photo' => $photo,
        ];
    }
}
