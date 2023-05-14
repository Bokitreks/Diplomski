<!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="{{route('home')}}"><h2>Bota <em>Shop</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar ml-auto">
                @foreach($navigation as $nav)
                <li class="nav-item">
                    <a class="nav-link" href="{{route($nav->href)}}">{{$nav->name}}</a>
                  </li>
                @endforeach
            </ul>
          </div>
          <div id="login-register-div">
            <ul>
                @if (!Session::has('user'))
                    <li><a class="login-register-link" href="{{route('login')}}">Prijava</a></li>
                    <li><p>/</p></li>
                    <li><a class="login-register-link" href="{{route('register')}}">Registracija</a></li>
                @else
                <li><a id="#" class="userButtons" href="#">Podesavanja</a></li>
                <li><p> | </p></li>
                <li><a id="logut_button" class="userButtons" href="#">Odjava</a></li>
                @endif
              </ul>
          </div>
          <a id="user-icon" href="#"><i class="fa fa-user"></i></a>
          @if (Session::has('user'))
            <h4 id="username" data-value="{{Session::get('user.id')}}">{{Session::get('user.username')}}</h4>
            <a id="cart" href="{{route('cart')}}"><i class="fa fa-shopping-cart"></i></a>
          @endif
        </div>
      </nav>
    </header>
