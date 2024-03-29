@extends('layouts.main')

@section('hero')
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                     data-aos="fade-up" data-aos-delay="200">
                    <h1 class="hero-nama">Madrasah Aliyah</h1>
                    <h1 class="hero-nama">Zainul Hasan 1 Genggong</h1>
                    <h2>Madrasah Berbasis Pesantren dan Teknologi</h2>
                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <a href="{{ url('/berita') }}" class="btn-get-started scrollto">Berita</a>
                        <a href="https://www.youtube.com/watch?v=2coSKe0kGkI" class="glightbox btn-watch-video"><i
                                class="bi bi-play-circle"></i><span>Lihat Kami</span></a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200"
                     style="text-align:center;">
                    <img src="assets/img/LOGO.png" class="img-fluid animated" alt="logo" style="height: 50vh;">
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    @if(session()->has('error'))
        <script>
            var err = '{{ session('error') }}'
            Swal.fire({
                title: 'Ooops!',
                html: err,
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

    @if(session()->has('sukses'))
        <script>
            var sks = '{{ session('sukses') }}'
            Swal.fire({
                title: 'Mantap.',
                html: sks,
                icon: 'success',
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
    <section id="clients" class="clients arab-bg">
        <div class="container">

            <div class="row" data-aos="zoom-in">
                <div class="col-lg-12 col-md-12 d-flex align-items-center justify-content-center">
                    <p class="animated-arab" dir="rtl"></p>
                </div>
            </div>

        </div>
    </section>

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us section-bg">
        <div class="container-fluid" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

                    <div class="content">
                        <h3>Mengapa harus sekolah di <strong>Madrasah Aliyah Zainul Hasan 1</strong></h3>
                    </div>

                    <div class="accordion-list">
                        <ul>
                            <li>
                                <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-1"
                                   class="collapsed">
                                    <span>01</span>
                                    Pembelajaran Berbasis Teknologi
                                    <i class="bx bx-chevron-down icon-show"></i>
                                    <i class="bx bx-chevron-up icon-close"></i>
                                </a>
                                <div id="accordion-list-1" class="collapse show" data-bs-parent=".accordion-list">
                                    <p>
                                        Dengan adanya program unggulan "PRODISTIK", siswa akan mendapatkan pembelajaran
                                        berbasis teknologi.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <a data-bs-toggle="collapse" data-bs-target="#accordion-list-2">
                                    <span>02</span>
                                    Pendalaman Ilmu Agama
                                    <i class="bx bx-chevron-down icon-show"></i>
                                    <i class="bx bx-chevron-up icon-close"></i>
                                </a>
                                <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">
                                    <p>
                                        Dengan adanya program unggulan "Tahqiqu Qiroatil Kutub dan Tahfidhul Quran",
                                        para siswa akan di perdalam ilmu agamanya.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3" class="collapsed">
                                    <span>02</span>
                                    Kegiatan Pesantren
                                    <i class="bx bx-chevron-down icon-show"></i>
                                    <i class="bx bx-chevron-up icon-close"></i>
                                </a>
                                <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                                    <p>
                                        Para siswa di MA Zainul Hasan 1 diwajibkan untuk masuk pesantren, sehingga
                                        parasiswa akan mendapatkan kegiatan pesantren.
                                    </p>
                                </div>
                            </li>

                        </ul>
                    </div>

                </div>

                <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img">
                    <img src="assets/img/LOGO.png" class="img-fluid" alt="">
                </div>
            </div>

        </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
                    <img src="assets/img/choice.png" class="img-fluid" alt="" style="max-height: 45vh">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left" data-aos-delay="100">
                    <h3>Minat siswa</h3>
                    <p class="fst-italic">
                        Persentase Minat siswa terhadap program unggulan
                    </p>

                    <div class="skills-content">

                        <div class="progress">
                            <span class="skill">Tahqiqu Qiroatil Kutub <i class="val">90%</i></span>
                            <div class="progress-bar-wrap">
                                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </div>

                        <div class="progress">
                            <span class="skill">Prodistik <i class="val">65%</i></span>
                            <div class="progress-bar-wrap">
                                <div class="progress-bar" role="progressbar" aria-valuenow="65" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </div>

                        <div class="progress">
                            <span class="skill">Tahfidhul Quran <i class="val">40%</i></span>
                            <div class="progress-bar-wrap">
                                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </section><!-- End Skills Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Fasilitas Madrasah</h2>
                <p>Dengan adanya fasilitas madrasah yang memadai tentunya akan membuat kegiatan belajar mengajar akan
                    terasa lebih nyaman dan efektif.</p>
            </div>

            <div class="row">
                <div class="col-xl-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon-box">
                        <center>
                            <div class="icon">
                                <iconify-icon icon="maki:town-hall" width="32" height="32"></iconify-icon>
                            </div>
                            <h4><a href="#">AULA</a></h4>
                        </center>
                        <p>Digunakan ketika ada kegiatan penting di madrasah aliyah zainul hasan 1 genggong</p>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in"
                     data-aos-delay="200">
                    <div class="icon-box">
                        <center>
                            <div class="icon">
                                <iconify-icon icon="openmoji:desktop-computer" width="32" height="32"></iconify-icon>
                            </div>
                            <h4><a href="#">LAB Komputer</a></h4>
                        </center>
                        <p>Digunakan ketika mata pelajaran yang berkaitan dengan komputer.</p>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in"
                     data-aos-delay="400">
                    <div class="icon-box">
                        <center>
                            <div class="icon">
                                <iconify-icon icon="game-icons:materials-science" width="32" height="32"></iconify-icon>
                            </div>
                            <h4><a href="">LAB IPA</a></h4>
                        </center>
                        <p>Digunakan ketika mata pelajaran yang berkaitan dengan ipa.</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Services Section -->

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Hal yang sering ditanyakan</h2>
            </div>

            <div class="faq-list">
                <ul>
                    <li data-aos="fade-up" data-aos-delay="100">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">
                            Apa itu program "Prodistik" ?
                            <i class="bx bx-chevron-down icon-show"></i>
                            <i class="bx bx-chevron-up icon-close"></i>
                        </a>
                        <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
                            <p>
                                Program D1 bidang Teknologi Informasi dan Komunikasi (PRODISTIK) adalah kerja sama MA
                                ZAinul Hasan 1 Genggong dengan ITS Surabaya dalam bidang teknologi informasi dan
                                komunikasi. Program ini bertujuan untuk meningkatkan kualitas sumber daya manusia di
                                bidang teknologi informasi dan komunikasi.
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="200">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">
                            Apa itu program "Tahqiqu Qiroatil Kutub" ?
                            <i class="bx bx-chevron-down icon-show"></i>
                            <i class="bx bx-chevron-up icon-close"></i>
                        </a>
                        <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Program Tahqiqu Qiroatil Kutub adalah kelas unggulan untuk santri yang ingin mendalami
                                khazanah ilmu keislaman, kajian kitab kuning, dan bahasa Arab. Program ini bekerja sama
                                dengan Fakultas Humaniora Jurusan Bahasa dan Sastra Arab UIN Maulana Malik Ibrahim
                                Malang.
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="300">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">
                            Apa itu program "Tahfidhul Quran" ?
                            <i class="bx bx-chevron-down icon-show"></i><i
                                class="bx bx-chevron-up icon-close"></i>
                        </a>
                        <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Program unggulan untuk santri yang berminat menghafal Alquran. Program ini bekerja sama
                                dengan Jam'iyatul Qurro' wal Huffadz cabang Kota Kraksaan.
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="400">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">
                            Berapa Biaya SPP di MA Zainul Hasan 1 ?
                            <i class="bx bx-chevron-down icon-show"></i>
                            <i class="bx bx-chevron-up icon-close"></i>
                        </a>
                        <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Besaran biaya SPP berubah-ubah, besaran yang harus dibayarkan akan diberitahukan lebih
                                lanjut pada periode tertentu.
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="500">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">
                            Apakah Harus Masuk Pondok ?
                            <i class="bx bx-chevron-down icon-show"></i>
                            <i class="bx bx-chevron-up icon-close"></i>
                        </a>
                        <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Ya, agar siswa di MA Zainul Hasan 1 dapat memperdalam ilmu Agama.
                            </p>
                        </div>
                    </li>

                </ul>
            </div>

        </div>
    </section><!-- End Frequently Asked Questions Section -->

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
        <div class="container" data-aos="zoom-in">

            <div class="row">
                <div class="col-lg-9 text-center text-lg-start">
                    <h3>Ada pertanyaan lain?</h3>
                    <p> Jika ada hal lain yang ingin ditanyakan silahkan menghubungi kami.</p>
                </div>
                <div class="col-lg-3 cta-btn-container text-center">
                    <a class="cta-btn align-middle" href="https://t.me/najwannada" target="_blank">Hubungi kami</a>
                </div>
            </div>

        </div>
    </section><!-- End Cta Section -->
@endsection

@section('scripts')
    <script type="text/javascript">
        function animasimadrasah() {
            const arab = document.querySelector('.animated-arab');
            const tarab = 'المدرسة العالية زين الحسن ١ قنقون';
            const config = {
                wait: 1000,
                speed: 100,
            }
            const content = tarab.trim();
            arab.textContent = '';
            let count = 0;
            setTimeout(() => {
                const counter = setInterval(() => {
                    arab.textContent += content[count];
                    count++;
                    if (count >= content.length) {
                        clearInterval(counter)
                    }
                }, config.speed);
            }, config.wait)
        }

        animasimadrasah();
        setInterval(animasimadrasah, 10 * 1000);
    </script>
@endsection
