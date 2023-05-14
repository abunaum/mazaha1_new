<nav id="navbar" class="navbar">
    <ul>
        <li><a class="nav-link scrollto {{ ($pages === 'home') ? 'active' : '' }}" href="{{ url('/') }}">Home</a></li>
        <li class="dropdown">
            <a href="#">
                <span>Tentang Kami</span> <i class="bi bi-chevron-down"></i>
            </a>
            <ul>
                <li>
                    <a class="nav-link scrollto" href="{{ route('sambutan') }}">
                        Sambutan Kepala Madrasah
                    </a>
                </li>
                <li>
                    <a class="nav-link scrollto" href="{{ route('sejarah') }}">
                        Sejarah Madrasah
                    </a>
                </li>
                <li>
                    <a class="nav-link scrollto {{ ($pages === 'profile') ? 'active' : '' }}"
                       href="{{ url('/profile') }}">
                        Profile Madrasah
                    </a>
                </li>
                <li>
                    <a class="nav-link scrollto {{ ($pages === 'visi-misi') ? 'active' : '' }}"
                       href="{{ url('/visi-misi') }}">
                        Visi-Misi
                    </a>
                </li>
                <li>
                    <a class="nav-link scrollto {{ ($pages === 'struktur') ? 'active' : '' }}"
                       href="{{ route('struktur-organisasi') }}">
                        Struktur Organisasi
                    </a>
                </li>
                <li>
                    <a class="nav-link scrollto {{ ($pages === 'staff-pengajar') ? 'active' : '' }}"
                       href="{{ url('/tenaga-pendidik') }}">
                        Tenaga Pendidik
                    </a>
                </li>
                <li>
                    <a class="nav-link scrollto" href="{{ url('/tenaga-kependidikan') }}">
                        Tenaga Kependidikan
                    </a>
                </li>
{{--                <li>--}}
{{--                    <a class="nav-link scrollto" href="{{ route('sarpras') }}">--}}
{{--                        Sarana Prasarana--}}
{{--                    </a>--}}
{{--                </li>--}}
            </ul>
        </li>
        <li><a class="nav-link scrollto" href="{{route('program-view')}}">Program</a></li>
        <li class="dropdown">
            <a href="#">
                <span>Informasi</span> <i class="bi bi-chevron-down"></i>
            </a>
            <ul>
                <li><a class="nav-link scrollto" href="{{ url('/berita') }}">Berita</a></li>
                <li><a class="nav-link scrollto" href="{{ route('agenda-list') }}">Agenda</a></li>
                <li><a class="nav-link scrollto"
                       href="https://drive.google.com/drive/folders/1MM8y1__qJr4pGJxhXFDqRwdLafBIAM1S" target="_blank">Galeri</a>
                </li>
            </ul>
        </li>
        <li><a class="nav-link scrollto" href="{{route('kontak')}}">Kontak</a></li>
        <li><a class="getstarted scrollto" href="https://ppsb.mazainulhasan1.sch.id" target="_blank">PPSB</a></li>
    </ul>
    <i class="bi bi-list mobile-nav-toggle"></i>
</nav>
