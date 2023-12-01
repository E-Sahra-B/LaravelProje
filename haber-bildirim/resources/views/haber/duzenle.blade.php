<!-- resources/views/haber/duzenle.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haber Düzenle</title>
</head>

<body>
    <h1>Haber Düzenle</h1>
    <form action="{{ route('haber.duzenle.kaydet', ['id' => $haber->id]) }}" method="POST">
        @csrf
        <label for="baslik">Başlık:</label>
        <input type="text" name="baslik" value="{{ $haber->baslik }}" required><br><br>
        <label for="icerik">İçerik:</label>
        <textarea name="icerik" rows="4" required>{{ $haber->icerik }}</textarea><br><br>
        <label for="kategori_id">Kategori:</label>
        <select name="kategori_id">
            @foreach ($kategoriler as $kategori)
                <option value="{{ $kategori->id }}" {{ $kategori->id == $haber->kategori_id ? 'selected' : '' }}>
                    {{ $kategori->ad }}
                </option>
            @endforeach
        </select><br><br>
        <label for="status">Durum:</label>
        <select name="status">
            <option value="1" {{ $haber->status == 1 ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ $haber->status == 0 ? 'selected' : '' }}>Pasif</option>
        </select><br><br>
        <button type="submit">Haber Düzenle</button>
    </form>
</body>

</html>
