@extends('kategori.layout')
@section('content')
    <div class="card">
        <div class="card-header">Kategori Düzenle</div>
        <div class="card-body">
            <form action="{{ route('kategori.duzenle.kaydet', ['id' => $kategori->id]) }}" method="POST">
                @csrf
                <label for="ad">Ad:</label>
                <input type="text" name="ad" value="{{ $kategori->ad }}" class="form-control">
                <label for="status">Durum:</label>
                <select name="status" class="form-control">
                    <option value="1" {{ $kategori->status == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ $kategori->status == 0 ? 'selected' : '' }}>Pasif</option>
                </select><br>
                <button type="submit" class="btn btn-success float-end">Kategori Düzenle</button>
            </form>
        </div>
    </div>
@stop
