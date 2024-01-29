@extends('haber.layout')
@section('content')
    <div class="card">
        <div class="card-header">Haber Düzenle</div>
        <div class="card-body">
            <form action="{{ route('haber.duzenle', ['id' => $haber->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="baslik">Başlık:</label>
                <input type="text" name="baslik" value="{{ $haber->baslik }}" class="form-control">

                <x-category-select :name="'kategori_id'" :label="'Kategori'" :errors="$errors" :data="$haber->kategori_id" /><br>

                <img src="{{ $haber->image ? Storage::url($haber->image) : asset('storage/haber/default.jpg') }}"
                    alt="{{ $haber->baslik }}" class="w-25 img-fluid  img-thumbnail">
                <input type="hidden" name="oldimage" value="{{ $haber->image }}"><br>
                <label for="image">Resim:</label>
                <input type="file" name="image" class="form-control">
                <label for="icerik">İçerik:</label>
                <textarea name="icerik" rows="4" class="form-control">{{ $haber->icerik }}</textarea>

                <label for="status">Durum:</label>
                <select name="status" class="form-control">
                    <option value="1" {{ $haber->status == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ $haber->status == 0 ? 'selected' : '' }}>Pasif</option>
                </select><br>
                <button type="submit" class="btn btn-success float-end">Haber Düzenle</button>
            </form>
        </div>
    </div>
@stop
