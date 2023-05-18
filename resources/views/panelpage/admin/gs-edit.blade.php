@extends('panel.main')

@section('heads')
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css" rel="stylesheet"/>
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
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <center>
                    <h1>Edit ({{ $gs->nama }})</h1>
                </center>
                <form class="row g-3" action="{{ route('gs-edit-progress', $gs->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="col-md-12">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                               id="nama" name="nama" placeholder="Nama" value="{{ old('nama', $gs->nama) }}">
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                               id="jabatan" name="jabatan" placeholder="Jabatan" value="{{ old('jabatan', $gs->jabatan) }}">
                        @error('jabatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="bidang_studi" class="form-label">Bidang Studi</label>
                        <input type="text" class="form-control" id="bidang_studi" name="bidang_studi"
                               placeholder="Bidang Studi" value="{{ old('bidang_studi',$gs->bidang_studi) }}">
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email',$gs->profile->email) }}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat"
                               placeholder="Alamat" value="{{ old('alamat',$gs->alamat) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="nohp" class="form-label">No HP</label>
                        <input type="text" class="form-control" id="nohp" name="nohp"
                               placeholder="08xxxxxxxxx" value="{{ old('nohp',$gs->no_hp) }}">
                    </div>
                    <div class="col-md-4">
                        <label for="telegram" class="form-label">Username Telegram</label>
                        <input type="text" class="form-control"id="telegram" name="telegram" value="{{ old('telegram',$gs->profile->telegram) }}" placeholder="Username Telegram">
                    </div>
                    <div class="col-md-4">
                        <label for="instagram" class="form-label">Username Instagram</label>
                        <input type="text" class="form-control" id="instagram" name="instagram" value="{{ old('instagram',$gs->profile->instagram) }}" placeholder="Username Instagram">
                    </div>
                    <div class="col-md-4">
                        <label for="facebook" class="form-label">Username Facebook</label>
                        <input type="text" class="form-control" id="facebook" name="facebook" value="{{ old('facebook',$gs->profile->facebook) }}" placeholder="Username Facebook">
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Gambar</label>
                        <input class="form-control @error('foto') is-invalid @enderror mb-2" type="file" id="foto" name="foto" onchange="previewimg()">
                        <img src="{{ asset('storage/'.$gs->profile->image) }}" alt="" class="gambarprev img-thumbnail mb-3" style="max-width: 200px">
                        @error('foto')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="text-center">
                        <a href="{{ route('guru-staff') }}" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn btn-success">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            var table = $('#sp').DataTable({
                responsive: true
            });
            new $.fn.dataTable.FixedHeader(table);
        });
        function previewimg() {
            const gambar = document.querySelector('#foto');
            const gambarprev = document.querySelector('.gambarprev');
            const filegambar = new FileReader();
            filegambar.readAsDataURL(gambar.files[0]);

            filegambar.onload = function (e) {
                gambarprev.src = e.target.result;
            }
        }
    </script>
@endsection
