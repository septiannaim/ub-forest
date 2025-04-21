<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home | UB-forest</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('landing-page/assets/img/logo-ub-forest.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('landing-page/assets/img/logo-ub-forest.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('landing-page/assets/img/logo-ub-forest.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
    <link rel="manifest" href="assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="{{ asset('assets/leaflet/leaflet.css') }}" />
    

    <link href="{{ asset('landing-page/assets/css/theme.css') }}" rel="stylesheet" />

  </head>

  <body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 bg-light opacity-85" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container">
          <a class="navbar-brand" href="index.html">
            <img class="d-inline-block align-top img-fluid" src="{{ asset('landing-page/assets/img/logo-ub-forest.png') }}" alt="" width="50" />
            <span class="text-theme font-monospace fs-4 ps-2"></span>
          </a>
          <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item px-2"><a class="nav-link fw-medium active" aria-current="page" href="#home">Home</a></li>
              <li class="nav-item px-2"><a class="nav-link fw-medium" href="#Fitur">Fitur</a></li>
              <li class="nav-item px-2"><a class="nav-link fw-medium" href="#Tentang">Tentang</a></li>
              <li class="nav-item px-2"><a class="nav-link fw-medium" href="#map-location">Lokasi</a></li>
              
            </ul>
            <form class="d-flex">
              <a href="{{ route('login') }}" class="btn btn-lg btn-outline-dark bg-gradient me-2">Sign In</a>
            </form>
          </div>
        </div>
      </nav>
      
      <section class="py-0" id="home">
        <div class="bg-holder d-none d-md-block" style="background-image:url({{ asset('landing-page/assets/img/Hutan.png') }}); background-position:right top; background-size:contain;">
        </div>
        <!--/.bg-holder-->
  
        <div class="bg-holder d-md-none" style="background-image:url({{ asset('landing-page/assets/img/illustrations/hero-bg.png') }}); background-position:right top; background-size:contain;">
        </div>
        <!--/.bg-holder-->
        
        <div class="container">
          <div class="row align-items-center min-vh-75 min-vh-lg-100">
            <div class="col-md-7 col-lg-6 col-xxl-5 py-6 text-sm-start text-center">
              <h1 class="mt-6 mb-sm-4 fw-semi-bold lh-sm fs-4 fs-lg-5 fs-xl-6">Sistem Keamanan   <br class="d-block d-lg-block" />Anti-Perusakan Berbasis IoT</h1>
              <p class="mb-4 fs-1">Menggunakan teknologi Internet of Things (IoT) untuk memberikan pengawasan real-time, deteksi ancaman cerdas, dan perlindungan menyeluruh di UBForest.</p>
              <a class="btn btn-lg btn-success" href="{{ route('login') }}" >Monitoring Sekarang</a>
            </div>
          </div>
        </div>
      </section>
    </main>
  </body>
  
      
  <section class="py-5" id="Fitur">
    <div class="bg-holder d-none d-sm-block" style="background-image:url({{ asset('landing-page/assets/img/illustrations/bg.png') }});background-position:top left;background-size:225px 755px;margin-top:-17.5rem;">
    </div>
    <!--/.bg-holder-->
  
    <div class="container">
      <div class="row">
        <div class="col-lg-9 mx-auto text-center mb-3">
          <h5 class="fw-bold fs-3 fs-lg-5 lh-sm mb-3">Fitur Aplikasi</h5>
          <p class="mb-5">Solusi terintegrasi untuk memantau dan melindungi hutan melalui teknologi IoT canggih.</p>
        </div>
      </div>
      <div class="row flex-center h-100">
        <div class="col-xl-9">
          <div class="row">
            <!-- Kartu Fitur 1 -->
            <div class="col-md-4 mb-5">
              <div class="card h-100 shadow px-4 px-md-2 px-lg-3 card-span pt-6">
                <div class="text-center text-md-start card-hover">
                  <img class="ps-3 icons" src="{{ asset('landing-page/assets/img/icons/farmer.svg') }}" height="60" alt="Pemantauan Real-Time">
                  <div class="card-body">
                    <h6 class="fw-bold fs-1 heading-color">Pemantauan Real-Time 24/7</h6>
                    <p class="mt-3 mb-md-0 mb-lg-2">
                      Sistem IoT kami memberikan pembaruan secara langsung, memungkinkan deteksi dini dan respon cepat terhadap potensi ancaman.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <!-- Kartu Fitur 2 -->
            <div class="col-md-4 mb-5">
              <div class="card h-100 shadow px-4 px-md-2 px-lg-3 card-span pt-6">
                <div class="text-center text-md-start card-hover">
                  <img class="ps-3 icons" src="{{ asset('landing-page/assets/img/icons/growth.svg') }}" height="60" alt="Deteksi Otomatis">
                  <div class="card-body">
                    <h6 class="fw-bold fs-1 heading-color">Deteksi dan Peringatan Otomatis</h6>
                    <p class="mt-3 mb-md-0 mb-lg-2">
                      Teknologi cerdas kami mendeteksi aktivitas abnormal seperti pembakaran liar atau penebangan ilegal, dan langsung mengirimkan notifikasi.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <!-- Kartu Fitur 3 -->
            <div class="col-md-4 mb-5">
              <div class="card h-100 shadow px-4 px-md-2 px-lg-3 card-span pt-6">
                <div class="text-center text-md-start card-hover">
                  <img class="ps-3 icons" src="{{ asset('landing-page/assets/img/icons/planting.svg') }}" height="60" alt="Investasi Dampak Sosial">
                  <div class="card-body">
                    <h6 class="fw-bold fs-1 heading-color">Investasi Dampak Sosial</h6>
                    <p class="mt-3 mb-md-0 mb-lg-2">
                      Dukung pelestarian hutan dengan berinvestasi pada teknologi hijau yang menggabungkan inovasi dan keberlanjutan untuk masa depan yang lebih aman.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <!-- Akhir Kartu Fitur -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <style>
    .embed-responsive {
      position: relative;
      padding-bottom: 56.25%;
      height: 0;
      overflow: hidden;
      max-width: 100%;
      width: 100%;
      margin: 0  auto;  /* Memastikan elemen berada di tengah */
      padding-left: 20px;  /* Memberikan jarak di sisi kiri */
      padding-right: 20px; /* Memberikan jarak di sisi kanan */
    }
  
    .embed-responsive iframe {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }
  
  
  </style>
  
  <section class="py-0"id="Tentang">
      <div class="bg-holder" style="background-image:url({{asset('landing-page/assets/img/illustrations/how-it-works.png')}});background-position:center bottom;background-size:cover;">
      </div>
      <!--/.bg-holder-->
  
      <div class="container-lg pb-5">
          <div class="row justify-content-center align-items-center">
              <!-- Section Title -->
              <div class="col-lg-9 mx-auto text-center mb-3">
                  <div class="col-lg-9 mx-auto text-center mb-3">
                      <h5 class="fw-bold fs-3 fs-lg-5 lh-sm py-4 text-white">Tentang UB Forest</h5> <!-- Title -->
                  </div>
              </div>
  
              <!-- Video on the left -->
              <div class="col-lg-6 col-md-12  ">
                  <div class="embed-responsive embed-responsive-16by9">
                      <iframe class="embed-responsive-item mb-4" src="https://www.youtube.com/embed/-SJMLBDvcH8?si=vPlnVj9RrYiXzZK_" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  </div>
              </div>
  
              <!-- Paragraph on the right -->
              <div class="col-lg-6 col-md-12 mt-1 mt-lg-0">
                  <h5 class="fw-bold fs-4 lh-sm mb-1 text-white">Hutan Pendidikan KHDTK UB Forest</h5>
                  <p class="text-white">Hutan Pendidikan KHDTK UB Forest adalah hutan yang dijadikan untuk keperluan penelitian dan pengembangan multidisiplin di lingkungan UB. Hutan ini didesain untuk proses belajar dan mengajar yang berorientasi ke alam dan masyarakat. Kegiatan pembelajaran merupakan suatu kegiatan yang mengacu kepada prinsip facilitating, empowering and enabling, yang bertujuan membuat mahasiswa menjadi peserta didik yang aktif dan menyatu dengan alam.</p>
              </div>
          </div>
      </div>
  </section>
  
  
      <section class="py-8" id="map-location">
        <div class="container-lg">
            <div class="row flex-center">
                <div class="col-12 col-lg-10 col-xl-12">
        
                    <h6 class="fs-3 fs-lg-4 fw-bold lh-sm text-center mb-4">UB Forest Location</h6>
                </div>
                <div id="map" style="height: 400px;"></div>
            </div>
        </div>
    </section>
    <script src="{{ asset('assets/leaflet/leaflet.js') }}"></script>
    <script>
        // Initialize map
        var map = L.map('map').setView([-7.9368, 112.5611], 15); // Coordinates of UB Forest
    
        // Set up the tile layer (map background)
        L.tileLayer("https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}", {
            attribution: "Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community"
        }).addTo(map);
        
        // Add marker for UB Forest
        L.marker([-7.9368, 112.5611]).addTo(map)
            .bindPopup("<b>UB Forest</b><br>Dusun Sumbersari, Desa Tawang Argo, Karangploso, Kabupaten Malang.")
            .openPopup();
    </script>
    

      <section class="py-0" id="contact">
        <div class="bg-holder" style="background-image:url({{asset('landing-page/assets/img/illustrations/footer-bg.png')}});background-position:center;background-size:cover;">
        </div>
        <!--/.bg-holder-->

        <div class="container">
          
          <hr class="text-300 mb-0" />
          <div class="row flex-center py-5">
            
            <div class="col-12 col-sm-8 col-md-6">
              <p class="fs--1 text-dark my-2 text-center text-md-end">&copy;2025&nbsp;
                <svg class="bi bi-suit-heart-fill" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#76C279" viewBox="0 0 16 16">
                  <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"></path>
                </svg>&nbsp;by&nbsp;<a class="text-dark" href="https://themewagon.com/" target="_blank">UB Forest </a>
              </p>
            </div>
          </div>
        </div>
      </section>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->


    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="{{asset('landing-page/vendors/@popperjs/popper.min.js')}}"></script>
    <script src="{{asset('landing-page/vendors/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{asset('landing-page/vendors/is/is.min.js')}}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{asset('landing-page/assets/js/theme.js')}}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Chivo:wght@300;400;700;900&amp;display=swap" rel="stylesheet">
  </body>

</html>