<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->title,
            'slug' => $this->slug,
            'conteudo' => $this->body,
            'publicado_em' => $this->created_at->format('d/m/Y H:i'),
            'autor' => $this->user->name, // Pega o nome do autor pelo relacionamento
        ];
    }
}
