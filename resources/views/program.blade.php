@extends('layouts.main')
@section('content')
    <!-- ======= Program Section ======= -->
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
                <div class="col-xl-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
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
                            <p class="card-text">Program untuk santri yang berminat untuk menghafal al-qur'an. Program ini bekerjasama dengan Jam'iyatul Qurro' wal Huffadz cabang kota Kraksaan.</p>

                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card p-1">
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
                            <p class="card-text">Program D1 bidang Teknologi Informasi dan Komunikasi (PRODISTIK) adalah kerjasama MA Zainul Hasan 1 Genggong dengan ITS Surabaya dalam bidang teknologi informasi dan komunikasi.</p>

                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
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
                            <p class="card-text">Program Tahqiqu Qiroatil Kutub adalah kelas unggulan untuk santri yang ingin mendalami khazanah ilmu keislaman, kajian kitab kuning, dan bahasa Arab. Program ini bekerja sama dengan Fakultas Humaniora Jurusan Bahasa dan Sastra Arab UIN Maulana Malik Ibrahim Malang.</p>

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
                <div class="col-md-auto d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card p-1">
                        <!--Card image-->
                        <div class="view overlay">
                            <img class="card-img-top" src="{{ asset('assets/img/program/ipa.png') }}"
                                 alt="Card image cap" style="height: 20em; width: 20em">
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

                <div class="col-md-auto d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card p-1">
                        <!--Card image-->
                        <div class="view overlay">
                            <img class="card-img-top" src="{{ asset('assets/img/program/ips.png') }}"
                                 alt="Card image cap" style="height: 20em; width: 20em">
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

                <div class="col-md-auto d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card p-1">
                        <!--Card image-->
                        <div class="view overlay">
                            <img class="card-img-top" src="{{ asset('assets/img/program/kitab.png') }}"
                                 alt="Card image cap" style="height: 20em; width: 20em">
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
                    <div class="col-md-auto d-flex align-items-stretch mb-4" data-aos="zoom-in" data-aos-delay="100">
                        <div class="card p-1">
                            <!--Card image-->
                            <div class="view overlay">
                                <img class="card-img-top" src="{{ asset('assets/img/program/'.$item['image']) }}" alt="{{ $item['title'] }}" style="height: 17em; width: 17em">
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

@endsection
