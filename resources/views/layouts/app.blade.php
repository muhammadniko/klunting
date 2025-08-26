<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Klunting App</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- AdminLTE CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">

  <!-- Optional Bootstrap (sudah include di AdminLTE) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav ml-auto">
    
    <!-- Status WhatsApp -->
    <li class="nav-item d-flex align-items-center mr-3">
      <span class="mr-2">WhatsApp:</span>
      <span id="baileys-status" class="badge bg-secondary">Menghubungkan...</span>
    </li>

    <!-- Logout -->
    <li class="nav-item">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-danger btn-sm" title="Logout">
          <i class="fas fa-power-off"></i>
        </button>
      </form>
    </li>

  </ul>
</nav>

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('/home') }}" class="brand-link">
      <span class="brand-text font-weight-light">📤 Klunting</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>Home</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('employee.index') }}" class="nav-link {{ request()->is('employee*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>Employee</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('payslip.index') }}" class="nav-link {{ request()->is('payslip*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-comments"></i>
              <p>Broadcast</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper -->
  <div class="content-wrapper pt-3">
    <div class="container-fluid">
      @yield('content')
    </div>
  </div>

  <!-- Footer -->
  <footer class="main-footer text-center">
    <strong>&copy; {{ date('Y') }} Klunting App</strong>
  </footer>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script>
    // 🔹 Cek status Baileys setiap 5 detik
    async function updateBaileysStatus() {
        let res = await fetch("{{ route('baileys.status') }}");
        let data = await res.json();
        let badge = document.getElementById('baileys-status');

        if (data.connected) {
            badge.textContent = "Terhubung (" + (data.user?.name || data.user?.id) + ")";
            badge.className = "badge bg-success";
        } else {
            badge.textContent = "Tidak Terhubung";
            badge.className = "badge bg-danger";
        }
    }
    setInterval(updateBaileysStatus, 5000);
    updateBaileysStatus(); // cek pertama kali
</script>
</body>
</html>