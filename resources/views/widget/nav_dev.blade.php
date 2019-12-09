<?php
    if(!isset($menu_id)){
        $menu_id='s';
    }

    if(!isset($tahun)){
        $tahun=2020;
    }


?>

<ul class="vertical-nav-menu">
    <li class="app-sidebar__heading">Menu</li>
    <li class="{{$menu_id=='s.1'?'mm-active':''}}">
        <a href="{{route('fs.f1.index',['bidang_urusan_link'=>$id_link])}}" >
            <i class="fa-stack metismenu-icon number">
                1    
            </i>  
                IDENTIFIKASI KEBIJAKAN (K/L)
            </a>
    </li>
     <li class="{{$menu_id=='s.2'?'mm-active':''}}">
        <a href="{{route('fs.f2.index',['id_link'=>$id_link])}}" >
            <i class="fa-stack metismenu-icon number">
                2    
            </i>  
                IDENTIFIKASI KEBIJAKAN PUSAT 5 TAHUNAN
            </a>
    </li>
     <li class="{{$menu_id=='s.3'?'mm-active':''}}">
        <a href="{{route('fs.f3.index',['id_link'=>$id_link])}}" >
            <i class="fa-stack metismenu-icon number">
                3    
            </i>  
                IDENTIFIKASI KEBIJAKAN PUSAT TAHUNAN
            </a>
    </li>
     <li class="{{$menu_id=='s.4'?'mm-active':''}}">
        <a href="{{route('fs.f4.index',['id_link'=>$id_link])}}" >
            <i class="fa-stack metismenu-icon number">
                4    
            </i>  
                DATA PERMASALAHAN URUSAN
            </a>
    </li>
     <li class="{{$menu_id=='s.5'?'mm-active':''}}">
        <a href="{{route('fs.f5.index',['id_link'=>$id_link])}}" >
            <i class="fa-stack metismenu-icon number">
                5    
            </i>  
                PROGRAM KEGIATAN DAERAH LINGKUP SUPD II
            </a>
    </li>
     <li class="{{$menu_id=='s.6'?'mm-active':''}}">
        <a href="{{route('fs.f6.index',['id_link'=>$id_link])}}" >
            <i class="fa-stack metismenu-icon number">
                6    
            </i>  
               DATA PELAKSANAAN URUSAN LINGKUP SUPD II
            </a>
    </li>
     <li class="{in_array($menu_id,['s.7.1','s.7.2','s.7.3'])?'mm-active':''}}">
        <a href="#" >
            <i class="fa-stack metismenu-icon number">
                7    
            </i>  
                INTEGRASI
                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
            </a>
            <ul>
            <li class="app-sidebar__heading">Menu Integrasi</li>

                 <li class="{{$menu_id=='s.7.1'?'mm-active':''}}">
                    <a href="{{route('fs.f7.index',['id_link'=>$id_link])}}" >
                        <i class=" metismenu-icon  pe-7s-ribbon">
                        </i>  
                           INTEGRASI
                        </a>
                </li>

                 <li class="{{$menu_id=='s.7.2'?'mm-active':''}}">
                    <a href="{{route('fs.f7.identifikasi.integrasi_provinsi',['id_link'=>$id_link])}}" >
                        <i class="metismenu-icon  pe-7s-ribbon">
                        </i>  
                           INTEGRASI PROVINSI
                        </a>
                </li>
                <li class="{{$menu_id=='s.7.3'?'mm-active':''}}">
                    <a href="{{route('fs.f7.identifikasi.integrasi_kota_kabupaten',['id_link'=>$id_link])}}" >
                        <i class="pe-7s-ribbon metismenu-icon ">
                        </i>  
                           INTEGRASI KOTA KAB
                        </a>
                </li>
            </ul>
    </li>
     <li class="{{$menu_id=='s.8'?'mm-active':''}}">
        <a href="{{route('fs.f8.index',['id_link'=>$id_link])}}" >
            <i class="fa-stack metismenu-icon number">
                8    
            </i>  
                MONEV PELAKSANAAN RENCANA PEMBANGUNAN DAERAH LINGKUP SUPD 2
            </a>
    </li>
     <li class="{{$menu_id=='s.9'?'mm-active':''}}">
        <a href="{{route('fs.f9.index',['id_link'=>$id_link])}}" >
            <i class="fa-stack metismenu-icon number">
                9    
            </i>  
               EVALUASI CAPAIAN PELAKSANAAN URUSAN PEMERINTAHAN DI INTERNAL DAERAH
            </a>
    </li>
     <li class="{{$menu_id=='s.10'?'mm-active':''}}">
        <a href="{{route('fs.f10.index',['id_link'=>$id_link])}}" >
            <i class="fa-stack metismenu-icon number">
                10    
            </i>  
                EVALUASI CAPAIAN PELAKSANAAN URUSAN PEMERINTAHA
            </a>
    </li>
     

    
    
</ul>   

<style type="text/css">
    

    .metismenu-icon.number{
        border:1px solid #222;
        font-size: 14px !Important;
        font-style: unset;
        border-radius: 100%;
        color: blue;
        font-weight: bold;  
        opacity: 1!important;
    }
    .mm-active .metismenu-icon.number{
        background-color: #ffc107;
    }
    .vertical-nav-menu li a{
        font-size: 10px!important;
        white-space: nowrap;
        overflow: hidden !important;
        text-overflow: ellipsis;

    }

</style>