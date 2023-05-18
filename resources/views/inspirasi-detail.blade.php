@extends('layouts.main')

@section('metadata')
    <meta name="description" content="{{ $posts->excerpt }}" />
    <meta property="og:description" content="{{ $posts->excerpt }}" />
@endsection

@section('content')
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-md-6">
                </div>
            </div>
        </div>
    </div>
    <section>
        <div class="container" data-aos="fade-up">
            @if($posts)
                <div class="card mb-3">
                    <div id="imagediv">
                        <div class="img-thumbnail skeleton" id="skeleton-{{ $posts->id }}"></div>
                        <img class="card-img-top img-id-{{ $posts->id }}" src="#" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <center>
                            <h2 class="card-title">{{ $posts->judul }}</h2>
                            <p class="card-text mb-3">
                                <small class="text-muted">
                                    Diposting {{ \Carbon\Carbon::parse($posts->created_at)->diffForHumans() }}. By <a href="{{ url('/berita?cari='.$posts->user->name) }}">{{ $posts->user->name }}</a>
                                </small>
                            </p>
                        </center>
                        <p class="card-text">{!! $posts->body !!}</p>
                        <center>
                            <div class="mt-3 sharethis-inline-share-buttons">
                                <p>Bagikan : </p>
                                <div class="social-links mt-3">
                                    <a href="https://telegram.me/share/url?url={{ url('/inspirasi-alumni/detail', $posts->slug) }}&text={{ $posts->judul }}"
                                       target="_blank">
                                        <iconify-icon icon="logos:telegram" width="32"></iconify-icon>
                                    </a>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url('/inspirasi-alumni/detail', $posts->slug)) }}&t={{ urlencode($posts->judul) }}" target="_blank">
                                        <iconify-icon icon="logos:facebook" width="32"></iconify-icon>
                                    </a>
                                    <a href="https://api.whatsapp.com/send?text={{ $posts->judul }}%20{{ url('/inspirasi-alumni/detail', $posts->slug) }}" target="_blank">
                                        <iconify-icon icon="logos:whatsapp-icon" width="32"></iconify-icon>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?text={{ $posts->judul }}&url={{ url('/inspirasi-alumni/detail', $posts->slug) }}" target="_blank">
                                        <iconify-icon icon="skill-icons:twitter" width="32"></iconify-icon>
                                    </a>
                                    <a href="https://www.linkedin.com/shareArticle?token&isFramed=false&url={{ url('/inspirasi-alumni/detail', $posts->slug) }}" target="_blank">
                                        <iconify-icon icon="skill-icons:linkedin" width="32"></iconify-icon>
                                    </a>
                                    <a href="https://id.pinterest.com/pin-builder/?description={{ $posts->judul }}&media={{ asset('storage/'.$posts->gambar) }}&method=button&url={{ url('/inspirasi-alumni/detail', $posts->slug) }}" target="_blank">
                                        <iconify-icon icon="logos:pinterest" width="32"></iconify-icon>
                                    </a>
                                </div>
                            </div>
                        </center>
                        <hr class="mb-3">
                        <center>
                            <a href="{{ url('/berita') }}" class="btn btn-primary mb-3">Lihat Semua Berita</a>
                        </center>
                    </div>
                </div>
            @else
                <center>
                    <h1>Berita tidak ditemukan.</h1>
                </center>
            @endif
        </div>
    </section>
@endsection

@section('scripts')
<script>
        $(document).ready(function () {
            const image = $('.img-id-{{ $posts->id }}');
            image.hide();
            var skeleton = $('#skeleton-{{ $posts->id }}');
            const divimage = $('#imagediv');
            const gambar = '{{ $posts->gambar }}';
            if(gambar === 'default-post.jpg'){

                divimage.remove();
            } else {
                changeimage('{{asset('storage'.'/'.$posts->gambar)}}', image, skeleton)
            }
        });
        function changeimage(url, image, skeleton) {
            fetch(url)
                .then(response => response.blob())
                .then(blob => {
                    const url = URL.createObjectURL(blob);
                    skeleton.remove();
                    image.show();
                    image.attr('src', url);
                });
        }
    </script>
@endsection
