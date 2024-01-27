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
                                        <th>Resim</th>
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
                                            <td>
                                                <img src="{{ $haber->image ? Storage::url($haber->image) : asset('storage/haber/default.jpg') }}"
                                                    alt="{{ $haber->baslik }}" height="50" width="50">
                                            </td>
                                            <td>{{ $haber->baslik }}</td>
                                            <td>{{ Str::substr($haber->icerik, 0, 20) }}</td>
                                            <td>{{ $haber->kategori?->ad }}</td>
                                            <td>{{ $haber->created_at }}</td>
                                            <td>
                                                @if ($haber->status)
                                                    <a href="#" class="btn btn-sm btn-success changeStatus"
                                                        data-id="{{ $haber->id }}"
                                                        data-baslik="{{ $haber->baslik }}">Aktif</a>
                                                @else
                                                    <a href="#" class="btn btn-sm btn-dark changeStatus"
                                                        data-id="{{ $haber->id }}"
                                                        data-baslik="{{ $haber->baslik }}">Pasif</a>
                                                @endif
                                            </td>
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.changeStatus').click(function(e) {
            // e.preventDefault();
            let dataID = $(this).data("id");
            let baslik = $(this).data("baslik");
            let self = $(this);
            $.ajax({
                url: "{{ route('haber.changeStatus') }}",
                method: 'POST',
                async: false,
                data: {
                    'id': dataID
                },
                success: function(response) {
                    // if (response.status == 1) {
                    //     self.html('Aktif');
                    //     self.removeClass('btn-dark').addClass('btn-success');
                    // } else {
                    //     self.html('Pasif');
                    //     self.removeClass('btn-success').addClass('btn-dark');
                    // }
                    var isActive = response.status == 1;
                    self.html(isActive ? 'Aktif' : 'Pasif')
                        .toggleClass('btn-dark', !isActive)
                        .toggleClass('btn-success', isActive);
                    toastr["success"](
                        baslik + " 'ın Durumu'u Başarıyla " + (isActive ? 'Aktif' :
                            'Pasif') + " olarak güncellendi", "Başarılı")
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "timeOut": "5000"
                        // "debug": false,
                        // "newestOnTop": false,
                        // "positionClass": "toast-top-right",
                        // "preventDuplicates": false,
                        // "onclick": null,
                        // "showDuration": "300",
                        // "hideDuration": "1000",
                        // "extendedTimeOut": "1000",
                        // "showEasing": "swing",
                        // "hideEasing": "linear",
                        // "showMethod": "fadeIn",
                        // "hideMethod": "fadeOut"
                    }
                },
                error: function(e) {
                    console.log(e);
                }
            })

        })
    })
</script>
