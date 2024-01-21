@extends('kategori.layout')
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
                        <div class="row d-flex justify-content-between">
                            <div class="col">
                                <h2>Kategoriler</h2>
                            </div>
                            <div class="col">
                                <form action="{{ route('clear.cache') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-dark float-end">Clear Cache</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('kategori.ekle') }}" class="btn btn-success btn-sm">Yeni Kategori Ekle</a>
                        <br />
                        <br />
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ad</th>
                                        <th>Durum</th>
                                        <th>İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kategoriler as $kategori)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $kategori->ad }}</td>
                                            <td>{{ $kategori->status == 1 ? 'Aktif' : 'Pasif' }}</td>
                                            <td>
                                                <a href="{{ route('kategori.duzenle', ['id' => $kategori->id]) }}"
                                                    class="btn btn-primary btn-sm">Düzenle</a>
                                                <a href="{{ route('kategori.sil', ['id' => $kategori->id]) }}"
                                                    onclick="return confirm('Kategoriyi silmek istediğinize emin misiniz?')"
                                                    class="btn btn-danger btn-sm">Sil</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">Henüz kategori bulunmamaktadır.</td>
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
