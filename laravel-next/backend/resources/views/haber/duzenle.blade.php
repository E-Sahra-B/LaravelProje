@extends('haber.layout')
@section('content')
    <div class="card">
        <div class="card-header">Haber Düzenle</div>
        <div class="card-body">
            <form action="{{ route('haber.duzenle', ['id' => $haber->id]) }}" method="POST">
                @csrf
                <label for="baslik">Başlık:</label>
                <input type="text" name="baslik" value="{{ $haber->baslik }}" class="form-control">
                <label for="kategori_id">Kategori:</label>
                <select name="kategori_id" class="form-control">
                    @foreach ($kategoriler as $kategori)
                        <option value="{{ $kategori->id }}" {{ $kategori->id == $haber->kategori_id ? 'selected' : '' }}>
                            {{ $kategori->ad }}
                        </option>
                    @endforeach
                </select>
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
