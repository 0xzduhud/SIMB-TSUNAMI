<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edukasi Tsunami - Tsunami Edu</title>
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
      margin: 0;
      background: radial-gradient(circle at top, #1d4ed8 0, #020617 45%);
      color: #e5e7eb;
      min-height: 100vh;
      position: relative;
    }

    /* Tekstur gambar ombak tipis di belakang supaya nyatu, tidak nabrak */
    body::before {
      content: "";
      position: fixed;
      inset: 0;
      background: url("tsunami-wave.jpg") center/cover no-repeat;
      opacity: 0.18;              /* kecilin supaya cuma jadi tekstur */
      mix-blend-mode: screen;     /* nyatu sama biru, bukan abu-abu */
      pointer-events: none;
      z-index: -1;
    }

    /* NAVBAR (sama kayak home) */
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

    /* HERO MINI */
    .hero-mini {
      padding: 3.5rem 0 2.5rem;
      text-align: center;
    }

    .hero-mini-title {
      font-weight: 700;
      font-size: clamp(2rem, 3vw, 2.4rem);
    }

    .hero-mini-text {
      max-width: 640px;
      margin: 0.75rem auto 0;
      font-size: .95rem;
      color: #cbd5e1;
    }

    /* SIDEBAR DAFTAR ISI – gaya mirip section-box */
    .edu-sidebar {
      background: rgba(15,23,42,.95);
      border-radius: 1.2rem;
      border: 1px solid rgba(148,163,184,.5);
      padding: 1.3rem 1.1rem;
      box-shadow: 0 18px 45px rgba(15,23,42,.85);
      position: sticky;
      top: 96px;
    }

    .edu-sidebar-title {
      font-size: .95rem;
      font-weight: 600;
      margin-bottom: .8rem;
      display: flex;
      align-items: center;
      gap: .4rem;
    }

    .edu-sidebar-title span.icon {
      width: 22px;
      height: 22px;
      border-radius: 999px;
      background: var(--tsu-accent-soft);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: .9rem;
    }

    .edu-nav-link {
      display: block;
      font-size: .86rem;
      color: #e5e7eb;
      text-decoration: none;
      padding: .45rem .6rem;
      border-radius: .6rem;
      margin-bottom: .25rem;
      transition: background .15s ease, transform .15s ease;
    }

    .edu-nav-link:hover {
      background: rgba(15,23,42,1);
      transform: translateX(2px);
    }

    .edu-nav-link.active {
      background: var(--tsu-accent);
      color: #0b1120;
      font-weight: 600;
    }

    /* WRAPPER SECTION KONTEN */
    .edu-wrapper {
      padding-bottom: 3.5rem;
    }

    .edu-section {
      background: rgba(15,23,42,.95);
      border-radius: 1.3rem;
      border: 1px solid rgba(148,163,184,.5);
      padding: 1.7rem 1.6rem;
      margin-bottom: 1.4rem;
      box-shadow: 0 18px 45px rgba(15,23,42,.85);
    }

    .edu-section h2 {
      font-size: 1.2rem;
      font-weight: 600;
      color: #f9fafb;
      border-left: 4px solid var(--tsu-accent);
      padding-left: .6rem;
      margin-bottom: .35rem;
    }

    .edu-section small {
      font-size: .8rem;
      color: #9ca3af;
    }

    .edu-section p,
    .edu-section ul {
      font-size: .9rem;
      color: #e5e7eb;
      margin-top: .7rem;
    }

    .edu-section ul li + li {
      margin-top: .2rem;
    }

    @media (max-width: 991.98px) {
      .edu-sidebar {
        position: static;
        margin-bottom: 1.5rem;
      }
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
      <a class="navbar-brand d-flex align-items-center" href="home.php">
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
            <a class="nav-link text-secondary" href="home.php">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-light" href="edukasi.html">Edukasi</a>
          </li>
          <!-- kalau nanti ada halaman lain, tambahin di sini -->
        </ul>
      </div>
    </div>
  </nav>

  <!-- HERO MINI -->
  <section class="hero-mini">
    <div class="container">
      <h1 class="hero-mini-title">Edukasi Tsunami</h1>
      <p class="hero-mini-text">
        Penjelasan lebih lengkap tentang pengertian, penyebab, dampak, dan langkah
        mitigasi tsunami. Halaman ini melanjutkan ringkasan materi yang ada di beranda.
      </p>
    </div>
  </section>

  <!-- KONTEN UTAMA + SIDEBAR -->
  <main class="edu-wrapper">
    <div class="container">
      <div class="row">
        <!-- SIDEBAR KIRI -->
        <div class="col-lg-3 mb-4">
          <aside class="edu-sidebar">
            <div class="edu-sidebar-title">
              <span class="icon">📚</span>
              <span>Navigasi Edukasi</span>
            </div>
            <a href="#pengertian" class="edu-nav-link active">1. Pengertian Tsunami</a>
            <a href="#penyebab" class="edu-nav-link">2. Penyebab Tsunami</a>
            <a href="#dampak" class="edu-nav-link">3. Dampak Tsunami</a>
            <a href="#mitigasi" class="edu-nav-link">4. Mitigasi & Kesiapsiagaan</a>
          </aside>
        </div>

        <!-- KONTEN KANAN -->
        <div class="col-lg-9">
          <!-- Pengertian -->
          <section id="pengertian" class="edu-section">
            <h2>Pengertian Tsunami</h2>
            <small>Dasar teori</small>
            <p>
              Tsunami adalah serangkaian gelombang laut besar yang terjadi akibat perpindahan massa air
              secara tiba-tiba dalam skala luas. Peristiwa ini umumnya dipicu oleh
              <strong>gempa bumi tektonik bawah laut</strong>, letusan gunung api bawah laut,
              atau longsor yang mengganggu keseimbangan dasar laut.
            </p>
            <p>
              Di laut lepas, gelombang tsunami dapat merambat dengan kecepatan sangat tinggi namun tinggi
              gelombangnya relatif kecil sehingga sulit disadari. Saat mendekati pantai, kedalaman laut
              berkurang, kecepatan gelombang menurun, dan energi menumpuk sehingga tinggi gelombang
              meningkat drastis dan berpotensi menimbulkan kerusakan besar di wilayah pesisir.
            </p>
          </section>

          <!-- Penyebab -->
          <section id="penyebab" class="edu-section">
            <h2>Penyebab Tsunami</h2>
            <small>Proses geologi utama</small>
            <p>
              Tidak semua gempa di laut menyebabkan tsunami. Hanya gempa dengan kekuatan besar dan
              pergerakan vertikal dasar laut yang mampu mengangkat atau menurunkan kolom air laut
              secara tiba-tiba. Selain gempa, beberapa proses berikut juga dapat memicu tsunami:
            </p>
            <ul>
              <li><strong>Gempa bumi tektonik bawah laut</strong> &mdash; penyebab paling umum tsunami,
                  terutama pada zona subduksi antar lempeng.</li>
              <li><strong>Letusan gunung api bawah laut</strong> yang menggeser massa air dalam volume besar
                  secara cepat.</li>
              <li><strong>Longsor bawah laut</strong> yang memindahkan sedimen dan air laut secara mendadak,
                  biasanya terjadi di lereng curam dasar laut.</li>
              <li><strong>Jatuhnya benda langit ke laut</strong> (sangat jarang), namun dapat menimbulkan
                  tsunami lokal dengan energi besar di sekitar lokasi tumbukan.</li>
            </ul>
          </section>

          <!-- Dampak -->
          <section id="dampak" class="edu-section">
            <h2>Dampak Tsunami</h2>
            <small>Dampak fisik, sosial, dan lingkungan</small>
            <p>
              Tsunami dapat menimbulkan kerusakan yang sangat luas. Arus air yang kuat membawa puing
              bangunan, kendaraan, dan benda berat lainnya sehingga berbahaya bagi manusia dan hewan.
            </p>
            <ul>
              <li>Kerusakan berat pada infrastruktur seperti rumah, jalan, jembatan, pelabuhan,
                  dan fasilitas umum lainnya.</li>
              <li>Korban jiwa dan luka-luka akibat terjangan gelombang dan puing yang terbawa arus.</li>
              <li>Gangguan sosial dan ekonomi, misalnya hilangnya mata pencaharian nelayan dan pelaku usaha
                  di wilayah pesisir.</li>
              <li>Pencemaran sumber air bersih dan masalah sanitasi yang dapat memicu penyakit menular.</li>
              <li>Dampak psikologis jangka panjang seperti trauma, stres, dan kehilangan anggota keluarga.</li>
            </ul>
          </section>

          <!-- Mitigasi -->
          <section id="mitigasi" class="edu-section">
            <h2>Mitigasi & Kesiapsiagaan</h2>
            <small>Langkah sebelum, saat, dan sesudah tsunami</small>
            <p>
              Mitigasi bertujuan mengurangi risiko dan dampak tsunami melalui persiapan yang matang.
              Upaya ini melibatkan pemerintah, sekolah, dan masyarakat umum.
            </p>
            <ul>
              <li><strong>Sebelum tsunami:</strong> memahami peta rawan dan jalur evakuasi, mengikuti
                  simulasi bencana, menyiapkan tas siaga berisi kebutuhan darurat, serta memperhatikan
                  informasi resmi dari BMKG/BNPB.</li>
              <li><strong>Saat tsunami:</strong> segera menjauh ke tempat yang lebih tinggi setelah
                  merasakan gempa kuat atau melihat tanda-tanda seperti air laut surut tidak wajar,
                  tanpa menunggu pengumuman.</li>
              <li><strong>Setelah tsunami:</strong> menjauhi area yang masih tergenang, menghindari
                  kabel listrik dan puing tajam, membantu korban lain jika memungkinkan, serta mengikuti
                  arahan petugas dan informasi resmi mengenai kondisi terkini.</li>
            </ul>
          </section>
        </div>
      </div>
    </div>
  </main>

  <footer class="py-3 text-center">
    &copy; 2025 Tsunami Edu &mdash; Halaman Edukasi. Dibuat untuk keperluan edukasi dan pembelajaran.
  </footer>

  <!-- BOOTSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Scrollspy kecil buat sidebar -->
  <script>
    const sections = document.querySelectorAll(".edu-section");
    const links = document.querySelectorAll(".edu-nav-link");

    window.addEventListener("scroll", () => {
      let current = "";
      sections.forEach(sec => {
        const offset = sec.offsetTop - 130;
        if (window.scrollY >= offset) {
          current = sec.getAttribute("id");
        }
      });

      links.forEach(link => {
        link.classList.remove("active");
        if (link.getAttribute("href").includes(current)) {
          link.classList.add("active");
        }
      });
    });
  </script>
</body>
</html>
