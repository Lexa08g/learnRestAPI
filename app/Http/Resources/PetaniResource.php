<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PetaniResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'            => $this->id_penjual,
            'nama'          => $this->nama,
            'nik'           => $this->nik,
            'alamat'        => $this->alamat,
            'telp'          => $this->telp,
            'status'        => $this->status,
            'foto_url'      => $this->foto ? (filter_var($this->foto, FILTER_VALIDATE_URL) ? $this->foto : url('storage/' . $this->foto)) : null,
            'kelompok_tani' => [
                'id'            => $this->id_kelompok_tani,
                'nama_kelompok' => $this->kelompoktani?->nama_kelompok,
            ],
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
