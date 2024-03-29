<li class="nav-heading">Master Data</li>
<li class="nav-item">
    <a class="nav-link @if(!isset($tab)) collapsed @elseif($tab !== 'Data Person') collapsed @endif" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-person"></i><span>Data Person</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse @if(isset($tab)) @if($tab === 'Data Person') show @endif @endif" data-bs-parent="#sidebar-nav">
        <li>
            <a href="{{ $url_panel.'/admin/guru-staff' }}" @if($pages === 'Guru & Staff') class="active" @endif>
                <i class="bi bi-circle"></i><span>Guru & Staff</span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a class="nav-link @if(!isset($tab)) collapsed @elseif($tab !== 'Agenda') collapsed @endif" data-bs-target="#agenda-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-calendar"></i><span>Data Agenda</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="agenda-nav" class="nav-content collapse @if(isset($tab)) @if($tab === 'Agenda') show @endif @endif" data-bs-parent="#sidebar-nav">
        <li>
            <a href="{{ route('agenda')}}" @if($pages === 'Semua Agenda') class="active" @endif>
                <i class="bi bi-circle"></i><span>Semua Agenda</span>
            </a>
        </li>
        <li>
            <a href="{{ route('agenda-tambah') }}" @if($pages === 'Tambah Agenda') class="active" @endif>
                <i class="bi bi-circle"></i><span>Tambah Agenda</span>
            </a>
        </li>
    </ul>
</li>
<!-- End Profile Page Nav -->

