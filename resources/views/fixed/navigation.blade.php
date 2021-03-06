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
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="{{route('home')}}">Pocetna
                </a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" href="{{route('products')}}">Prozivodi</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('about')}}">O nama</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('contact')}}">Kontakt</a>
              </li>
            </ul>
          </div>

          <div id="login-register-div">

          <ul>
            <li><a href="{{route('login')}}">Prijava</a></li>
            <li><p>/</p></li>
            <li><a href="{{route('register')}}">Registracija</a></li>
          </ul>

          </div>
          <a id="user-icon" href="#"><i class="fa fa-user"></i></a>
        </div>
      </nav>
    </header>