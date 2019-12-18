<?php
    if(!isset($menu_id)){
        $menu_id=0;
    }

    if(!isset($tahun)){
        $tahun=2020;
    }

?>

<ul class="vertical-nav-menu">
    <li class="app-sidebar__heading">Menu</li>
    <li class="{{(in_array($menu_id,['1.1']))?'mm-active':''}}">
        <a href="#">
            <i class="metismenu-icon pe-7s-rocket"></i> Dashboards
            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
        </a>
        <ul>
            <li class="{{$menu_id=='1.0'?'mm-active':''}}">
                <a href="{{route('home',['tahun'=>$tahun])}}" >
                    <i class="metismenu-icon">
                    </i>Home
                </a>
            </li>
            <li class="{{$menu_id=='1.1'?'mm-active':''}}">
                <a href="{{route('data.kegiatan_spud2_provinsi_table',['tahun'=>$tahun])}}" >
                    <i class="metismenu-icon">
                    </i>Data Kegiatan SUPD2
                </a>
            </li>
            <!-- <li>
                <a href="dashboards-commerce.html">
                    <i class="metismenu-icon">
                    </i>Commerce
                </a>
            </li> -->
           
        </ul>
    </li>

    <li class="{{(in_array($menu_id,['2.1','2.2','2.3','2.4','2.5','2.6']))?'mm-active':''}}" >
        <a href="#">
            <i class="metismenu-icon pe-7s-graph1 text-cuccess"></i> Chart Provinsi
            <i class="metismenu-state-icon pe-7s-angle-down caret-left "></i>
        </a>
        <ul>
             <li class="{{$menu_id=='2.1'?'mm-active':''}}">
                <a href="{{route('data.anggaran',['tahun'=>$tahun])}}">
                    <i class="metismenu-icon">
                    </i>Anggaran
                </a>
            </li>
            <li class="{{$menu_id=='2.2'?'mm-active':''}}">
                <a href="{{route('data.index',['tahun'=>$tahun])}}" >
                    <i class="metismenu-icon">
                    </i> Program Kegiatan
                </a>
            </li>
            <li class="{{$menu_id=='2.3'?'mm-active':''}}">
                <a href="{{route('data.tagging',['tahun'=>$tahun])}}">
                    <i class="metismenu-icon">
                    </i>NSPK,SPM,PN,SDGS
                </a>
            </li>

            <li class="{{$menu_id=='2.4'?'mm-active':''}}">
                <a href="{{route('data.tingkatan',['tahun'=>$tahun])}}">
                    <i class="metismenu-icon">
                    </i>Profile Daerah
                </a>
            </li>
             <li class="{{$menu_id=='2.5'?'mm-active':''}}">
                <a href="{{route('data.tingkatan_urusan',['tahun'=>$tahun])}}">
                    <i class="metismenu-icon">
                    </i>Profile Urusan
                </a>
            </li> 
            <li class="{{$menu_id=='2.6'?'mm-active':''}}">
                <a href="{{route('data.pendukung',['tahun'=>$tahun])}}">
                    <i class="metismenu-icon">
                    </i>Kegiatan Pendukung
                </a>
            </li> 
                        
        </ul>
    </li>


       <li class="{{(in_array($menu_id,['3.1','3.2','3.3']))?'mm-active':''}}" >
        <a href="#">
            <i class="metismenu-icon pe-7s-graph1 text-cuccess"></i> Chart Kota / Kabupaten
            <i class="metismenu-state-icon pe-7s-angle-down caret-left "></i>
        </a>
        <ul>
             <li class="{{$menu_id=='3.1'?'mm-active':''}}">
                <a href="{{route('data.anggaran',['tahun'=>$tahun])}}">
                    <i class="metismenu-icon">
                    </i>Anggaran
                </a>
            </li>
            <li class="{{$menu_id=='3.2'?'mm-active':''}}">
                <a href="{{route('data.index',['tahun'=>$tahun])}}" >
                    <i class="metismenu-icon">
                    </i> Program Kegiatan
                </a>
            </li>
        </ul>
    </li>
    
</ul>  

