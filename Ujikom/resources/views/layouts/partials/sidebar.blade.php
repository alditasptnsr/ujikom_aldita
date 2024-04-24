<aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="/dashboard" >
              <img src="/img/logoe.png" alt="logo" width="40" class="shadow-light rounded-circle">
                HYUNGDRY</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="/dashboard">HY-DRY</a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header">Dashboard</li>
              <li class="nav-item dropdown active">
                <a href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
              </li>
              <li class="menu-header">Data Referensi Layanan</li>
              <li><a class="nav-link" href="/dashboard/paket"><i class="fas fa-boxes-packing"></i> <span>Layanan Paket</span></a></li>
              <li><a class="nav-link" href="/dashboard/tipe_pembayaran"><i class="fas fa-money-bill-wave"></i> <span>Jenis Pembayaran</span></a></li>
              <li><a class="nav-link" href="/dashboard/status_pesanan"><i class="fas fa-boxes-stacked"></i> <span>Layanan Status</span></a></li>
              <li class="menu-header">Data Pengguna</li>
              <li><a class="nav-link" href="/dashboard/konsumen"><i class="fas fa-users"></i> <span>Konsumen</span></a></li>
              <li><a class="nav-link" href="/dashboard/karyawan"><i class="fas fa-user-tie"></i></i> <span>Petugas</span></a></li>
              <li class="menu-header">Transaksi</li>
              <li><a class="nav-link" href="/dashboard/transaksi"><i class="fas fa-money-bill-transfer"></i> <span>Transaksi</span></a></li>
              <li class="menu-header">Laporan</li>
              <li><a class="nav-link" href="/dashboard/laporan_transaksi"><i class="fas fa-file-invoice-dollar"></i> <span>Laporan Transaksi</span></a></li>
              <!-- <li><a class="nav-link" href=""><i class="fas fa-file-invoice-dollar"></i> <span>Laporan Keuangan</span></a></li> -->
            </ul>

            <!-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
              <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
              </a>
            </div> -->
        </aside>
