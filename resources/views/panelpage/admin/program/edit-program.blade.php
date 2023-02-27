@extends('panel.main')

@section('heads')
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
            <div class="col-lg-8">
                <form method="post" action="{{ route('program-edit-progress', $program->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="nama">Judul</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                               name="nama" value="{{ $program->nama }}" autofocus>
                        @error('judul')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="jenis">Jenis</label>
                        <select class="form-control @error('jenis') is-invalid @enderror" id="jenis"
                                name="jenis">
                            <option value="{{ $program->jenis_program_id }}">{{ $program->jenis_program }}</option>
                            @foreach($jp as $c)
                                <option value="{{ $c->id }}">{{ $c->nama }}</option>
                            @endforeach
                        </select>
                        @error('jenis')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="body">Body</label>
                        <div class="quill-textarea">
                            {!! old('body') ?? $program->deskripsi !!}
                        </div>
                        <textarea style="display: none" id="body" name="body">{{ old('body') ?? $program->deskripsi }}</textarea>
                        @error('body')
                        <div style="color: red">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input class="form-control @error('gambar') is-invalid @enderror mb-2" type="file" id="gambar" name="gambar" onchange="previewimg()">
                        <img src="{{ asset("storage/$program->gambar") }}" alt="" class="gambarprev img-thumbnail mb-3" style="max-width: 200px">
                        @error('gambar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Edit Program</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            var toolbarOptions = [
                [{'header': [1, 2, 3, 4, 5, 6, false]}],
                [{'font': []}],
                ['bold', 'italic', 'underline', 'strike'],
                [{'list': 'ordered'}, {'list': 'bullet'}],
                [{'align': []}],
                [{'script': 'sub'}, {'script': 'super'}],
                [{'indent': '-1'}, {'indent': '+1'}],
                [{'direction': 'rtl'}],
                [{'color': []}, {'background': []}],
                ['link'],
                ['formula'],
                ['code-block']
            ];
            var quill = new Quill('.quill-textarea', {
                placeholder: 'Enter Detail',
                theme: 'snow',
                modules: {
                    toolbar: toolbarOptions
                }
            });

            const oldBody = '{!! old('body') !!}';
            if (oldBody) {
                $('#body').val(quill.container.firstChild.innerHTML);
            }

            quill.on('text-change', function (delta, oldDelta, source) {
                $('#body').val(quill.container.firstChild.innerHTML);
            });
        });
        function previewimg() {
            const gambar = document.querySelector('#gambar');
            const gambarprev = document.querySelector('.gambarprev');
            const filegambar = new FileReader();
            filegambar.readAsDataURL(gambar.files[0]);

            filegambar.onload = function (e) {
                gambarprev.src = e.target.result;
            }
        }
    </script>
@endsection
