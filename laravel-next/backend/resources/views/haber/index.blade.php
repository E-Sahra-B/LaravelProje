@extends('haber.layout')
@section('content')
    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ Session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Haberler</h2>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('haber') }}" class="btn btn-success btn-sm" title="Add New admin">
                            Yeni Haber Ekle
                        </a>
                        <br />
                        <br />
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
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
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $haber->baslik }}</td>
                                            <td>{{ $haber->icerik }}</td>
                                            <td>{{ $haber->kategori->ad }}</td>
                                            <td>{{ $haber->created_at->format('d.M.Y') }}</td>
                                            <td>{{ $haber->status == 1 ? 'Aktif' : 'Pasif' }}</td>
                                            <td>
                                                <a href="{{ route('haber.duzenle', ['id' => $haber->id]) }}"><button
                                                        class="btn btn-primary btn-sm">Düzenle</button></a>
                                                <a href="{{ route('haber.sil', ['id' => $haber->id]) }}"
                                                    onclick="return confirm('Haberi silmek istediğinize emin misiniz?')"><button
                                                        class="btn btn-danger btn-sm">Sil</button></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">Henüz haber bulunmamaktadır.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
