<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Ekle</title>
</head>

<body>
    <h1>Kategori Ekle</h1>

    <form action="{{ route('kategori.ekle') }}" method="POST">
        @csrf

        <label for="ad">Ad:</label>
        <input type="text" name="ad" required> <br><br>

        <label for="status">Durum:</label>
        <select name="status">
            <option value="1">Aktif</option>
            <option value="0">Pasif</option>
        </select> <br><br>

        <button type="submit">Kategori Ekle</button>
    </form>
</body>

</html>
