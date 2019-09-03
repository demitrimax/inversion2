<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title',config('app.name')) </title>
        <link rel="stylesheet" href="{{asset('alpha/assets/css/main.css')}}" />


    </head>
    <body class="landing is-preload">
      <!-- Header -->
        <header id="header" class="alt">
          <h1><a href="index.html">Alpha</a> by HTML5 UP</h1>
          <nav id="nav">
            <ul>
              <li><a href="{{ url('/home') }}">Principal</a></li>

              <li>
                @if (Route::has('login'))

                        @auth
                            <a href="{{ url('/home') }}" class="button">Principal</a>
                        @else
                            <a href="{{ route('login') }}" class="button">Inicie Sesión</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="button">Registrese</a>
                            @endif
                        @endauth

                @endif
            </ul>
          </nav>
        </header>

      <!-- Banner -->
        <section id="banner">
          <h2>Proyectos de Inversión</h2>
          <p>Nos dedicamos a tu proyecto.</p>
          <ul class="actions special">
            <li><a href="{{ route('register') }}" class="button primary">Registrese</a></li>
            <li><a href="{{ route('login') }}" class="button">Inicie Sesión</a></li>
          </ul>
        </section>





      <!-- Footer -->
        <footer id="footer">
          <ul class="icons">
            <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
            <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
            <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
            <li><a href="#" class="icon brands fa-github"><span class="label">Github</span></a></li>
            <li><a href="#" class="icon brands fa-dribbble"><span class="label">Dribbble</span></a></li>
            <li><a href="#" class="icon brands fa-google-plus"><span class="label">Google+</span></a></li>
          </ul>
          <ul class="copyright">
            <li>&copy; Proyectos de Inversión. Todos los derechos reservados.</li><li>Diseño por: <a href="http://html5up.net">HTML5 UP</a></li>
          </ul>
        </footer>

    </div>

    <!-- Scripts -->
      <script src="{{asset('alpha/assets/js/jquery.min.js')}}"></script>
      <script src="{{asset('alpha/assets/js/jquery.dropotron.min.js')}}"></script>
      <script src="{{asset('alpha/assets/js/jquery.scrollex.min.js')}}"></script>
      <script src="{{asset('alpha/assets/js/browser.min.js')}}"></script>
      <script src="{{asset('alpha/assets/js/breakpoints.min.js')}}"></script>
      <script src="{{asset('alpha/assets/js/util.js')}}"></script>
      <script src="{{asset('alpha/assets/js/main.js')}}"></script>
    </body>
</html>
