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
                <form method="post" action="{{ route('agenda-edit-progress', $agenda->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                               name="judul" value="{{ $agenda->judul }}" autofocus>
                        @error('judul')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                               name="slug" value="{{ $agenda->slug }}">
                        @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="body">Keterangan / Isi</label>
                        <div class="quill-textarea">
                            {!! old('body') ?? $agenda->body !!}
                        </div>
                        <textarea style="display: none" id="body" name="body">{{ old('body') ?? $agenda->body }}</textarea>
                        @error('body')
                        <div style="color: red">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar / Poster / Banner</label>
                        <input class="form-control @error('gambar') is-invalid @enderror mb-2" type="file" id="gambar" name="gambar" onchange="previewimg()">
                        <img src="{{ url("storage/$agenda->gambar") }}" alt="" class="gambarprev img-thumbnail mb-3" style="max-width: 200px">
                        @error('gambar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="tempat">Tempat</label>
                        <input type="text" class="form-control @error('tempat') is-invalid @enderror" id="tempat"
                               name="tempat" value="{{ $agenda->tempat }}" autofocus>
                        @error('tempat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="time">Waktu</label>
                        <input type="datetime-local" class="form-control @error('time') is-invalid @enderror" id="time" name="time" value="{{ old('created_at') ?? $agenda->created_at }}">
                        @error('time')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Edit Agenda</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        const judul = document.querySelector('#judul');
        const slug = document.querySelector('#slug');

        judul.addEventListener('change', function () {
            fetch('{{ $url_panel.'/post' }}/checkSlug?judul=' + judul.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        })

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
