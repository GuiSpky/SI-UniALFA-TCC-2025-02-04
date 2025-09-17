<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsuarioResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome'=> $this->nome,
            'email'=> $this->email,
            'telefone'=> $this->telefone,
            'cargo'=> $this->cargo,
            'id_escola'=> $this->id_escola
        ];
    }
}
