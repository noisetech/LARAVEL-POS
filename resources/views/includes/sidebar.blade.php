  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
          <div class="sidebar-brand-text mx-3">Toko</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
          <a class="nav-link" href="{{ route('dashboard_admin') }}">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Dashboard</span></a>
      </li>

      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
              aria-controls="collapseTwo">
              <i class="fas fa-fw fa-list"></i>
              <span>Data Toko</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <a class="collapse-item" href="{{ route('halaman.data.produk.admin') }}">Data Produk</a>
                  <a class="collapse-item" href="{{ route('data.pelanggan.admin') }}">Data Pelanggan</a>
              </div>
          </div>
      </li>

      <li class="nav-item">
          <a class="nav-link" href="{{ route('keseluruhan_transaksi') }}">
              <i class="fas fa-fw fa-arrow-right"></i>
              <span>Transaksi</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>Laporan</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('opsi_laporan_perhari') }}">Perhari</a>
                <a class="collapse-item" href="{{ route('opsi_laporan_perbulan') }}">Perbulan</a>
                <a class="collapse-item" href="{{ route('opsi_laporan_pertahun') }}">Perhatun</a>
            </div>
        </div>
    </li>




      <!-- Divider -->
      <hr class="sidebar-divider">



  </ul>
  <!-- End of Sidebar -->
