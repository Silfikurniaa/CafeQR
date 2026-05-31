@extends('layouts.kasir')

@section('title', 'QR Meja')
@section('header-title', 'QR Meja')
@php($nav = 'qr')

@push('styles')
<style>
    .qr-wrap { padding: 20px 24px; }
    .intro { font-size: 14px; color: #555; margin-bottom: 16px; }
    .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 14px; }
    .qr-card {
        background: #fff; border-radius: 12px; padding: 16px; text-align: center;
        border: 1px solid #e0e0e0;
    }
    .qr-card img { width: 120px; height: 120px; margin: 10px auto; display: block; }
    .qr-card a { font-size: 12px; color: #3d6fd4; }
</style>
@endpush

@section('content')
    <div class="qr-wrap">
        <p class="intro">Tempel QR di meja agar pelanggan bisa pesan langsung.</p>
        <div class="grid">
            @foreach ($tables as $table)
                <div class="qr-card">
                    <strong>Meja {{ $table->code }}</strong>
                    <img src="{{ $table->qrImageUrl() }}" alt="QR">
                    <br>
                    <a href="{{ $table->qrImageUrl() }}" download>Unduh QR ↓</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
