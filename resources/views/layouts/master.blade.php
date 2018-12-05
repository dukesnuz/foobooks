<!DOCTYPE html>
<html>
<head>
  <title>
    @yield('title', 'Foobooks')
  </title>

  <meta charset='utf-8'>

  <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet'>
  <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
  <link href="/css/foobooks.css" type='text/css' rel='stylesheet'>

  @stack('head')

</head>
<body>

  @if(session('alert'))
  <div class='alert'>
    {{ session('alert') }}
  </div>
  @endif

  <header>
    <a href='/'><img
      src='/images/laravel-foobooks-logo@2x.png'
      style='width:300px'
      alt='Foobooks Logo'></a>

      {{-- ToDo: Make it so active link in nav is highlighted --}}
      @include('modules.nav')
    </header>

    <section id='main'>
      @yield('content')
    </section>

    <section id='socialMedia'>
      <h3>Simply Practicing Using a <a href="https://packagist.org/packages/siokas/laravelembeddirectives">Package</a></h3>
      @twitter('hseas/status/923252958145466369')
    </section>

    <footer>
      <a href='https://github.com/dukesnuz/foobooks'><i class='fa fa-github'></i></a>&nbsp;
      &copy; {{ date('Y') }}
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    @stack('body')
    <!-- Default Statcounter code for Harvard Extension DWA
    http://http//www.dukesnuz.com -->
    <script type="text/javascript">
    var sc_project=11889370;
    var sc_invisible=1;
    var sc_security="6ab59e53";
    </script>
    <script type="text/javascript"
    src="https://www.statcounter.com/counter/counter.js"
    async></script>
    <noscript><div class="statcounter"><a title="Web Analytics"
      href="http://statcounter.com/" target="_blank"><img
      class="statcounter"
      src="//c.statcounter.com/11889370/0/6ab59e53/1/" alt="Web
      Analytics"></a></div></noscript>
      <!-- End of Statcounter Code -->
    </body>
    </html>
