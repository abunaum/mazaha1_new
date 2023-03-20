@extends('layouts.main')

@section('heads')
    <style>
        .pagination {
            margin: 20px 0;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
        }

        .pagination .page-item.disabled .page-link {
            color: #6c757d;
            pointer-events: none;
            cursor: default;
            background-color: #fff;
            border-color: #dee2e6;
        }

        .loading-container {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loading-spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-top: 4px solid #4285f4;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
@endsection

@section('content')

    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form id="search-form">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Cari Berita" name="cari"
                                   id="search-input">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <section>
        <div class="berita">
            <div id="loading"  class="loading-container">
                <div class="loading-spinner"></div>
            </div>
            <div class="container" data-aos="fade-up">
                <div id="beritaatas"></div>
            </div>
            <div class="container" id="berbawnya">
                <div id="loading" class="text-center"><i class="fa fa-spinner fa-spin"></i> Loading...</div>
                <div class="row" id="beritabawah">
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <div class="pagination"></div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')

    <script>
        $('#search-form').on('submit', function (e) {
            e.preventDefault();
            const keyword = $('#search-input').val();
            searchBerita(1, keyword);
        });

        function cariSpesifik(page, type, nama) {
            $('#search-input').val('');
            $('.berita > *:not(#loading)').hide();
            $('#loading').show();
            const url = '{{ route("api-blog-public") }}?page=' + page + '&type=' + type + '&nama=' + nama;
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                data: {
                    'paginate': {{ $paginate }}
                },
                success: function (data) {
                    $('#loading').hide();
                    $('.berita > *:not(#loading)').show();
                    const tipe = 'filter';
                    displayPagination(data, tipe, null, type, nama);
                    // loop data
                    loopdata(data.data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        function searchBerita(page, keyword) {
            $('.berita > *:not(#loading)').hide();
            $('#loading').show();
            const url = '{{ route("api-blog-public") }}?page=' + page + '&search=' + keyword;
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                data: {
                    'paginate': {{ $paginate }}
                },
                success: function (data) {
                    $('#loading').hide();
                    $('.berita > *:not(#loading)').show();
                    const type = 'search';
                    displayPagination(data, type, keyword, null, null);
                    // loop data
                    loopdata(data.data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        function getData(page) {
            $('.berita > *:not(#loading)').hide();
            $('#loading').show();
            const url= '{{ route("api-blog-public") }}?page=' + page;
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                data: {
                    'paginate': {{ $paginate }}
                },
                success: function (data) {
                    $('#loading').hide();
                    $('.berita > *:not(#loading)').show();
                    const type = 'full';
                    displayPagination(data, type, null, null, null);
                    // loop data
                    loopdata(data.data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        function displayPagination(data, type, keyword, tipe, nama) {
            $('.pagination').html('');

            var pagination = data.pagination;
            var currentPage = pagination.current_page;
            var lastPage = pagination.last_page;

            var prevClass = currentPage === 1 ? 'disabled' : '';
            var nextClass = currentPage === lastPage ? 'disabled' : '';

            var html = '<nav aria-label="Page navigation"><ul class="pagination">';

            switch (type) {
                case 'search':
                    html += '<li class="page-item ' + prevClass + '"><a class="page-link" href="#" onclick="searchBerita(' + (currentPage - 1) + ', \'' + keyword + '\')">Previous</a></li>';
                    break;
                case 'filter':
                    html += '<li class="page-item ' + prevClass + '"><a class="page-link" href="#" onclick="cariSpesifik(' + (currentPage - 1) + ', \'' + tipe + '\', \'' + nama + '\')">Previous</a></li>';
                    break;
                default:
                    html += '<li class="page-item ' + prevClass + '"><a class="page-link" href="#" onclick="getData(' + (currentPage - 1) + ')">Previous</a></li>';
            }

            // html += '<li class="page-item ' + prevClass + '"><a class="page-link" href="#" onclick="getData(' + (currentPage - 1) + ')">Previous</a></li>';

            if (lastPage <= 5) {
                for (var i = 1; i <= lastPage; i++) {
                    var activeClass = i === currentPage ? 'active' : '';
                    switch (type) {
                        case 'search':
                            html += '<li class="page-item ' + activeClass + '"><a class="page-link" href="#" onclick="searchBerita(' + i + ', \'' + keyword + '\')">' + i + '</a></li>';
                            break;
                        case 'filter':
                            html += '<li class="page-item ' + activeClass + '"><a class="page-link" href="#" onclick="cariSpesifik(' + i + ', \'' + tipe + '\', \'' + nama + '\')">' + i + '</a></li>';
                            break;
                        default:
                            html += '<li class="page-item ' + activeClass + '"><a class="page-link" href="#" onclick="getData(' + i + ')">' + i + '</a></li>';
                    }
                    // html += '<li class="page-item ' + activeClass + '"><a class="page-link" href="#" onclick="getData(' + i + ')">' + i + '</a></li>';
                }
            } else {
                var startPage = 1;
                var endPage = lastPage;

                if (currentPage > 2) {
                    startPage = currentPage - 2;
                }
                if (currentPage < lastPage - 2) {
                    endPage = currentPage + 2;
                }

                if (startPage > 1) {
                    switch (type) {
                        case 'search':
                            html += '<li class="page-item"><a class="page-link" href="#" onclick="searchBerita(' + (startPage - 1) + ', \'' + keyword + '\')">&hellip;</a></li>';
                            break;
                        case 'filter':
                            html += '<li class="page-item"><a class="page-link" href="#" onclick="cariSpesifik(' + (startPage - 1) + ', \'' + tipe + '\', \'' + nama + '\')">&hellip;</a></li>';
                            break;
                        default:
                            html += '<li class="page-item"><a class="page-link" href="#" onclick="getData(' + (startPage - 1) + ')">&hellip;</a></li>';
                    }
                    // html += '<li class="page-item"><a class="page-link" href="#" onclick="getData(' + (startPage - 1) + ')">&hellip;</a></li>';
                }

                for (var i = startPage; i <= endPage; i++) {
                    var activeClass = i === currentPage ? 'active' : '';
                    switch (type) {
                        case 'search':
                            html += '<li class="page-item ' + activeClass + '"><a class="page-link" href="#" onclick="searchBerita(' + i + ', \'' + keyword + '\')">' + i + '</a></li>';
                            break;
                        case 'filter':
                            html += '<li class="page-item ' + activeClass + '"><a class="page-link" href="#" onclick="cariSpesifik(' + i + ', \'' + tipe + '\', \'' + nama + '\')">' + i + '</a></li>';
                            break;
                        default:
                            html += '<li class="page-item ' + activeClass + '"><a class="page-link" href="#" onclick="getData(' + i + ')">' + i + '</a></li>';
                    }
                    // html += '<li class="page-item ' + activeClass + '"><a class="page-link" href="#" onclick="getData(' + i + ')">' + i + '</a></li>';
                }

                if (endPage < lastPage) {
                    switch (type) {
                        case 'search':
                            html += '<li class="page-item"><a class="page-link" href="#" onclick="searchBerita(' + (endPage + 1) + ', \'' + keyword + '\')">&hellip;</a></li>';
                            break;
                        case 'filter':
                            html += '<li class="page-item"><a class="page-link" href="#" onclick="cariSpesifik(' + (endPage + 1) + ', \'' + tipe + '\', \'' + nama + '\')">&hellip;</a></li>';
                            break;
                        default:
                            html += '<li class="page-item"><a class="page-link" href="#" onclick="getData(' + (endPage + 1) + ')">&hellip;</a></li>';
                    }
                    // html += '<li class="page-item"><a class="page-link" href="#" onclick="getData(' + (endPage + 1) + ')">&hellip;</a></li>';
                }
            }

            switch (type) {
                case 'search':
                    html += '<li class="page-item ' + nextClass + '"><a class="page-link" href="#" onclick="searchBerita(' + (currentPage + 1) + ', \'' + keyword + '\')">Next</a></li></ul></nav>';
                    break;
                case 'filter':
                    html += '<li class="page-item ' + nextClass + '"><a class="page-link" href="#" onclick="cariSpesifik(' + (currentPage + 1) + ', \'' + tipe + '\', \'' + nama + '\')">Next</a></li></ul></nav>';
                    break;
                default:
                    html += '<li class="page-item ' + nextClass + '"><a class="page-link" href="#" onclick="getData(' + (currentPage + 1) + ')">Next</a></li></ul></nav>';
            }
            // html += '<li class="page-item ' + nextClass + '"><a class="page-link" href="#" onclick="getData(' + (currentPage + 1) + ')">Next</a></li></ul></nav>';

            $('.pagination').html(html);
        }

        function loopdata(data) {
            document.getElementById("beritaatas").innerHTML = "";
            document.getElementById("beritabawah").innerHTML = "";
            if (data.length >= 1) {
                const card1 = `
                <div class="card mb-3">
                    <div style="max-height: 350px; overflow: hidden">
                        <div class="img-thumbnail skeleton" id="skeleton-1"></div>
                        <img class="card-img-top img-id-1" src="#" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <center>
                            <h2 class="card-title" id="card-judul-1">Judul</h2>
                            <p class="card-text mb-3">
                                <small class="text-muted">
                                    Diposting :
                                    <text id="card-tanggal-1">.</text>
                                </small>
                                <br>
                                <small class="text-muted" id="card-categorinya">
                                    Kategori : <a href="#" id="card-kategori-1">nama_kategori</a>.
                                </small>
                                <br>
                                <small class="text-muted">
                                    By : <a href="#" id="card-author-1">nama_author</a>.
                                </small>
                            </p>
                        </center>

                        <p class="card-text" id="card-excerpt-1">excerpt</p>
                        <center>
                            <a href="#" class="btn btn-primary mb-3" id="card-selengkapnya-1">
                                Baca Selengkapnya
                            </a>
                        </center>
                    </div>
                </div>
                `;
                document.getElementById("beritaatas").insertAdjacentHTML("beforeend", card1);
                $.each(data, function (index, value) {
                        const id = index + 1;
                        const judul = value.judul;
                        const excerpt = value.excerpt;
                        const tanggal = moment(value.created_at, "YYYYMMDD").fromNow();
                        const kategori = value.categori;
                        const author = value.author;
                        const gambar = value.gambar;
                        const slug = value.slug;

                        if (id >= 2) {
                            const card = `
    <div class="col-md-4 mb-3">
      <div class="card" data-aos="fade-in">
        <div style="max-height: 250px; overflow: hidden">
          <div class="img-thumbnail skeleton" id="skeleton-${id}"></div>
          <img class="card-img-top img-id-${id}" src="#" alt="Gambar" style="height: 270px">
        </div>
        <div class="card-body">
          <h5 class="card-title" id="card-judul">${judul}</h5>
          <p class="ql-align-justify" id="card-excerpt">${excerpt}</p>
          <a href="#" class="btn btn-primary mb-3" id="card-selengkapnya">Baca Selengkapnya</a>
          <p class="card-text">
            <small class="text-muted">
              <text id="card-tanggal">Diposting : ${moment(value.created_at, "YYYYMMDD").fromNow()}.</text>
            </small>
            <br>
            <small class="text-muted">
              Kategori : <a href="#" id="card-kategori" onclick="cariSpesifik(1,'kategori', '${kategori}')">${kategori}</a>.
            </small>
            <br>
            <small class="text-muted">
              By : <a href="#" id="card-author" onclick="cariSpesifik(1,'author', '${author}')">${author}</a>.
            </small>
          </p>
        </div>
      </div>
    </div>
  `;
                            document.getElementById("beritabawah").insertAdjacentHTML("beforeend", card);
                        } else {
                            $('#card-judul-' + id).text(judul);
                            $('#card-excerpt-' + id).text(excerpt);
                            $('#card-tanggal-' + id).text(tanggal);
                            $('#card-kategori-' + id).text(kategori).on('click', function () {
                                const categtory = $(this).text();
                                cariSpesifik(1, 'kategori', categtory)
                            });
                            $('#card-author-' + id).text(author).on('click', function () {
                                const author = $(this).text();
                                cariSpesifik(1, 'author', author)
                            });
                            ;
                            const urlslug = "{{ route('berita-detail', '') }}" + '/' + slug;
                            $('#card-selengkapnya-' + id).attr('href', urlslug);
                        }
                        const url = '{{asset('storage')}}' + '/' + gambar;
                        const imgid = $('.img-id-' + id);
                        const skeleton = $('#skeleton-' + id);
                        changeimage(url, imgid, skeleton)
                    }
                );
            } else {
                document.getElementById("beritaatas").innerHTML = "<center><h1>Data tidak ditemukan</h1></center>";
                Swal.fire({
                    title: 'Ooops!',
                    html: 'data yang anda cari tidak ditemukan.',
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
            }
        }

        window.onload = function () {
            getData(1);
        };

        function changeimage(url, image, skeleton) {
            fetch(url)
                .then(response => response.blob())
                .then(blob => {
                    const gambar = URL.createObjectURL(blob);
                    skeleton.remove();
                    image.attr('src', gambar);
                });
        }
    </script>
@endsection
