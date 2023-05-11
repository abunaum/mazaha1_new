@extends('layouts.main')

@section('content')
    <section id="team" class="team section-bg">
        <div class="container" data-aos="fade-up">
            <div class="breadcrumbs" data-aos="fade-in">
                <div class="section-title">
                    <h2>{{ $program->nama }}</h2>
                </div>
                <div class="container mt-3">
                    <div class="mb-3 justify-content-center text-center">
                        <img src="{{ $program->gambar ? url("storage/$program->gambar") : url('assets/img/LOGO.png') }}" class="img-fluid" style="width: 50%">
                    </div>
                    <div>
                        {!! $program->deskripsi !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
