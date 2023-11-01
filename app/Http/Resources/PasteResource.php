<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $uri
 * @property string $title
 * @property string $text
 * @property string $language
 */
class PasteResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uri' => $this->uri,
            'title' => $this->title,
            'text' => $this->text,
            'language' => $this->language
        ];
    }
}
