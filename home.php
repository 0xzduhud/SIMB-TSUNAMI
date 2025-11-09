<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Halaman Utama - Tsunami Edu</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- BOOTSTRAP CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  >

  <style>
    :root {
      --tsu-dark: #020617;
      --tsu-dark-soft: #0b1220;
      --tsu-accent: #38bdf8;
      --tsu-accent-soft: rgba(56, 189, 248, 0.15);
    }

    body {
      background: radial-gradient(circle at top, #1d4ed8 0, #020617 45%);
      color: #e5e7eb;
      min-height: 100vh;
    }

    /* NAVBAR */
    .navbar-tsu {
      background: rgba(15, 23, 42, 0.96);
      backdrop-filter: blur(12px);
      border-bottom: 1px solid rgba(148, 163, 184, 0.35);
    }

    .navbar-brand span {
      letter-spacing: .05em;
      font-size: .9rem;
    }

    .nav-link {
      font-size: 0.9rem;
    }

    .nav-link.active,
    .nav-link:hover {
      color: #e0f2fe !important;
    }

    /* HERO */
    .hero-section {
      padding: 3.5rem 0 3rem;
    }

    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: .4rem;
      padding: .25rem .7rem;
      border-radius: 999px;
      border: 1px solid rgba(56,189,248,.5);
      background: rgba(15,23,42,.7);
      font-size: .8rem;
      color: #bae6fd;
    }

    .hero-title {
      font-weight: 700;
      font-size: clamp(2rem, 3vw, 2.6rem);
    }

    .hero-text {
      color: #9ca3af;
      font-size: .95rem;
      max-width: 480px;
    }

    .hero-card {
      background: radial-gradient(circle at top left, rgba(56,189,248,.2), #020617);
      border-radius: 1.25rem;
      border: 1px solid rgba(148,163,184,.4);
      padding: 1.2rem 1.4rem;
      color: #e5f2ff;
      box-shadow: 0 18px 45px rgba(15,23,42,.9);
    }

    /* SECTION TITLE */
    .section-title {
      font-size: 1.1rem;
      font-weight: 600;
    }

    .section-subtitle {
      font-size: .9rem;
      color: #9ca3af;
    }

    /* CARDS */
    .tsu-card {
      background: radial-gradient(circle at top left, rgba(56,189,248,.16), #020617);
      border-radius: 1.1rem;
      border: 1px solid rgba(148,163,184,.4);
      color: #e5e7eb;
      height: 100%;
      display: flex;
      flex-direction: column;
      padding: 1rem .95rem .9rem;
      box-shadow: 0 10px 28px rgba(15,23,42,.85);
    }

    .tsu-card-icon {
      width: 32px;
      height: 32px;
      border-radius: 999px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 1.1rem;
      background: var(--tsu-accent-soft);
      margin-right: .4rem;
    }

    .tsu-card-title {
      font-size: .95rem;
      font-weight: 600;
    }

    .tsu-tag {
      display: inline-block;
      font-size: .75rem;
      padding: .1rem .6rem;
      border-radius: 999px;
      border: 1px solid rgba(148,163,184,.5);
      color: #e5e7eb;
      background: #020617;
      margin: .2rem 0 .6rem;
    }

    .tsu-summary {
      font-size: .83rem;
      color: #9ca3af;
      margin-bottom: .6rem;
    }

    .btn-read {
      font-size: .8rem;
      border-radius: 999px;
      padding: .3rem .8rem;
      border: none;
      background: var(--tsu-accent-soft);
      color: #e0f2fe;
    }

    .btn-read:hover {
      background: rgba(56,189,248,.4);
      color: #f9fafb;
    }

    .tsu-detail {
      font-size: .8rem;
      color: #d1d5db;
      border-top: 1px dashed rgba(148,163,184,.5);
      padding-top: .5rem;
      margin-top: .4rem;
    }

    .tsu-footnote {
      font-size: .72rem;
      color: #9ca3af;
    }

    /* SECTION BACKGROUND CONTAINER */
    .section-box {
      background: rgba(15,23,42,.9);
      border-radius: 1.4rem;
      border: 1px solid rgba(148,163,184,.5);
      padding: 1.4rem 1.3rem 1.2rem;
      box-shadow: 0 18px 45px rgba(15,23,42,.8);
    }

    footer {
      font-size: .78rem;
      color: #9ca3af;
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-tsu sticky-top">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <span class="me-2 fs-5">🌊</span>
        <span class="fw-semibold text-light">Tsunami&nbsp;Edu</span>
      </a>
      <button class="navbar-toggler text-light border-0" type="button"
              data-bs-toggle="collapse" data-bs-target="#mainNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active text-light" href="#materi">Materi Utama</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-secondary" href="#topik">Topik</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-secondary" href="#info">Info Website</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <section class="hero-section">
    <div class="container">
      <div class="row align-items-center g-4">
        <div class="col-lg-7">
          <div class="hero-badge mb-2">
            <span class="badge-dot">●</span>
            <span>Halaman awal &mdash; ringkasan tsunami</span>
          </div>
          <h1 class="hero-title mb-2">
            Kenali Tsunami, Kurangi Risiko Bencananya.
          </h1>
          <p class="hero-text mb-3">
            Halaman ini merangkum pengertian, penyebab, dampak, dan mitigasi tsunami
            dalam bentuk kartu. Klik <strong>"Baca selengkapnya"</strong> untuk
            melihat penjelasan detail tanpa pindah halaman.
          </p>
          <div class="d-flex flex-wrap gap-2">
            <span class="badge bg-dark border border-secondary text-light">
              Materi singkat & mudah dipahami
            </span>
            <span class="badge bg-dark border border-secondary text-light">
              Cocok untuk tugas / presentasi
            </span>
          </div>
        </div>

        <div class="col-lg-5">
          <div class="hero-card">
            <h6 class="mb-1">📡 Pesan Kesiapsiagaan</h6>
            <p class="mb-2 small">
              Jika kamu merasakan gempa kuat di dekat pantai, <strong>jangan menunggu
              pengumuman</strong>. Segera bergerak ke tempat yang lebih tinggi dan jauh
              dari garis pantai.
            </p>
            <div class="d-flex gap-2 mt-2">
              <div class="flex-grow-1">
                <div class="progress bg-dark" style="height: 6px;">
                  <div class="progress-bar bg-info" style="width: 70%;"></div>
                </div>
                <small class="text-secondary">Tingkat risiko di zona pesisir</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- MATERI UTAMA -->
  <main class="pb-5">
    <div class="container">
      <section id="materi" class="mb-4">
        <div class="section-box">
          <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
            <div>
              <div class="section-title text-light">Materi Utama Tsunami</div>
              <div class="section-subtitle">
                Ringkasan 4 topik: pengertian, penyebab, dampak, dan mitigasi.
              </div>
            </div>
          </div>

          <div id="topik" class="row g-3">
            <!-- PENGERTIAN -->
            <div class="col-md-6 col-xl-3">
              <div class="tsu-card h-100">
                <div class="mb-1">
                  <div class="d-flex align-items-center mb-1">
                    <div class="tsu-card-icon">📘</div>
                    <div class="tsu-card-title">Pengertian Tsunami</div>
                  </div>
                  <span class="tsu-tag">Dasar teori</span>
                  <p class="tsu-summary">
                    Apa yang dimaksud tsunami, dan kapan gelombang laut biasa
                    berubah menjadi bencana besar.
                  </p>
                </div>
                <div class="mt-auto">
                  <button
                    class="btn btn-read btn-sm mb-1"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#detailPengertian"
                    aria-expanded="false"
                    aria-controls="detailPengertian">
                    Baca selengkapnya
                  </button>
                  <div class="tsu-footnote">± 2 paragraf penjelasan</div>

                  <div class="collapse tsu-detail mt-2" id="detailPengertian">
                    <p class="mb-1">
                      Tsunami adalah serangkaian gelombang laut besar yang terbentuk
                      akibat perpindahan massa air secara tiba-tiba dalam skala luas,
                      biasanya dipicu oleh <strong>gempa bumi tektonik bawah laut</strong>,
                      letusan gunung api bawah laut, atau longsor dasar laut.
                    </p>
                    <p class="mb-0">
                      Di laut lepas, tinggi gelombang mungkin tampak kecil, namun kecepatannya
                      sangat tinggi. Saat mendekati pantai, gelombang melambat dan menumpuk
                      sehingga tingginya meningkat drastis dan berpotensi menimbulkan kerusakan
                      besar di daratan.
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <!-- PENYEBAB -->
            <div class="col-md-6 col-xl-3">
              <div class="tsu-card h-100">
                <div class="mb-1">
                  <div class="d-flex align-items-center mb-1">
                    <div class="tsu-card-icon">🌍</div>
                    <div class="tsu-card-title">Penyebab Tsunami</div>
                  </div>
                  <span class="tsu-tag">Proses geologi</span>
                  <p class="tsu-summary">
                    Tidak semua gempa memicu tsunami. Ada kondisi tertentu yang
                    membuat dasar laut terangkat atau turun dengan cepat.
                  </p>
                </div>
                <div class="mt-auto">
                  <button
                    class="btn btn-read btn-sm mb-1"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#detailPenyebab"
                    aria-expanded="false"
                    aria-controls="detailPenyebab">
                    Baca selengkapnya
                  </button>
                  <div class="tsu-footnote">Poin penyebab utama</div>

                  <div class="collapse tsu-detail mt-2" id="detailPenyebab">
                    <p class="mb-1">
                      Penyebab utama tsunami adalah <strong>gempa tektonik bawah laut</strong>
                      dengan magnitudo besar dan pergerakan vertikal dasar laut. Pergeseran ini
                      mengangkat atau menurunkan kolom air di atasnya secara mendadak.
                    </p>
                    <p class="mb-0">
                      Selain gempa, tsunami dapat disebabkan letusan gunung api bawah laut,
                      longsor bawah laut, hingga jatuhnya benda langit ke laut (sangat jarang).
                      Intinya, setiap peristiwa yang memindahkan massa air laut secara cepat dan
                      luas berpotensi memicu tsunami.
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <!-- DAMPAK -->
            <div class="col-md-6 col-xl-3">
              <div class="tsu-card h-100">
                <div class="mb-1">
                  <div class="d-flex align-items-center mb-1">
                    <div class="tsu-card-icon">⚠️</div>
                    <div class="tsu-card-title">Dampak Tsunami</div>
                  </div>
                  <span class="tsu-tag">Kerusakan & risiko</span>
                  <p class="tsu-summary">
                    Bukan hanya kerusakan fisik, tetapi juga dampak sosial,
                    ekonomi, hingga kesehatan jangka panjang.
                  </p>
                </div>
                <div class="mt-auto">
                  <button
                    class="btn btn-read btn-sm mb-1"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#detailDampak"
                    aria-expanded="false"
                    aria-controls="detailDampak">
                    Baca selengkapnya
                  </button>
                  <div class="tsu-footnote">Dampak jangka pendek & panjang</div>

                  <div class="collapse tsu-detail mt-2" id="detailDampak">
                    <p class="mb-1">
                      Dampak langsung meliputi kerusakan berat pada permukiman, jalan,
                      jembatan, pelabuhan, serta fasilitas penting seperti rumah sakit
                      dan sekolah. Arus air yang kuat dapat menyeret manusia, kendaraan,
                      dan puing bangunan.
                    </p>
                    <p class="mb-0">
                      Dalam jangka panjang, muncul masalah kehilangan tempat tinggal,
                      terputusnya mata pencaharian, trauma psikologis, serta pencemaran
                      sumber air bersih yang menimbulkan risiko penyakit.
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <!-- MITIGASI -->
            <div class="col-md-6 col-xl-3">
              <div class="tsu-card h-100">
                <div class="mb-1">
                  <div class="d-flex align-items-center mb-1">
                    <div class="tsu-card-icon">🛟</div>
                    <div class="tsu-card-title">Mitigasi & Kesiapsiagaan</div>
                  </div>
                  <span class="tsu-tag">Langkah praktis</span>
                  <p class="tsu-summary">
                    Tindakan sederhana sebelum, saat, dan setelah tsunami
                    yang bisa menyelamatkan banyak nyawa.
                  </p>
                </div>
                <div class="mt-auto">
                  <button
                    class="btn btn-read btn-sm mb-1"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#detailMitigasi"
                    aria-expanded="false"
                    aria-controls="detailMitigasi">
                    Baca selengkapnya
                  </button>
                  <div class="tsu-footnote">Checklist singkat</div>

                  <div class="collapse tsu-detail mt-2" id="detailMitigasi">
                    <p class="mb-1">
                      Sebelum tsunami, warga pesisir perlu memahami rambu dan jalur evakuasi,
                      mengikuti simulasi bencana, serta mengetahui titik kumpul yang aman
                      di tempat yang lebih tinggi.
                    </p>
                    <p class="mb-0">
                      Saat tsunami, segera menjauh dari pantai setelah merasakan gempa kuat
                      atau melihat air laut surut tidak wajar. Setelahnya, jangan kembali ke
                      wilayah pantai sampai pihak berwenang menyatakan kondisi aman karena
                      gelombang susulan bisa muncul.
                    </p>
                  </div>
                </div>
              </div>
            </div>

          </div> <!-- row -->
        </div>
      </section>

      <!-- INFO WEBSITE -->
      <section id="info" class="text-start">
        <h6 class="text-light mb-1">Info Singkat Website</h6>
        <p class="section-subtitle mb-0">
          Halaman ini adalah <strong>halaman awal</strong> yang berisi ringkasan materi.
          Nanti kamu bisa menambahkan halaman lanjutan (detail tiap topik) atau
          mengembangkan konten sesuai kebutuhan tugas dan laporan.
        </p>
      </section>
    </div>
  </main>

  <footer class="py-3 text-center">
    &copy; 2025 Tsunami Edu &mdash; Halaman Utama. Dibuat untuk keperluan edukasi dan pembelajaran.
  </footer>

  <!-- BOOTSTRAP JS (wajib untuk collapse) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
