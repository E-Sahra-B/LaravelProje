<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haberler</title>
</head>

<body>
    @if (Session::has('message'))
        {{ Session('message') }}
    @endif
    <h1>Haberler</h1>
    <a href="{{ route('haber') }}">Yeni Haber Ekle</a>
    <table border="1">
        <thead>
            <tr>
                <th>Başlık</th>
                <th>İçerik</th>
                <th>Kategori</th>
                <th>Tarih</th>
                <th>Durum</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($haberler as $haber)
                <tr>
                    <td>{{ $haber->baslik }}</td>
                    <td>{{ $haber->icerik }}</td>
                    <td>{{ $haber->kategori->ad }}</td>
                    <td>{{ $haber->created_at->format('d.M.Y') }}</td>
                    <td>{{ $haber->status == 1 ? 'Aktif' : 'Pasif' }}</td>
                    <td>
                        <a href="{{ route('haber.duzenle', ['id' => $haber->id]) }}">Düzenle</a>
                        <a href="{{ route('haber.sil', ['id' => $haber->id]) }}"
                            onclick="return confirm('Haberi silmek istediğinize emin misiniz?')">Sil</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Henüz haber bulunmamaktadır.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
