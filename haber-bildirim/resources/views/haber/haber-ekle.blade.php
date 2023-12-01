<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haber Ekle</title>
</head>

<body>
    @if (Session::has('message'))
        {{ Session('message') }}
    @endif
    <h1>Haber Ekle</h1>
    <form action="{{ route('haber.ekle') }}" method="POST">
        @csrf
        <label for="baslik">Başlık:</label>
        <input type="text" name="baslik" required><br><br>
        <label for="kategori_id">Kategori:</label>
        <select name="kategori_id">
            @foreach ($kategoriler as $kategori)
                <option value="{{ $kategori->id }}">{{ $kategori->ad }}</option>
            @endforeach
        </select><br><br>
        <label for="icerik">İçerik:</label>
        <textarea name="icerik" rows="4" required></textarea><br><br>
        <label for="status">Durum:</label>
        <select name="status">
            <option value="1">Aktif</option>
            <option value="0">Pasif</option>
        </select><br><br>
        <button type="submit">Haber Ekle</button>
    </form>
</body>

</html>
