<!-- This file is used to store topbar (right) items -->


{{-- <li class="nav-item d-md-down-none"><a class="nav-link" href="#"><i class="la la-bell"></i><span class="badge badge-pill badge-danger">5</span></a></li>
<li class="nav-item d-md-down-none"><a class="nav-link" href="#"><i class="la la-list"></i></a></li>
<li class="nav-item d-md-down-none"><a class="nav-link" href="#"><i class="la la-map"></i></a></li> --}}
<li class="nav-item dropdown pr-0">
    <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        @switch(App::getLocale())
            @case('en')
                <img src="{{ asset('images/flag/english.png') }}" style="width: 25px;"/>
            @break
            @case('kh')
                <img src="{{ asset('images/flag/khmer.png') }}" style="width: 25px;"/>
            @break
            @default
            <img src="{{ asset('images/flag/english.png') }}" style="width: 25px;"/>
        @endswitch
    </a>
    <div class="dropdown-menu dropdown-menu-right mr-4 pb-1 pt-1">
        <a class="dropdown-item" href="{{ url('lang/en') }}">
            <img src="{{ asset('images/flag/english.png') }}" style="width: 25px;" class="mr-2"/>English
        </a>
        <div class="dropdown-divider m-0"></div>
        <a class="dropdown-item" href="{{ url('lang/kh') }}">
            <img src="{{ asset('images/flag/khmer.png') }}" style="width: 25px;" class="mr-2"/>Khmer
        </a>
    </div>
</li>
