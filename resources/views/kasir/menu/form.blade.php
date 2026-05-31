<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $item->exists ? 'Edit' : 'Tambah' }} Menu — Kasir</title>
    @include('kasir.partials.styles')
    <style>
        .form-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.08);
        }

        .field { margin-bottom: 16px; }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #444;
            margin-bottom: 6px;
        }

        input,
        select {
            width: 100%;
            padding: 10px 12px;
            border: 1.5px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
        }

        .error {
            color: #dc3545;
            font-size: 12px;
            margin-top: 4px;
        }

        .checkbox-row {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkbox-row input { width: auto; }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .emoji-preview {
            font-size: 36px;
            margin-top: 8px;
        }
    </style>
</head>

<body>

    @include('kasir.partials.nav', ['active' => 'menu'])

    <div class="content">
        <h2 style="font-size:18px;margin-bottom:16px;">
            {{ $item->exists ? 'Edit Menu' : 'Tambah Menu Baru' }}
        </h2>

        <div class="form-card">
            <form method="POST"
                action="{{ $item->exists ? route('kasir.menu.update', $item) : route('kasir.menu.store') }}">
                @csrf
                @if ($item->exists)
                    @method('PUT')
                @endif

                <div class="field">
                    <label for="name">Nama menu</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $item->name) }}" required
                        placeholder="Contoh: Nasi Goreng Spesial">
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="price">Harga (Rp)</label>
                    <input type="number" id="price" name="price" value="{{ old('price', $item->price) }}" required
                        min="0" step="500" placeholder="18000">
                    @error('price')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="category">Kategori</label>
                    <select id="category" name="category" required>
                        @foreach (['Makanan', 'Minuman'] as $cat)
                            <option value="{{ $cat }}"
                                {{ old('category', $item->category) === $cat ? 'selected' : '' }}>{{ $cat }}
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="emoji">Emoji / ikon</label>
                    <input type="text" id="emoji" name="emoji" value="{{ old('emoji', $item->emoji ?: '🍽️') }}"
                        maxlength="16" placeholder="🍳">
                    <div class="emoji-preview" id="emojiPreview">{{ old('emoji', $item->emoji ?: '🍽️') }}</div>
                </div>

                @if ($item->exists)
                    <div class="field">
                        <label class="checkbox-row">
                            <input type="checkbox" name="is_active" value="1"
                                {{ old('is_active', $item->is_active) ? 'checked' : '' }}>
                            Tampilkan di menu pelanggan
                        </label>
                    </div>
                @endif

                <div class="form-actions">
                    <button type="submit" class="btn btn-dark">
                        {{ $item->exists ? 'Simpan Perubahan' : 'Tambah Menu' }}
                    </button>
                    <a href="{{ route('kasir.menu.index') }}" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('emoji').addEventListener('input', function() {
            document.getElementById('emojiPreview').textContent = this.value || '🍽️';
        });
    </script>
</body>

</html>
