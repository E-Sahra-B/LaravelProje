<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategoriler</title>
</head>

<body>
    @if (Session::has('message'))
        {{ Session('message') }}
    @endif
    <h1>Kategoriler</h1>
    <a href="{{ route('kategori.ekle.form') }}">Yeni Kategori Ekle</a>
    <table border="1">
        <thead>
            <tr>
                <th>Ad</th>
                <th>Durum</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kategoriler as $kategori)
                <tr>
                    <td>{{ $kategori->ad }}</td>
                    <td>{{ $kategori->status == 1 ? 'Aktif' : 'Pasif' }}</td>
                    <td>
                        <a href="{{ route('kategori.duzenle.form', ['id' => $kategori->id]) }}">Düzenle</a>
                        <a href="{{ route('kategori.sil', ['id' => $kategori->id]) }}"
                            onclick="return confirm('Kategoriyi silmek istediğinize emin misiniz?')">Sil</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Henüz kategori bulunmamaktadır.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
