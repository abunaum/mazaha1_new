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
                <table id="sp" class="display table table-striped table-bordered nowrap mb-3" style="width:100%">
                    <thead>
                    <tr>
                        <!--                    <th scope="col">#</th>-->
                        <th scope="col">Nama</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($jp as $j)
                        <tr>
                            <td>{{ $j->nama }}</td>
                            <td>
                                <form id="form-hps-{{ $j->id }}" action="{{ route('jp-hapus', $j->id) }}" method="post"
                                      class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-sm btn-danger"
                                            onclick="hapus('{{ $j->nama }}','form-hps-{{ $j->id }}')">Hapus
                                    </button>
                                </form>
                                <button type="button" class="btn btn-sm btn-warning d-inline m-1" data-bs-toggle="modal"
                                        data-bs-target="#editModal-{{ $j->id }}">
                                    Edit
                                </button>
                                <div class="modal fade" id="editModal-{{ $j->id }}" tabindex="-1" aria-labelledby="editModal-{{ $j->id }}Label">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editModal-{{ $j->id }}Label">Edit {{ $j->nama }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="row g-3" method="post" action="{{ route('jp-edit', $j->id ) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="nama" class="form-label">Nama Baru</label>
                                                        <input class="form-control @error('nama') is-invalid @enderror mb-2"
                                                               type="text" id="nama" name="nama" value="{{ $j->nama }}" required>
                                                        @error('nama')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="text-center">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal
                                                        </button>
                                                        <button type="submit" class="btn btn-success">Edit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <center>
                    <button type="button" class="btn btn-success m-3" data-bs-toggle="modal"
                            data-bs-target="#tambahModal">
                        Tambah
                    </button>
                </center>
                <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="tambahModalLabel">Tambah Jenis Program</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="row g-3" method="post" action="{{ route('jp-tambah') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input class="form-control @error('nama') is-invalid @enderror mb-2"
                                               type="text" id="nama" name="nama" value="{{ old('nama') }}" required>
                                        @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal
                                        </button>
                                        <button type="submit" class="btn btn-success">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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

        function hapus(nama, idform) {
            this.form = document.getElementById(idform);
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data " + nama + " akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.form.submit();
                }
            })
        }
    </script>
@endsection
