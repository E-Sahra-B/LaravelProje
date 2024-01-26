@extends('haber.layout')
@section('content')
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    <div class="card">
        <div class="card-header">Haber Ekle</div>
        <div class="card-body">
            <form action="{{ route('haber.ekle') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="baslik">Başlık:</label>
                <input type="text" name="baslik" class="form-control">
                <label for="kategori_id">Kategori:</label>
                <select name="kategori_id" class="form-control">
                    @foreach ($kategoriler as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->ad }}</option>
                    @endforeach
                </select>
                <label for="baslik">Başlık:</label>
                <input type="file" name="image" class="form-control">
                <label for="icerik">İçerik:</label>
                <textarea name="icerik" rows="4" class="form-control"></textarea>
                <label for="status">Durum:</label>
                <select name="status" class="form-control">
                    <option value="1">Aktif</option>
                    <option value="0">Pasif</option>
                </select><br>
                <button type="submit" class="btn btn-success float-end">Haber Ekle</button>
            </form>
        </div>
    </div>
@stop
