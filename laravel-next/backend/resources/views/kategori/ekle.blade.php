@extends('kategori.layout')
@section('content')
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    <div class="card">
        <div class="card-header">Kategori Ekle</div>
        <div class="card-body">
            <form action="{{ route('kategori.ekle') }}" method="POST">
                @csrf
                <label for="ad">Ad:</label>
                <input type="text" name="ad" class="form-control">
                <label for="status">Durum:</label>
                <select name="status" class="form-control">
                    <option value="1">Aktif</option>
                    <option value="0">Pasif</option>
                </select> <br>
                <button type="submit" class="btn btn-success float-end">Kategori Ekle</button>
            </form>
        </div>
    </div>
@stop
