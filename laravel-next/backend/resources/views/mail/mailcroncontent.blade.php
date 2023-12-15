<h3>Gün Sonu Haber Bildirimi</h3>
@foreach ($haberler as $news)
    <h4>{{ $news->baslik }}</h4>
    <p>Haber İçeriği: {{ $news->icerik }}</p><br>
    <hr>
@endforeach
