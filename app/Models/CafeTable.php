<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CafeTable extends Model
{
    protected $fillable = ['code', 'is_active', 'sort_order'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('code');
    }

    public function menuUrl(): string
    {
        return route('customer.menu', $this->code);
    }

    public function qrImageUrl(): string
    {
        return 'https://api.qrserver.com/v1/create-qr-code/?size=140x140&data='.urlencode($this->menuUrl());
    }
}
