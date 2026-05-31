<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['table_id', 'items', 'status', 'payment_method'];

    protected $casts = ['items' => 'array'];

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', Carbon::today());
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['Baru', 'Diproses', 'SiapBayar']);
    }

    public function orderCode(): string
    {
        return '#'.str_pad((string) $this->id, 4, '0', STR_PAD_LEFT);
    }

    public function totalAmount(): int
    {
        $items = is_array($this->items) ? $this->items : [];

        return collect($items)->sum(fn ($i) => ($i['price'] ?? 0) * ($i['qty'] ?? 0));
    }

    public function itemNotes(): array
    {
        $items = is_array($this->items) ? $this->items : [];

        return collect($items)->pluck('note')->filter()->unique()->values()->all();
    }

    public static function revenueToday(): int
    {
        return static::today()->where('status', 'Selesai')->get()->sum(fn ($o) => $o->totalAmount());
    }

    public static function countToday(): int
    {
        return static::today()->where('status', 'Selesai')->count();
    }

    public static function countYesterday(): int
    {
        return static::whereDate('created_at', Carbon::yesterday())->where('status', 'Selesai')->count();
    }

    public static function revenueYesterday(): int
    {
        return static::whereDate('created_at', Carbon::yesterday())->where('status', 'Selesai')->get()->sum(fn ($o) => $o->totalAmount());
    }
}
