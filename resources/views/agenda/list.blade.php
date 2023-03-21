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
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
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
                            <input type="text" class="form-control" placeholder="Cari Agenda" name="cari"
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
        <div class="container">
            <div class="row justify-content-center">
                <div class="agenda">
                    <div id="loading" class="loading-container">
                        <div class="loading-spinner"></div>
                    </div>
                    <div id="listagenda"></div>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <div class="pagination"></div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        window.onload = function () {
            getData(1);
        };

        $('#search-form').on('submit', function (e) {
            e.preventDefault();
            const keyword = $('#search-input').val();
            searchBerita(1, keyword);
        });

        function searchBerita(page, keyword) {
            $('.berita > *:not(#loading)').hide();
            $('#loading').show();
            const url = '{{ route("api-agenda-public") }}?page=' + page + '&search=' + keyword;
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
                    $('#loading').hide();
                    Swal.fire({
                        title: 'Ooops!',
                        html: `Gagal terkoneksi ke server.<br>Status: ${textStatus} ${errorThrown}`,
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
            });
        }

        function getData(page) {
            $('.berita > *:not(#loading)').hide();
            $('#loading').show();
            const url = '{{ route("api-agenda-public") }}?page=' + page;
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
                    loopdata(data.data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#loading').hide();
                    Swal.fire({
                        title: 'Ooops!',
                        html: `Gagal terkoneksi ke server.<br>Status: ${textStatus} ${errorThrown}`,
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
                default:
                    html += '<li class="page-item ' + prevClass + '"><a class="page-link" href="#" onclick="getData(' + (currentPage - 1) + ')">Previous</a></li>';
            }

            if (lastPage <= 5) {
                for (var i = 1; i <= lastPage; i++) {
                    var activeClass = i === currentPage ? 'active' : '';
                    switch (type) {
                        case 'search':
                            html += '<li class="page-item ' + activeClass + '"><a class="page-link" href="#" onclick="searchBerita(' + i + ', \'' + keyword + '\')">' + i + '</a></li>';
                            break;
                        default:
                            html += '<li class="page-item ' + activeClass + '"><a class="page-link" href="#" onclick="getData(' + i + ')">' + i + '</a></li>';
                    }
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
                        default:
                            html += '<li class="page-item"><a class="page-link" href="#" onclick="getData(' + (startPage - 1) + ')">&hellip;</a></li>';
                    }
                }

                for (var i = startPage; i <= endPage; i++) {
                    var activeClass = i === currentPage ? 'active' : '';
                    switch (type) {
                        case 'search':
                            html += '<li class="page-item ' + activeClass + '"><a class="page-link" href="#" onclick="searchBerita(' + i + ', \'' + keyword + '\')">' + i + '</a></li>';
                            break;
                        default:
                            html += '<li class="page-item ' + activeClass + '"><a class="page-link" href="#" onclick="getData(' + i + ')">' + i + '</a></li>';
                    }
                }

                if (endPage < lastPage) {
                    switch (type) {
                        case 'search':
                            html += '<li class="page-item"><a class="page-link" href="#" onclick="searchBerita(' + (endPage + 1) + ', \'' + keyword + '\')">&hellip;</a></li>';
                            break;
                        default:
                            html += '<li class="page-item"><a class="page-link" href="#" onclick="getData(' + (endPage + 1) + ')">&hellip;</a></li>';
                    }
                }
            }

            switch (type) {
                case 'search':
                    html += '<li class="page-item ' + nextClass + '"><a class="page-link" href="#" onclick="searchBerita(' + (currentPage + 1) + ', \'' + keyword + '\')">Next</a></li></ul></nav>';
                    break;
                default:
                    html += '<li class="page-item ' + nextClass + '"><a class="page-link" href="#" onclick="getData(' + (currentPage + 1) + ')">Next</a></li></ul></nav>';
            }

            $('.pagination').html(html);
        }

        function loopdata(data) {
            document.getElementById("listagenda").innerHTML = "";
            $.each(data, async function (index, value) {
                const id = index + 1;
                const idnya = value.id;
                const judul = value.judul;
                const body = removeTags(value.body);
                const waktu = moment(value.waktu).format('Do MMMM YYYY, h:mm a');
                const tempat = value.tempat;
                const gambar = value.gambar;
                const slug = value.slug;

                const urllink = '{{ route("agenda-detail", ["id" => ":id"]) }}';
                const detailUrl = urllink.replace(':id', id);

                const count = 200;
                const excerpt = body.slice(0, count) + (body.length > count ? "..." : "");
                const card = `
                <div class="col-md-4 mb-3">
                    <div class="card" data-aos="fade-in">
                        <div style="max-height: 250px; overflow: hidden">
                            <div class="img-thumbnail skeleton" id="skeleton-${id}"></div>
                            <img class="card-img-top img-id-${id}" src="#" alt="Gambar" style="height: 270px">
                        </div>
                        <div class="card-body">
                            <center>
                                <h5 class="card-title">${judul}</h5>
                             </center>
                             <p class="ql-align-justify">${excerpt}</p>
                             <a href="${detailUrl}" class="btn btn-primary mb-3" id="agenda-lengkap-${id}">Baca Selengkapnya</a>
                             <p class="card-text">
                                <small class="text-muted">Tempat : ${tempat }</small>
                             <br>
                             <small class="text-muted"> Waktu : ${waktu}</small>
                             </p>
                        </div>
                    </div>
                </div>
                `;
                {{--const urllink = '{{ route('berita-detail', ':id') }}'.replace(':id', idnya);--}}
                {{--$('#agenda-lengkap-' + id).attr('href', urllink);--}}
                {{--console.log(urllink);--}}
                await document.getElementById("listagenda").insertAdjacentHTML("beforeend", card);
                const url = '{{asset('storage')}}' + '/' + gambar;
                const imgid = $('.img-id-' + id);
                const skeleton = $('#skeleton-' + id);
                changeimage(url, imgid, skeleton)
            })
        }

        function changeimage(url, image, skeleton) {
            fetch(url)
                .then(response => response.blob())
                .then(blob => {
                    const gambar = URL.createObjectURL(blob);
                    skeleton.remove();
                    image.attr('src', gambar);
                });
        }
        function removeTags(str) {
            if ((str===null) || (str===''))
                return false;
            else
                str = str.toString();
            return str.replace( /(<([^>]+)>)/ig, '');
        }
    </script>
@endsection
