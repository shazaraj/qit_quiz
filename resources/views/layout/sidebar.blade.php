<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
      QIT<span>QUIZ</span>
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Main</li>
      <li class="nav-item ">
        <a href="{{ url('/dashboard') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item nav-category">user</li>
      <li class="nav-item ">
        <a href="{{ url('/general/users') }}" class="nav-link">
          <i class="link-icon" data-feather="users"></i>
          <span class="link-title">user</span>
        </a>
      </li>
      <li class="nav-item nav-category">quiz</li>
      <li class="nav-item ">
        <a href="{{ url('/general/questions') }}" class="nav-link">
          <i class="link-icon" data-feather="command"></i>
          <span class="link-title">Question</span>
        </a>
      </li>
      <li class="nav-item nav-category">result</li>
      <li class="nav-item ">
        <a href="{{ url('/general/results') }}" class="nav-link">
          <i class="link-icon" data-feather="sliders"></i>
          <span class="link-title">Result</span>
        </a>
      </li>
      <li class="nav-item nav-category">auth</li>
      <li class="nav-item ">
        {{-- <a href="{{ url('/login') }}" class="nav-link"> --}}
          <i class="link-icon" data-feather="lock"></i>
          {{-- <span class="link-title">login</span> --}}
        </a>

      </li>

      <li>

        <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form></li>

    </ul>
  </div>
</nav>
<nav class="settings-sidebar">
  <div class="sidebar-body">
    <a href="#" class="settings-sidebar-toggler">
      <i data-feather="settings"></i>
    </a>
    <h6 class="text-muted mb-2">Sidebar:</h6>
    <div class="mb-3 pb-3 border-bottom">
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight" value="sidebar-light" checked>
          Light
        </label>
      </div>
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark" value="sidebar-dark">
          Dark
        </label>
      </div>
    </div>
    <div class="theme-wrapper">
      <h6 class="text-muted mb-2">Light Version:</h6>
      <a class="theme-item active" href="">
        <img src="{{ url('assets/images/screenshots/light.jpg') }}" alt="light version">
      </a>
      <h6 class="text-muted mb-2">Dark Version:</h6>
      <a class="theme-item" href="">
        <img src="{{ url('assets/images/screenshots/dark.jpg') }}" alt="light version">
      </a>
    </div>
  </div>
</nav>
