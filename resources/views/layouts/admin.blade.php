<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - SIMAK</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- DataTables + Buttons (Excel/PDF export) -->
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root{
            --primary:#0f766e;
            --primary-dark:#0b5a54;
            --sidebar-bg:#0c4a42;
            --sidebar-bg-active:#0f6459;
            --bg-soft:#f3faf8;
            --ink:#0f2e2b;
            --ink-soft:#5c7a76;
            --mint-soft:#d9efec;
        }
        *{font-family:'Poppins',sans-serif;}
        body{background:var(--bg-soft); color:var(--ink); margin:0;}

        /* ============ Sidebar ============ */
        .sidebar{
            width:260px; min-height:100vh; background:var(--sidebar-bg);
            position:fixed; top:0; left:0; z-index:1030;
            display:flex; flex-direction:column;
            transition:transform .25s ease;
        }
        .sidebar-brand{
            display:flex; align-items:center; gap:.6rem;
            padding:1.4rem 1.5rem; color:#fff; font-weight:800; font-size:1.25rem;
        }
        .sidebar-brand i{color:#5eead4;}
        .sidebar-menu-label{
            color:#7fc4bb; font-size:.72rem; font-weight:600; letter-spacing:.08em;
            padding:0 1.5rem; margin:.5rem 0 .6rem;
        }
        .sidebar .nav-link{
            color:#cfece7; padding:.7rem 1.5rem; font-weight:500; font-size:.92rem;
            display:flex; align-items:center; gap:.7rem; border-radius:0;
        }
        .sidebar .nav-link i{font-size:1.05rem;}
        .sidebar .nav-link:hover{background:rgba(255,255,255,.06); color:#fff;}
        .sidebar .nav-link.active{background:var(--sidebar-bg-active); color:#fff; border-left:3px solid #5eead4;}
        .sidebar .nav-link .badge-count{
            margin-left:auto; background:#ef4444; color:#fff; font-size:.68rem;
            border-radius:999px; padding:.15em .55em;
        }
        .sidebar-footer{margin-top:auto; padding:1.2rem 1.5rem; color:#6fa79e; font-size:.72rem;}

        /* ============ Main / Topbar ============ */
        .main-wrapper{margin-left:260px; min-height:100vh; display:flex; flex-direction:column;}
        .topbar{
            background:#fff; padding:.9rem 1.75rem; display:flex; align-items:center;
            justify-content:space-between; border-bottom:1px solid var(--mint-soft);
            position:sticky; top:0; z-index:1020;
        }
        .topbar .search-box{
            background:var(--bg-soft); border-radius:999px; padding:.5rem 1rem;
            display:flex; align-items:center; gap:.5rem; width:260px; color:var(--ink-soft);
        }
        .topbar .search-box input{border:0; background:transparent; outline:none; width:100%; font-size:.88rem;}
        .topbar-icon-btn{
            width:38px; height:38px; border-radius:50%; display:flex; align-items:center;
            justify-content:center; color:var(--ink-soft); background:var(--bg-soft);
        }
        .avatar-circle{
            width:38px; height:38px; border-radius:50%; background:var(--primary);
            color:#fff; display:flex; align-items:center; justify-content:center; font-weight:700;
        }

        .breadcrumb-bar{padding:1.5rem 1.75rem 0;}
        .breadcrumb-bar h5{font-weight:700; letter-spacing:.03em; color:var(--ink);}
        .breadcrumb-bar .crumb{color:var(--ink-soft); font-size:.85rem;}
        .breadcrumb-bar .crumb .active{color:var(--primary); font-weight:600;}

        .content-area{padding:1.25rem 1.75rem 2.5rem; flex:1;}

        /* ============ Stat Cards ============ */
        .stat-card{
            background:#fff; border-radius:16px; padding:1.25rem 1.4rem;
            display:flex; align-items:center; gap:1rem; border:1px solid var(--mint-soft);
            box-shadow:0 2px 8px rgba(15,118,110,.05);
        }
        .stat-icon{
            width:52px; height:52px; border-radius:14px; display:flex; align-items:center;
            justify-content:center; font-size:1.4rem; flex-shrink:0;
        }
        .stat-card h3{font-weight:800; margin:0; font-size:1.6rem; color:var(--ink);}
        .stat-card span{color:var(--ink-soft); font-size:.85rem; font-weight:500;}

        /* ============ Data Card / Table ============ */
        .data-card{
            background:#fff; border-radius:16px; border:1px solid var(--mint-soft);
            padding:1.75rem; box-shadow:0 2px 8px rgba(15,118,110,.05);
        }
        .btn-primary-simak{
            background:var(--primary); border-color:var(--primary); color:#fff; font-weight:600;
        }
        .btn-primary-simak:hover{background:var(--primary-dark); border-color:var(--primary-dark); color:#fff;}
        .dt-buttons .btn{
            background:#64748b; border-color:#64748b; color:#fff; font-weight:600; font-size:.82rem;
        }
        .dt-buttons .btn:hover{background:#475569; border-color:#475569;}
        table.dataTable thead th{
            color:var(--ink-soft); font-weight:700; font-size:.8rem; text-transform:none;
            border-bottom:1px solid var(--mint-soft) !important;
        }
        table.dataTable tbody td{vertical-align:middle; font-size:.9rem; color:var(--ink);}
        table.dataTable tbody tr:hover{background:var(--bg-soft);}
        .badge-baik{background:#dcfce7; color:#15803d; font-weight:600; padding:.4em .8em; border-radius:999px;}
        .badge-perbaikan{background:#fef9c3; color:#a16207; font-weight:600; padding:.4em .8em; border-radius:999px;}
        .badge-rusak{background:#fee2e2; color:#dc2626; font-weight:600; padding:.4em .8em; border-radius:999px;}
        .badge-belum{background:#e0e7ff; color:#4338ca; font-weight:600; padding:.4em .8em; border-radius:999px;}
        .btn-edit{background:#22c55e; border-color:#22c55e; color:#fff; font-size:.8rem; font-weight:600;}
        .btn-delete{background:#ef4444; border-color:#ef4444; color:#fff; font-size:.8rem; font-weight:600;}
        .btn-view{background:#0ea5e9; border-color:#0ea5e9; color:#fff; font-size:.8rem; font-weight:600;}

        footer.app-footer{
            text-align:center; padding:1.2rem; color:var(--ink-soft); font-size:.82rem;
            border-top:1px solid var(--mint-soft); background:#fff;
        }

        @media (max-width: 991px){
            .sidebar{transform:translateX(-100%);}
            .sidebar.show{transform:translateX(0);}
            .main-wrapper{margin-left:0;}
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- ============ SIDEBAR ============ -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <i class="bi bi-bag-fill"></i>
            <span>SIMAK</span>
        </div>

        <div class="sidebar-menu-label">MENU</div>
        <nav class="nav flex-column">
            <a href="{{ url('/admin/dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-door-fill"></i> Dashboard
            </a>
            <a href="{{ route('admin.alat.index') }}" class="nav-link {{ request()->is('admin/alat*') ? 'active' : '' }}">
                <i class="bi bi-box-seam-fill"></i> Data Alat
            </a>
            
                @if(isset($pesanBelumDibaca) && $pesanBelumDibaca > 0)
                    <span class="badge-count">{{ $pesanBelumDibaca }}</span>
                @endif
            </a>
        </nav>

        <div class="sidebar-footer">2026 &copy; SIMAK &mdash; Fasilitas Kantor</div>
    </aside>

    <div class="main-wrapper">

        <!-- ============ TOPBAR ============ -->
        <div class="topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-sm topbar-icon-btn" id="sidebarToggle" type="button">
                    <i class="bi bi-list fs-5"></i>
                </button>
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Cari data...">
                </div>
            </div>

            <div class="d-flex align-items-center gap-3">
                <button class="topbar-icon-btn border-0" type="button" title="Layar Penuh" onclick="document.documentElement.requestFullscreen()">
                    <i class="bi bi-arrows-fullscreen"></i>
                </button>

                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center gap-2 text-decoration-none" data-bs-toggle="dropdown">
                        <div class="avatar-circle">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</div>
                        <span class="text-dark fw-semibold small d-none d-md-inline">
                            {{ auth()->user()->name ?? 'Admin' }} <i class="bi bi-chevron-down small"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>

                <button class="topbar-icon-btn border-0" type="button" title="Pengaturan">
                    <i class="bi bi-gear"></i>
                </button>
            </div>
        </div>

        <!-- ============ BREADCRUMB ============ -->
        <div class="breadcrumb-bar d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h5 class="mb-0">@yield('page-heading', 'DASHBOARD')</h5>
            <div class="crumb">Home <i class="bi bi-chevron-right small"></i> <span class="active">@yield('page-title', 'Dashboard')</span></div>
        </div>

        <!-- ============ CONTENT ============ -->
        <div class="content-area">
            @if(session('success'))
                <div class="alert alert-success rounded-3 mb-4">{{ session('success') }}</div>
            @endif

            @yield('content')
        </div>

        <footer class="app-footer">2026 &copy; SIMAK - Fasilitas Kantor.</footer>
    </div>

    <!-- ============ SCRIPTS ============ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.2.9/build/pdfmake.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.2.9/build/vfs_fonts.js"></script>

    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('show');
        });
    </script>

    @stack('scripts')
</body>
</html>