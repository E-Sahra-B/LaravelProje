@extends('haber.layout')
@section('content')
    {{-- @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach --}}
    <div class="card">
        <div class="card-header">Haber Ekle</div>
        <div class="card-body">
            <form action="{{ route('haber.ekle') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="baslik">Başlık:</label>
                <input type="text" name="baslik"
                    class="form-control @if ($errors->has('baslik')) border-danger @endif" value="{{ old('baslik') }}">
                @if ($errors->has('baslik'))
                    <span class="text-danger">{{ $errors->first('baslik') }}</span><br>
                @endif

                <x-category-select :name="'kategori_id'" :label="'Kategori'" :errors="$errors" :data="null" />

                <label for="image">Resim:</label>
                <input type="file" name="image"
                    class="form-control @if ($errors->has('image')) border-danger @endif">
                @if ($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span><br>
                @endif

                <label for="icerik">İçerik:</label>
                <textarea name="icerik" rows="4" class="form-control @if ($errors->has('icerik')) border-danger @endif">{{ old('icerik') }}</textarea>
                @if ($errors->has('icerik'))
                    <span class="text-danger">{{ $errors->first('icerik') }}</span><br>
                @endif

                <label for="status">Durum:</label>
                <select name="status" class="form-control @if ($errors->has('status')) border-danger @endif">
                    <option value="1" @if (old('status') == '1') selected @endif>Aktif</option>
                    <option value="0" @if (old('status') == '0') selected @endif>Pasif</option>
                </select>
                @if ($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span><br>
                @endif

                <button type="submit" class="btn btn-success float-end">Haber Ekle</button>
            </form>
        </div>
    </div>
@stop
