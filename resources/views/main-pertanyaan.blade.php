<!DOCTYPE html>
<html lang="en">
<head>
  @include('components.header')
  @stack('custom-css')
</head>
<body>
  <div class="wrapper">
    
    {{-- Sidebar --}}
    @include('components.sidebar')

    {{-- Main Panel --}}
    <div class="main-panel">
      
      {{-- Navbar --}}
      @include('components.navbar')

      {{-- Content --}}
      <div class="content">
        <div class="container-fluid">
          @yield('content')
        </div>
      </div>

      {{-- Footer --}}
      <footer class="footer">
        <div class="container-fluid d-flex justify-content-between">
          <nav class="pull-left">
            <ul class="nav">
              <li class="nav-item">
                <a class="nav-link" href="http://www.themekita.com">ThemeKita</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Help</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Licenses</a>
              </li>
            </ul>
          </nav>
          <div class="copyright">
            2024, made with <i class="fa fa-heart heart text-danger"></i> by
            <a href="http://www.themekita.com">ThemeKita</a>
          </div>
          <div>
            Distributed by <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>.
          </div>
        </div>
      </footer>

    </div> {{-- End Main Panel --}}

    {{-- Custom Template Settings --}}
    @include('components.custom-template')

  </div> {{-- End Wrapper --}}

  {{-- Footer Script --}}
  @include('components.footer')
  @stack('custom-js')
</body>
</html>
