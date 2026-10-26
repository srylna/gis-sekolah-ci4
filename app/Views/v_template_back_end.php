<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <a href="<?= base_url('Admin') ?>/dist/css/adminlte.css" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>GIS Sekolah | <?= $title ?> </title>
    
    <!-- CDN CSS Bootstrap 5 (Wajib Ada) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  
    <!-- CSS AdminLTE 4 (Gunakan <link> bukan <a>) -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/dist/css/adminlte.css" />

    <!-- CDN Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
  /* Mengubah warna menu yang sedang aktif dari abu-abu menjadi biru */
  .sidebar-menu .nav-link.active {
    background-color: #0d6efd !important; /* Warna Biru Bootstrap / Primary */
    color: #ffffff !important;            /* Warna teks & ikon jadi putih */
  }

  /* Mengubah warna saat mouse diarahkan (hover) menjadi biru agak gelap */
  .sidebar-menu .nav-link:hover {
    background-color: #0b5ed7 !important;
    color: #ffffff !important;
  }
    </style>

    <!--begin::Theme Init (prevents flash of incorrect theme on load, #6043)-->
    <script>
      (() => {
        'use strict';
        const root = document.documentElement;

        // Applications with their own theming opt out of AdminLTE's color mode
        // entirely, here as well as in the bundle.
        if (root.getAttribute('data-lte-color-mode') === 'off') {
          return;
        }

        const STORAGE_KEY = 'lte-theme';
        let stored = null;
        try {
          stored = localStorage.getItem(STORAGE_KEY);
        } catch {
          // localStorage may be unavailable (private mode, sandboxed iframe).
        }
        // Mirror the precedence in color-mode.ts: the visitor's stored choice
        // wins, then a theme this page declared itself, then the OS preference.
        const authored = root.getAttribute('data-bs-theme');
        let resolved = 'light';
        if (stored === 'dark' || stored === 'light') {
          resolved = stored;
        } else if (authored === 'dark' || authored === 'light') {
          resolved = authored;
        } else if (globalThis.matchMedia('(prefers-color-scheme: dark)').matches) {
          resolved = 'dark';
        }
        root.setAttribute('data-bs-theme', resolved);
        root.style.colorScheme = resolved;
        // Flag values computed here, so the bundle does not mistake them for a
        // theme the page declared and stop following the OS preference.
        if (resolved !== authored) {
          root.setAttribute('data-lte-theme-resolved', '');
        }
      })();
    </script>
    <!--end::Theme Init-->

    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->

    <!--begin::Primary Meta Tags-->
    <meta name="title" content="AdminLTE 4 | Top Nav Layout" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a free Bootstrap 5 admin dashboard template with almost 50 example pages, built with vanilla JS and designed with accessibility in mind."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel"
    />
    <!--end::Primary Meta Tags-->

    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/dist/css/adminlte.css" />
    <!--end::Accessibility Features-->

    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
      media="print"
      onload="this.media = 'all'"
    />
    <!--end::Fonts-->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->

    <!-- Panggil jQuery di HEAD agar siap dipakai kapan saja -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- JSColor Picker (Pengganti Colorpicker AdminLTE 3) -->
<script src="https://cdnjs.cloudflare.net/ajax/libs/jscolor/2.5.2/jscolor.min.js"></script>

<!-- Pickr CSS (Bootstrap 5 Compatible Colorpicker) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css"/>

     <!-- DataTables CSS Bootstrap 5 -->
   <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <!-- Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="<?= base_url('AdminLTE') ?>/dist/css/bootstrap-icons.min.css" crossorigin="anonymous">

    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/dist/css/adminlte.css" />
    
    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!--end::Required Plugin(AdminLTE)-->
  </head>
  <!--end::Head-->
  <!--
    Top-nav layout: there is NO <aside class="app-sidebar"> on this page, so the
    app-wrapper grid's sidebar column (grid-template-columns: auto 1fr) collapses
    to zero width on its own — header, main, and footer span the full viewport.
    The primary navigation lives in the app-header as a plain Bootstrap
    navbar-expand-lg (Collapse + toggler on mobile). No PushMenu, and therefore
    no sidebar-expand-* class on <body>.
  -->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand-lg bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Brand-->
          <a href="<?= base_url('Admin') ?>" class="navbar-brand d-flex align-items-center">
            <img
              src="<?= base_url('AdminLTE/dist/assets/img/AdminLTELogo.png') ?>"
              alt="AdminLTE Logo"
              width="30"
              height="30"
              class="opacity-75 shadow me-2"
            />
            <span class="fw-light">GIS Sekolah Paguyangan</span>
          </a>
          <!--end::Brand-->
          <!--begin::Toggler (plain Bootstrap collapse, not PushMenu)-->
          <!-- Tombol Garis 3 (PushMenu) -->
          <ul class="navbar-nav">
          <li class="nav-item">
           <a class="nav-link d-flex align-items-center h-100" data-lte-toggle="sidebar" href="#" role="button">
           <i class="bi bi-list fs-5 fw-bold"></i>
         </a>
         </li>
         </ul>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#topNavMenu"
            aria-controls="topNavMenu"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <!--end::Toggler-->
          <!--begin::Collapsible Menu-->
          <div class="collapse navbar-collapse" id="topNavMenu">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../starter.html">Starter</a>
              </li>
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  >Pages</a
                >
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item" href="../pages/profile.html">Profile</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="../pages/invoice.html">Invoice</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="../pages/calendar.html">Calendar</a>
                  </li>
                  <li><hr class="dropdown-divider" /></li>
                  <li>
                    <a class="dropdown-item" href="../pages/faq.html">FAQ</a>
                  </li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  >Forms</a
                >
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item" href="../forms/elements.html">Elements</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="../forms/advanced.html">Advanced Elements</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="../forms/editors.html">Editors</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="../forms/validation.html">Validation</a>
                  </li>
                </ul>
              </li>
            </ul>
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('AdminLTE') ?>/docs/introduction.html">
                  <i class="bi bi-box-arrow-in-right"></i>
                  Log out
                </a>
              </li>
            </ul>
          </div>
          <!--end::Collapsible Menu-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->
      <!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <a href="<?= base_url('Admin') ?>" class="brand-link">
      <img
        src="<?= base_url('AdminLTE/dist/assets/img/AdminLTELogo.png') ?>"
        alt="AdminLTE Logo"
        class="brand-image opacity-75 shadow"
      />
      <span class="brand-text fw-light">GIS Sekolah</span>
    </a>
  </div>
  <!--end::Sidebar Brand-->

  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper">
    <nav class="mt-2" aria-label="Main navigation">
      <ul
        class="nav sidebar-menu flex-column"
        data-lte-toggle="treeview"
        data-accordion="false"
        id="navigation"
      >
        <li class="nav-item">
          <a href="<?= base_url('Admin') ?>" class="nav-link <? $menu == 'dashboard' ? '' : '' ?>">
            <i class="nav-icon bi bi-speedometer"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url('Wilayah') ?>" class="nav-link <? $menu == 'wilayah' ? '' : '' ?>">
           <i class="nav-icon bi bi-layers"></i>
            <p>Wilayah</p>
          </a>
        </li>

         <li class="nav-item">
          <a href="<?= base_url('Jenjang') ?>" class="nav-link <? $menu == 'jenjang' ? '' : '' ?>">
           <i class="nav-icon bi bi-bar-chart-steps"></i>
            <p>Jenjang</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url('Sekolah') ?>" class="nav-link <? $menu == 'sekolah' ? '' : '' ?>">
           <i class="nav-icon bi bi-bank"></i>
            <p>Sekolah</p>
          </a>
        </li>

         <li class="nav-item">
          <a href="<?= base_url('User') ?>" class="nav-link <? $menu == 'user' ? '' : '' ?>">
           <i class="nav-icon bi bi-person"></i>
            <p>User</p>
          </a>
        </li>

        <li class="nav-item">
            <a href="<?= base_url('Admin/Setting') ?>" class="nav-link">
                <i class="nav-icon bi bi-gear-fill"></i>
                <p>
                    Setting
                  </p>
               </a>
             </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon bi bi-grid-fill"></i>
                <p>
                    Simple Link
                    <span class="nav-badge badge text-bg-danger ms-auto">New</span>
                  </p>
               </a>
             </li>
         </ul>
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h1 class="mb-0 fs-3"> <?= $title ?> </h1>
              </div>
              <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Layout</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Top Nav</li>
                  </ol>
                </nav>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <div class="row g-4">
              <div class="col-12">
                  <!-- /.isi konten -->
                  <?php 
                  if ($page) {
                    echo view($page);
                  }
                  ?>
                  <!-- /end isi konten -->
                </div>
              </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      
    </div>
    <!--end::App Wrapper-->
      
      <!-- bootsrap 5 -->
      <script src="<?= base_url('AdminLTE') ?>/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
      
      <!-- CDN JS Bootstrap 5 Bundle (Wajib untuk Pop-up Modal) -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

      <!-- bootsrap color picker -->
      <script src="https://cdnjs.cloudflare.net/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>
     
      <!-- Pickr JS -->
      <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
     
      <!-- Script Pendukung & DataTables -->
    <script src="<?= base_url('AdminLTE') ?>/dist/js/jquery.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/dist/js/popper.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('AdminLTE') ?>/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('AdminLTE') ?>/dist/js/adminlte.js"></script>
      <!-- DataTables JS Integrasi Bootstrap 5 -->
    <script src="<?= base_url('AdminLTE') ?>/dist/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/dist/js/dataTables.bootstrap5.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/dist/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/dist/js/responsive.bootstrap5.min.js"></script>
</body>
  <!--end::Body-->
</html>
