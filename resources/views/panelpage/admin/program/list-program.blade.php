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
                        <th scope="col">Jenis</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($program as $p)
                        <tr>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->jenis_program }}</td>
                            <td>
                                <form id="form-hps-{{ $p->id }}" action="{{ route('program-hapus', $p->id) }}" method="post"
                                      class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-sm btn-danger"
                                            onclick="hapus('{{ $p->nama }}','form-hps-{{ $p->id }}')">Hapus
                                    </button>
                                </form>
                                <a class="btn btn-sm btn-warning d-inline m-1" href="{{ route('program-edit', $p->id) }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <center>
                    <a class="btn btn-success m-3" href="{{ route('program-tambah') }}">Tambah</a>
                </center>
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
