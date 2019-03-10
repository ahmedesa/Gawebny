<nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-inverse">
    <div class="container">
        <a style="
           background-image: url('{{setting_($setting,'logo')}}');" class="navbar-brand mylogo" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/') }}"><i class="fa fa-home"></i> {{ trans('layout.home') }}</a>
                </li>
                @include('Gawebny.layouts.notification')
            </ul>
            <form method="GET" action="{{ url('search') }}" class="form-inline my-2 my-lg-0 col-md-5">
                <input class="myform-control mr-sm-2" name="q" type="search" placeholder="{{ trans('layout.search') }}" aria-label="Search">
                <button style="border: none;" class="btn btn-light"><i class="fa fa-search"></i></button>
            </form>
            <ul class="navbar-nav ml-auto">
                @auth
                <li>
                    <button data-toggle="modal" data-target="#exampleModal" id="add-question" class="btn mybtn btn-success">{{ trans('layout.add_question') }}</button>
                </li>
                @endauth
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ trans('layout.login') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('set.language', 'ar') }}">العربية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('set.language', 'en') }}">english</a>
                </li>
                @else
                <li class="avatar-profile d-none d-sm-block ">
                    <a href="#"><img src="{{ asset('Gawebny/img/'.Auth::user()->image) }}" class="img-responsive" /></a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @if (Auth::user()->admin==1)
                        <a class="dropdown-item" href="{{ url('dashbord') }}">
                            {{ trans('layout.dashbord') }}
                            <i class="fa fa-tachometer" aria-hidden="true"></i>
                        </a>
                        @endif
                        <a class="dropdown-item" href="{{ url('profile/'.Auth::id()) }}">
                            {{ trans('layout.profile') }}
                        </a>
                        <a class="dropdown-item" href="{{ url('settings/information') }}">
                            {{ trans('layout.settings') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                            {{ trans('layout.logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <hr>
                        <a class="dropdown-item" href="{{ route('set.language', 'en') }}">english</a>
                        <a class="dropdown-item" href="{{ route('set.language', 'ar') }}">العربية</a>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
