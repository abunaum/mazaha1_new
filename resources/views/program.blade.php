@extends('layouts.main')
@section('heads')
    <style>
        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-md-auto {
            flex: 0 0 calc(100% / 4); /* untuk layar lebar */
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .col-md-auto {
                flex: 0 0 100%; /* untuk layar mobile */
            }
        }
    </style>
@endsection
@section('content')
    <!-- ======= Program Section ======= -->

    <div class="modal fade" id="prodistikModal" tabindex="-1" role="dialog" aria-labelledby="prodistikModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title" id="prodistikModalLabel">Pilihan pada Program Unggulan Prodistik</h5>
                </div>
                <div class="modal-body">
                    <div class="card-deck">
                        <div class="row justify-content-center">
                            <div class="col-md-auto d-flex flex-wrap justify-content-center mb-4" data-aos="zoom-in"
                                 data-aos-delay="100">
                                <div class="card p-1 m-3">
                                    <!--Card image-->
                                    <div class="view overlay">
                                        <img class="card-img-top" src="{{ asset('assets/img/program/graphics.jpg') }}"
                                             alt="desing grapichs" style="height: 17em; width: 17em">
                                        <a href="#">
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>

                                    <!--Card content-->
                                    <div class="card-body">
                                        <!--Title-->
                                        <div class="align-items-center d-flex justify-content-center">
                                            <h3 class="card-title align-content-center">Graphics Design</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-auto d-flex flex-wrap justify-content-center mb-4" data-aos="zoom-in"
                                 data-aos-delay="100">
                                <div class="card p-1 m-3">
                                    <!--Card image-->
                                    <div class="view overlay">
                                        <img class="card-img-top" src="{{ asset('assets/img/program/video.jpg') }}"
                                             alt="desing grapichs" style="height: 17em; width: 17em">
                                        <a href="#">
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>

                                    <!--Card content-->
                                    <div class="card-body">
                                        <!--Title-->
                                        <div class="align-items-center d-flex justify-content-center">
                                            <h3 class="card-title align-content-center">Video Editor</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-auto d-flex flex-wrap justify-content-center mb-4" data-aos="zoom-in"
                                 data-aos-delay="100">
                                <div class="card p-1 m-3">
                                    <!--Card image-->
                                    <div class="view overlay">
                                        <img class="card-img-top" src="{{ asset('assets/img/program/code.jpeg') }}"
                                             alt="desing grapichs" style="height: 17em; width: 17em">
                                        <a href="#">
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>

                                    <!--Card content-->
                                    <div class="card-body">
                                        <!--Title-->
                                        <div class="align-items-center d-flex justify-content-center">
                                            <h3 class="card-title align-content-center">Programming</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container mt-3">
            <div class="section-title">
                <h2>Program Unggulan</h2>
            </div>
        </div>
    </div>
    <section>
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-md-6 d-flex align-items-stretch mb-3" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card p-1">
                        <!--Card image-->
                        <div class="view overlay">
                            <img class="card-img-top" src="{{ asset('assets/img/program/tahfidz.jpg') }}"
                                 alt="Card image cap" style="height: 20em">
                            <a href="#!">
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>

                        <!--Card content-->
                        <div class="card-body">
                            <!--Title-->
                            <div class="align-items-center d-flex justify-content-center">
                                <h4 class="card-title align-content-center">Tahfidzul Qur'an</h4>
                            </div>
                            <!--Text-->
                            <p class="card-text">Program untuk santri yang berminat untuk menghafal al-qur'an. Program
                                ini bekerjasama dengan Jam'iyatul Qurro' wal Huffadz cabang kota Kraksaan.</p>

                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 d-flex align-items-stretch mb-3" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card p-1 prodistik-card" data-toggle="modal" data-target="#prodistikModal"
                         style="cursor: pointer;">
                        <!--Card image-->
                        <div class="view overlay">
                            <img class="card-img-top" src="{{ asset('assets/img/program/prodistik.jpg') }}"
                                 alt="Card image cap" style="height: 20em">
                            <a href="#!">
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>

                        <!--Card content-->
                        <div class="card-body">

                            <!--Title-->
                            <div class="align-items-center d-flex justify-content-center">
                                <h4 class="card-title align-content-center">Prodistik</h4>
                            </div>
                            <!--Text-->
                            <p class="card-text">Program D1 bidang Teknologi Informasi dan Komunikasi (PRODISTIK) adalah
                                kerjasama MA Zainul Hasan 1 Genggong dengan ITS Surabaya dalam bidang teknologi
                                informasi dan komunikasi.</p>
                            <div class="align-items-center d-flex justify-content-center">
                                <button class="btn btn-success">Lihat Pilihan</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 d-flex align-items-stretch mb-3" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card p-1">
                        <!--Card image-->
                        <div class="view overlay">
                            <img class="card-img-top" src="{{ asset('assets/img/program/tqq.jpg') }}"
                                 alt="Card image cap" style="height: 20em">
                            <a href="#!">
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>

                        <!--Card content-->
                        <div class="card-body">

                            <!--Title-->
                            <div class="align-items-center d-flex justify-content-center">
                                <h4 class="card-title align-content-center">Tahqiqu Qiroatil Kutub</h4>
                            </div>
                            <!--Text-->
                            <p class="card-text">Program Tahqiqu Qiroatil Kutub adalah kelas unggulan untuk santri yang
                                ingin mendalami khazanah ilmu keislaman, kajian kitab kuning, dan bahasa Arab. Program
                                ini bekerja sama dengan Fakultas Humaniora Jurusan Bahasa dan Sastra Arab UIN Maulana
                                Malik Ibrahim Malang.</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container mt-3">
            <div class="section-title">
                <h2>INTRAKULIKULER</h2>
            </div>
        </div>
    </div>
    <section>
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-md-auto d-flex align-items-stretch mb-3" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card p-1">
                        <!--Card image-->
                        <div class="view overlay">
                            <img class="card-img-top" src="{{ asset('assets/img/program/ipa.png') }}"
                                 alt="Card image cap" style="height: 22em; width: 22em">
                            <a href="#!">
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>

                        <!--Card content-->
                        <div class="card-body">
                            <!--Title-->
                            <div class="align-items-center d-flex justify-content-center">
                                <h2 class="card-title align-content-center">MIPA</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-auto d-flex align-items-stretch mb-3" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card p-1">
                        <!--Card image-->
                        <div class="view overlay">
                            <img class="card-img-top" src="{{ asset('assets/img/program/ips.png') }}"
                                 alt="Card image cap" style="height: 22em; width: 22em">
                            <a href="#!">
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>

                        <!--Card content-->
                        <div class="card-body">

                            <!--Title-->
                            <div class="align-items-center d-flex justify-content-center">
                                <h2 class="card-title align-content-center">ISS</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-auto d-flex align-items-stretch mb-3" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card p-1">
                        <!--Card image-->
                        <div class="view overlay">
                            <img class="card-img-top" src="{{ asset('assets/img/program/kitab.png') }}"
                                 alt="Card image cap" style="height: 22em; width: 22em">
                            <a href="#!">
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>

                        <!--Card content-->
                        <div class="card-body">

                            <!--Title-->
                            <div class="align-items-center d-flex justify-content-center">
                                <h2 class="card-title align-content-center">PK</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container mt-3">
            <div class="section-title">
                <h2>EKSTRAKULIKULER</h2>
            </div>
        </div>
    </div>
    <section>
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                @foreach ($extra as $item)
                    <div class="col-md-auto col-12 d-flex align-items-stretch mb-4" data-aos="zoom-in"
                         data-aos-delay="100">
                        <div class="card p-1">
                            <!--Card image-->
                            <div class="view overlay">
                                <div class="col-12">
                                    <img class="card-img-top" src="{{ asset('assets/img/program/'.$item['image']) }}"
                                         alt="{{ $item['title'] }}" style="height: 22em; width: 22em;">
                                </div>
                                <a href="#">
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>

                            <!--Card content-->
                            <div class="card-body">
                                <!--Title-->
                                <div class="align-items-center d-flex justify-content-center">
                                    <h3 class="card-title align-content-center">{{ $item['title'] }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <hr>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('.prodistik-card').click(function () {
                $('#prodistikModal').modal('show');
            });
        });
    </script>
@endsection
