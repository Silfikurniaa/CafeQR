<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'name',
        'price',
        'category',
        'emoji',
        'stock',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'price' => 'integer',
            'stock' => 'integer',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('category')->orderBy('name');
    }

    public function stockStatus(): string
    {
        if ($this->stock <= 0) {
            return 'habis';
        }
        if ($this->stock <= config('cafe.low_stock_threshold', 5)) {
            return 'sedikit';
        }

        return 'ok';
    }

    public function stockLabel(): string
    {
        return match ($this->stockStatus()) {
            'habis' => 'Habis',
            'sedikit' => 'Sedikit',
            default => (string) $this->stock,
        };
    }

    public function toMenuArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'category' => $this->category,
            'emoji' => $this->emoji,
        ];
    }
}
