@extends('layouts.main')

@section('content')
    @if(!$gs->count() && request('cari'))
        <script>
            var err = '{{ request('cari') }}'
            Swal.fire({
                title: 'Ooops!',
                html: 'hasil pencarian "' + err + '" tidak ditemukan.',
                icon: 'error',
                timer: 5000,
                timerProgressBar: true,
                showConfirmButton: false,
                didOpen: () => {
                },
                willClose: () => {
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                }
            })
        </script>
    @endif
    <section id="team" class="team section-bg">
        <div class="container" data-aos="fade-up">
            <div class="breadcrumbs" data-aos="fade-in">
                <div class="section-title">
                    <h2>Tenaga Pendidik</h2>
                </div>
                <div class="container mt-3">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <form action="{{ url('/tenaga-pendidik') }}">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control @if(!$gs->count()) is-invalid @endif"
                                           placeholder="Cari" name="cari" value="{{ request('cari') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">Cari</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if($gs->count())
                    @foreach($gs as $sp)
                        <div class="col-lg-6 mb-3">
                            <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
                                <div class="pic">
                                    <img src="{{ asset('storage/'.$sp->profile->image) }}" class="img-fluid img-id-{{ $sp->id }}" alt="">
                                </div>
                                <div class="member-info">
                                    <h4>{{ $sp->nama }}</h4>
                                    <p>Jabatan : {{ $sp->jabatan }}</p>
                                    <span>Bidang Studi : {{ $sp->bidang_studi === '' ? '-' : $sp->bidang_studi }}</span>
                                    <p>No HP : {{ $sp->no_hp }}</p>
                                    <div class="social">
                                            <a onclick="sosial('telegram', '{{ $sp->profile->telegram }}')">
                                                <i class="ri-telegram-fill"></i>
                                            </a>
                                            <a onclick="sosial('facebook', '{{ $sp->profile->facebook }}')">
                                                <i class="ri-facebook-fill"></i>
                                            </a>
                                            <a onclick="sosial('instagram', '{{ $sp->profile->instagram }}')">
                                                <i class="ri-instagram-fill"></i>
                                            </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            Data tidak ditemukan
                        </div>
                    </div>
                @endif
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $gs->links() }}
            </div>

        </div>
    </section>
@endsection

@section('scripts')
    <script>
        function sosial(sosial, username) {
            switch (sosial) {
                case 'telegram':
                    if (username === '') {
                        Swal.fire({
                            title: 'Ooops!',
                            html: 'link telegram masih kosong',
                            icon: 'error',
                            timer: 5000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            didOpen: () => {
                            },
                            willClose: () => {
                            }
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                            }
                        })
                    } else {
                        window.open('https://t.me/' + username, '_blank');
                    }
                    break;
                case 'facebook':
                    if (username === '') {
                        Swal.fire({
                            title: 'Ooops!',
                            html: 'link facebook masih kosong',
                            icon: 'error',
                            timer: 5000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            didOpen: () => {
                            },
                            willClose: () => {
                            }
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                            }
                        })
                    } else {
                        window.open('https://facebook.com/' + username, '_blank');
                    }
                    break;
                case 'instagram':
                    if (username === '') {
                        Swal.fire({
                            title: 'Ooops!',
                            html: 'link instagram masih kosong',
                            icon: 'error',
                            timer: 5000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            didOpen: () => {
                            },
                            willClose: () => {
                            }
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                            }
                        })
                    } else {
                        window.open('https://instagram.com/' + username, '_blank');
                    }
                default:
                    break;
            }
        }
    </script>
@endsection
