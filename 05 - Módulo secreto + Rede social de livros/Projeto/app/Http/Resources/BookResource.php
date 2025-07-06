<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $cover = '';

        if ($this->cover === null) {
            $cover = asset('assets/img/no_book_photo.png');
        } else {
            $dir = env('BOOK_DIR_UPLOAD', 'uploads/books/');
            $cover = "/storage/{$dir}{$this->cover}";
        }

        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'author'      => $this->author,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'category_name' => $this->category->name,
            'user_id'     => $this->user_id,
            'complete'    => $this->complete,
            'favorite'    => $this->favorite,
            'stars'       => $this->stars,
            'cover'       => $cover,
            'created_at'  => date('d/m/Y H:i:s', strtotime($this->created_at)),
        ];
    }
}
