<footer>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="inner-content">
              <p>Copyright &copy; 2020 Sixteen Clothing Co., Ltd.

            - Design: <a rel="nofollow noopener" href="https://templatemo.com" target="_blank">TemplateMo</a></p>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <script src="{{asset('assets/js/owl.js')}}"></script>
    <script src="{{asset('assets/js/slick.js')}}"></script>
    <script src="{{asset('assets/js/isotope.js')}}"></script>
    <script src="{{asset('assets/js/accordions.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>

    @if (Route::current()->uri() == '/')
      <script src="{{asset('assets/js/homePage.js')}}"></script>
    @endif

    @if (Route::current()->uri() == 'register')
      <script src="{{asset('assets/js/registerAction.js')}}"></script>
    @endif

    @if (Route::current()->uri() == 'login')
      <script src="{{asset('assets/js/loginAction.js')}}"></script>
    @endif

    @if (Route::current()->uri() == 'products')
      <script src="{{asset('assets/js/productPage.js')}}"></script>
    @endif

    @if(Route::currentRouteName() === 'showProduct')
    <script src="{{ asset('assets/js/leaveCommentAction.js') }}"></script>
    @endif

    @if (Session::has('user'))
      <script src="{{asset('assets/js/logutAction.js')}}"></script>
    @endif

  </body>
</html>
