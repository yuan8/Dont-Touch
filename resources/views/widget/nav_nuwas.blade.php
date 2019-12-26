<ul class="header-megamenu nav">
    <li class="nav-item dropdown">
        <a  aria-haspopup="true" data-toggle="dropdown" class="nav-link" aria-expanded="false">
        	<i class="nav-link-icon pe-7s-gift"> </i> Profile Dearah</a>

        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-rounded dropdown-menu-lg rm-pointers dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);" >

        	<a href="{{route('n.init',['tahun'=>2020])}}" tabindex="0" class="dropdown-item">Chart</a>
        	<a href="{{route('n.program_kegiatan_table',['tahun'=>2020])}}" tabindex="0" class="dropdown-item">Program Kegiatan</a>

            
        </div>
    </li>

    <li class="nav-item dropdown">
        <a  aria-haspopup="true" data-toggle="dropdown" class="nav-link" aria-expanded="false">
            <i class="nav-link-icon pe-7s-gift"> </i> Profile Kebijakan</a>

        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-rounded dropdown-menu-lg rm-pointers dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);" >

            <a href="{{route('n.kebijakan',['tahun'=>2020])}}" tabindex="0" class="dropdown-item">Kebijakan Pusat</a>
            <a href="{{route('n.kebijakanDaerah',['tahun'=>2020])}}" tabindex="0" class="dropdown-item">Kebijakan Daerah</a>

            
        </div>
    </li>



    <li class="nav-item">
        <a href="" class="nav-link"><i class="nav-link-icon pe-7s-gift"> </i> Profile PDAM</a>
    </li>
</ul>