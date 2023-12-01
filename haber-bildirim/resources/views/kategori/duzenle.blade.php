<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Düzenle</title>
</head>

<body>
    <h1>Kategori Düzenle</h1>

    <form action="{{ route('kategori.duzenle.kaydet', ['id' => $kategori->id]) }}" method="POST">
        @csrf
        <label for="ad">Ad:</label>
        <input type="text" name="ad" value="{{ $kategori->ad }}" required><br><br>
        <label for="status">Durum:</label>
        <select name="status">
            <option value="1" {{ $kategori->status == 1 ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ $kategori->status == 0 ? 'selected' : '' }}>Pasif</option>
        </select><br><br>
        <button type="submit">Kategori Düzenle</button>
    </form>
</body>

</html>
