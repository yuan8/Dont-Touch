@if(Auth::user())

<div class="widget-content-left">
    <div class="btn-group">
        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
            <img width="42" class="rounded-circle" src="{{asset('assets/images/avatars/user.png')}}" alt="">
            <i class="fa fa-angle-down ml-2 opacity-8"></i>
        </a>
        <div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
            <div class="dropdown-menu-header">
                <div class="dropdown-menu-header-inner bg-info">
                    <div class="menu-header-image opacity-2" style="background-image: url('{{asset('assets/images/dropdown-header/city3.jpg')}}');"></div>
                    <div class="menu-header-content text-left">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left mr-3">
                                    <img width="42" class="rounded-circle" src="{{asset('assets/images/avatars/user.png')}}" alt="">
                                </div>
                                <div class="widget-content-left">
                                    <div class="widget-heading">
                                        {{Auth::User()->name}}
                                    </div>
                                    <div class="widget-subheading opacity-8">
                                        <!-- A short profile description -->
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="scroll-area-xs" style="height: 150px;">
                <div class="scrollbar-container ps">
                    <div class="grid-menu grid-menu-xl grid-menu-3col">
                                <div class="no-gutters row">
                                    <div class="col-sm-6 col-xl-4">
                                        <a href="{{route('maps')}}" class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                            <i class="pe-7s-map icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"></i>
                                            Maps
                                        </a >
                                    </div>
                                    <div class="col-sm-6 col-xl-4">
                                        <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                            <i class="pe-7s-user icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"> </i>
                                            Account
                                        </button>
                                    </div>
                                    <div class="col-sm-6 col-xl-4">
                                        <button  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                            <i class="pe-7s-close-circle icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"> </i>
                                            Log Out
                                        </button>
                                       

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                   
                                </div>
                    </div>
                </div>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item-divider mb-0 nav-item"></li>
            </ul>
         
        </div>
    </div>
</div>
<div class="widget-content-left  ml-3 header-user-info">
    <div class="widget-heading">
       {{Auth::User()->name}}
    </div>
    <div class="widget-subheading">
        <!-- VP People Manager -->
    </div>
</div>




@else
	<div class="widget-content-left">
    <div class="btn-group">
        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
            <img width="42" class="rounded-circle" src="{{asset('assets/images/avatars/1.png')}}" alt="">
            <i class="fa fa-angle-down ml-2 opacity-8"></i>
        </a>
        <div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
            <div class="dropdown-menu-header">
                <div class="dropdown-menu-header-inner bg-info">
                    <div class="menu-header-image opacity-2" style="background-image: url('{{asset('assets/images/dropdown-header/city3.jpg')}}');"></div>
                    <div class="menu-header-content text-left">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left mr-3">
                                    <img width="42" class="rounded-circle" src="{{asset('assets/images/avatars/1.png')}}" alt="">
                                </div>
                                <div class="widget-content-left">
                                    <div class="widget-heading">Guest
                                    </div>
                                    <div class="widget-subheading opacity-8">
                                        <!-- A short profile description -->
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="scroll-area-xs" style="height: 150px;">
                <div class="scrollbar-container ps">
                    <ul class="nav flex-column">
                       
                        <li class="nav-item">
                            <a href="{{url('login')}}" class="nav-link">Login
                        </a>
                        </li>
                      
                        
                    </ul>
                </div>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item-divider mb-0 nav-item"></li>
            </ul>
         
        </div>
    </div>
</div>
<div class="widget-content-left  ml-3 header-user-info">
    <div class="widget-heading">
       Guest
    </div>
    <div class="widget-subheading">
        <!-- VP People Manager -->
    </div>
</div>



@endif