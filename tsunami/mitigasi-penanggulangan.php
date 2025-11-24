<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Waver — Mitigasi & Penanggulangan Tsunami</title>

  <!-- FONT & LIBRARY -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    :root {
      --primary: #0057ff;
      --secondary: #007bff;
      --dark: #001b44;
      --light: #f8faff;
      --accent: #00d4ff;
      --success: #28a745;
      --danger: #dc3545;
      --warning: #ffc107;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: "Inter", sans-serif;
      scroll-behavior: smooth;
      background: linear-gradient(135deg, #f8faff 0%, #e6f0ff 100%);
      color: #333;
      line-height: 1.6;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* ===== SCROLL PROGRESS BAR ===== */
    .scroll-progress {
      position: fixed;
      top: 0;
      left: 0;
      width: 0%;
      height: 4px;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
      z-index: 3000;
      transition: width 0.1s ease;
    }

    /* ===== NOTIFICATION BAR ===== */
    #notification {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      background: linear-gradient(90deg, #ff0000, #ff4d4d);
      color: white;
      padding: 18px 50px;
      text-align: center;
      font-weight: 800;
      font-size: 18px;
      letter-spacing: 1px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
      z-index: 3000;
      animation: slideDown 0.6s ease;
    }

    #notification button.close-btn {
      position: absolute;
      right: 20px;
      top: 10px;
      background: transparent;
      border: none;
      color: white;
      font-size: 22px;
      font-weight: 900;
      cursor: pointer;
      transition: 0.3s;
    }

    #notification button.close-btn:hover {
      transform: scale(1.2);
    }

    @keyframes slideDown {
      from { transform: translateY(-50px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    /* ===== NAVBAR ===== */
    .navbar-container {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 2000;
      backdrop-filter: blur(12px);
      background: rgba(0, 0, 0, 0.3);
      padding: 15px 10%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      transition: all 0.4s ease;
    }

    .navbar-container.notif-active {
      top: 60px;
    }

    .navbar-container.scrolled {
      background: rgba(0, 0, 50, 0.95);
      padding: 12px 8%;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .logo-item img {
      width: 80px;
      height: auto;
      transition: transform 0.3s ease;
    }

    .logo-item:hover img {
      transform: scale(1.08);
    }

      /* ===== NAVBAR ===== */
    .navbar-container {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 2000;
      backdrop-filter: blur(12px);
      background: rgba(0, 0, 0, 0.3);
      padding: 15px 10%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      transition: all 0.4s ease;
    }

    .navbar-container.notif-active {
      top: 60px;
    }

    .navbar-container.scrolled {
      background: rgba(0, 0, 50, 0.95);
      padding: 12px 8%;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .logo-item img {
      width: 80px;
      height: auto;
      transition: transform 0.3s ease;
    }

    .logo-item:hover img {
      transform: scale(1.08);
    }

    .navbar-links {
      display: flex;
      gap: 35px;
    }

    .navbar-links a {
      color: #fff;
      text-decoration: none;
      font-weight: 600;
      text-transform: uppercase;
      transition: all 0.3s ease;
      font-size: 15px;
      letter-spacing: 0.5px;
      position: relative;
      padding: 8px 0;
    }

    .navbar-links a::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 0;
      height: 2px;
      background: linear-gradient(90deg, var(--secondary), var(--primary));
      transition: width 0.3s ease;
    }

    .navbar-links a:hover {
      color: #a9d6ff;
    }

    .navbar-links a:hover::after {
      width: 100%;
    }

    /* ===== HERO SECTION ===== */
    .hero {
      position: relative;
      height: 50vh;
      background: linear-gradient(135deg, rgba(0, 23, 45, 0.9) 0%, rgba(0, 87, 255, 0.7) 100%), 
                  url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMjAwIDgwMCIgb3BhY2l0eT0iMC4xIj48cGF0aCBkPSJNMCA2MDAgQzE1MCA4MDAgMzUwIDQwMCA2MDAgNjAwIEM4NTAgODAwIDEwNTAgNDAwIDEyMDAgNjAwIEwxMjAwIDgwMCBMMCA4MDAgWiIgZmlsbD0iIzAwNTdmZiIvPjwvc3ZnPg==');
      background-size: cover;
      background-position: center;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      color: white;
      text-align: center;
      margin-top: 0;
      padding-top: 80px;
      margin-bottom: 40px;
    }

    .hero.notif-active {
      padding-top: 140px;
    }

    .hero-content {
      width: 100%;
      max-width: 900px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .hero h1 {
      font-size: 56px;
      font-weight: 900;
      color: white;
      text-shadow: 0 4px 12px rgba(0, 0, 0, 0.8), 0 8px 24px rgba(0, 0, 0, 0.6);
      margin-bottom: 15px;
      text-align: center;
      width: 100%;
    }

    .hero p {
      font-size: 22px;
      color: white;
      font-weight: 600;
      text-shadow: 0 2px 8px rgba(0, 0, 0, 0.8), 0 4px 16px rgba(0, 0, 0, 0.5);
      max-width: 700px;
      text-align: center;
      margin: 0 auto;
      line-height: 1.6;
    }

    /* ===== MAIN CONTENT ===== */
    main {
      padding: 0 10% 80px;
      flex: 1;
    }

    section {
      margin-bottom: 80px;
    }

    h2 {
      font-size: 42px;
      font-weight: 800;
      color: var(--primary);
      margin-bottom: 30px;
      position: relative;
      display: block;
      text-align: center;
      width: 100%;
    }

    h2::after {
      content: '';
      position: absolute;
      bottom: -8px;
      left: 50%;
      transform: translateX(-50%);
      width: 50px;
      height: 4px;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
      border-radius: 2px;
    }

    h3 {
      font-size: 28px;
      font-weight: 700;
      color: var(--dark);
      margin: 40px 0 20px 0;
      text-align: center;
    }

    p {
      font-size: 18px;
      line-height: 1.8;
      color: #555;
      margin-bottom: 20px;
      text-align: justify;
    }

    /* ===== CONTENT CONTAINERS ===== */
    .content-container {
      background: white;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      padding: 40px;
      margin-bottom: 40px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    /* ===== MITIGATION GRID ===== */
    .mitigation-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 30px;
      margin: 40px 0;
      width: 100%;
      max-width: 1000px;
    }

    .mitigation-card {
      background: white;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      transition: all 0.4s ease;
      border: 2px solid transparent;
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
      position: relative;
      overflow: hidden;
      height: 100%;
    }

    .mitigation-card.structural {
      border-left: 5px solid var(--primary);
    }

    .mitigation-card.non-structural {
      border-left: 5px solid var(--success);
    }

    .mitigation-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 40px rgba(0, 87, 255, 0.15);
    }

    .mitigation-icon {
      width: 70px;
      height: 70px;
      background: linear-gradient(135deg, var(--primary), var(--accent));
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0 auto 20px;
    }

    .mitigation-icon.non-structural {
      background: linear-gradient(135deg, var(--success), var(--accent));
    }

    .mitigation-icon i {
      font-size: 28px;
      color: white;
    }

    .mitigation-card h3 {
      font-size: 22px;
      font-weight: 700;
      color: var(--dark);
      margin-bottom: 15px;
      text-align: center;
    }

    .mitigation-list {
      text-align: left;
      width: 100%;
    }

    .mitigation-list ul {
      list-style: none;
      padding: 0;
    }

    .mitigation-list li {
      padding: 8px 0;
      border-bottom: 1px solid #f0f0f0;
      display: flex;
      align-items: flex-start;
      gap: 10px;
    }

    .mitigation-list li:last-child {
      border-bottom: none;
    }

    .mitigation-list i {
      color: var(--primary);
      margin-top: 5px;
      flex-shrink: 0;
    }

    .mitigation-list.non-structural i {
      color: var(--success);
    }

    /* ===== EMERGENCY STEPS ===== */
    .emergency-steps {
      display: flex;
      flex-direction: column;
      gap: 20px;
      margin: 40px 0;
      width: 100%;
    }

    .emergency-step {
      background: white;
      padding: 25px;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
      display: flex;
      align-items: flex-start;
      gap: 20px;
      transition: all 0.3s ease;
      width: 100%;
      border-left: 4px solid var(--warning);
    }

    .emergency-step:hover {
      transform: translateX(10px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
    }

    .step-icon {
      width: 50px;
      height: 50px;
      background: linear-gradient(135deg, var(--warning), #ffd54f);
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 20px;
      color: white;
      flex-shrink: 0;
    }

    .step-content h4 {
      font-size: 20px;
      font-weight: 700;
      color: var(--dark);
      margin-bottom: 10px;
      text-align: left;
    }

    .step-content p {
      font-size: 16px;
      color: #666;
      margin-bottom: 0;
      text-align: left;
    }

    /* ===== PHASE CARDS ===== */
    .phase-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 25px;
      margin: 40px 0;
      width: 100%;
    }

    .phase-card {
      background: white;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
      border-top: 5px solid var(--primary);
      text-align: center;
    }

    .phase-card.during {
      border-top-color: var(--danger);
    }

    .phase-card.after {
      border-top-color: var(--success);
    }

    .phase-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
    }

    .phase-icon {
      font-size: 40px;
      margin-bottom: 20px;
      color: var(--primary);
    }

    .phase-card.during .phase-icon {
      color: var(--danger);
    }

    .phase-card.after .phase-icon {
      color: var(--success);
    }

    .phase-card h3 {
      font-size: 22px;
      font-weight: 700;
      color: var(--dark);
      margin-bottom: 20px;
    }

    .phase-list {
      text-align: left;
    }

    .phase-list ul {
      list-style: none;
      padding: 0;
    }

    .phase-list li {
      padding: 8px 0;
      border-bottom: 1px solid #f0f0f0;
      display: flex;
      align-items: flex-start;
      gap: 10px;
    }

    .phase-list li:last-child {
      border-bottom: none;
    }

    .phase-list i {
      color: var(--primary);
      margin-top: 5px;
      flex-shrink: 0;
    }

    .phase-card.during .phase-list i {
      color: var(--danger);
    }

    .phase-card.after .phase-list i {
      color: var(--success);
    }

    /* ===== FOOTER ===== */
    footer {
      background: linear-gradient(135deg, var(--dark) 0%, #002855 100%);
      color: white;
      text-align: center;
      padding: 60px 20px;
      position: relative;
      margin-top: auto;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    footer::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 3px;
      background: linear-gradient(90deg, var(--primary), var(--secondary), var(--primary));
    }

    .footer-content {
      max-width: 1200px;
      width: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    footer h4 {
      font-weight: 700;
      font-size: 22px;
      margin-bottom: 10px;
      text-align: center;
      width: 100%;
    }

    footer p {
      font-size: 15px;
      opacity: 0.9;
      color: white;
      margin-bottom: 0;
      text-align: center;
      width: 100%;
    }

    /* Scroll to Top */
    #backToTop {
      display: none;
      position: fixed;
      bottom: 35px;
      right: 35px;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: white;
      border: none;
      padding: 14px 18px;
      border-radius: 12px;
      font-size: 22px;
      cursor: pointer;
      z-index: 1000;
      box-shadow: 0 6px 20px rgba(0, 87, 255, 0.3);
      transition: all 0.3s ease;
    }

    #backToTop:hover {
      transform: translateY(-4px);
      box-shadow: 0 10px 30px rgba(0, 87, 255, 0.4);
    }

    /* Responsive */
    @media (max-width: 768px) {
      .hero h1 {
        font-size: 38px;
      }
      
      .hero p {
        font-size: 18px;
      }

      h2 {
        font-size: 32px;
      }

      h3 {
        font-size: 24px;
      }

      .navbar-container {
        padding: 15px 5%;
      }

      .navbar-nav {
        gap: 15px;
      }

      .nav-link {
        font-size: 14px;
      }

      main {
        padding: 0 5% 60px;
      }

      .content-container {
        padding: 30px 20px;
      }

      .mitigation-grid {
        grid-template-columns: 1fr;
        gap: 20px;
      }

      .phase-cards {
        grid-template-columns: 1fr;
      }

      .emergency-step {
        flex-direction: column;
        text-align: center;
      }

      .step-content h4, .step-content p {
        text-align: center;
      }
    }

    @media (max-width: 480px) {
      .hero h1 {
        font-size: 32px;
      }
      
      .hero p {
        font-size: 16px;
      }
      
      footer {
        padding: 40px 15px;
      }

      .navbar-nav {
        gap: 10px;
      }

      .nav-link {
        font-size: 13px;
        padding: 6px 0;
      }

      .nav-link i {
        font-size: 14px;
      }
    }
  </style>
</head>

<body>
  <!-- Scroll Progress Bar -->
  <div class="scroll-progress" id="scrollProgress"></div>

  <!-- ===== NOTIFICATION BAR ===== -->
  <div id="notification" role="alert" aria-live="assertive">
    ⚠️ PERINGATAN DARURAT! Tsunami terdeteksi — Perkiraan tiba dalam 20 menit di Palu!
    <button class="close-btn" id="closeNotifBtn" aria-label="Tutup notifikasi">×</button>
  </div>

    <!-- ===== NAVBAR ===== -->
  <header class="navbar-container" id="navbar">
    <div class="logo-item">
      <img src="img/tsunamelogo.png" alt="Tsuname Logo" />
    </div>
    <nav class="navbar-links" aria-label="Menu utama">
      <a href="index_tsunami_user.php">Beranda</a>
      <a href="riwayat.php">Riwayat</a>
      <a href="maps2.php">Pantau</a>
      <a href="artikel.php">Artikel</a>
      <a href="volunteer.php">Volunter</a>
      <a href="about.php">Tentang</a>
    </nav>
  </header>

  <!-- ===== HERO ===== -->
  <section class="hero" id="hero">
    <div class="hero-content" data-aos="fade-up" data-aos-duration="1200">
      <h1>Mitigasi & Penanggulangan Tsunami</h1>
      <p>Strategi lengkap untuk mengurangi risiko dan menanggulangi bencana tsunami</p>
    </div>
  </section>

  <!-- ===== MAIN CONTENT ===== -->
  <main>
    <!-- Mitigasi Tsunami -->
    <section class="content-container" data-aos="fade-up">
      <h2>Mitigasi Tsunami</h2>
      <p>Mitigasi tsunami terdiri dari upaya struktural dan non-struktural untuk mengurangi dampak bencana sebelum terjadi:</p>
      
      <div class="mitigation-grid">
        <!-- Mitigasi Struktural -->
        <div class="mitigation-card structural" data-aos="zoom-in" data-aos-delay="100">
          <div class="mitigation-icon">
            <i class="fas fa-building-shield"></i>
          </div>
          <h3>Mitigasi Struktural</h3>
          <div class="mitigation-list">
            <ul>
              <li>
                <i class="fas fa-check-circle"></i>
                <span>Membangun shelter evakuasi tsunami</span>
              </li>
              <li>
                <i class="fas fa-check-circle"></i>
                <span>Membuat jalur & rambu evakuasi tsunami</span>
              </li>
              <li>
                <i class="fas fa-check-circle"></i>
                <span>Pemasangan sistem peringatan dini fisik</span>
              </li>
              <li>
                <i class="fas fa-check-circle"></i>
                <span>Penguatan ekosistem pesisir</span>
              </li>
            </ul>
          </div>
        </div>
        
        <!-- Mitigasi Non-Struktural -->
        <div class="mitigation-card non-structural" data-aos="zoom-in" data-aos-delay="200">
          <div class="mitigation-icon non-structural">
            <i class="fas fa-users-gear"></i>
          </div>
          <h3>Mitigasi Non-Struktural</h3>
          <div class="mitigation-list non-structural">
            <ul>
              <li>
                <i class="fas fa-check-circle"></i>
                <span>Edukasi & sosialisasi masyarakat</span>
              </li>
              <li>
                <i class="fas fa-check-circle"></i>
                <span>Simulasi evakuasi rutin</span>
              </li>
              <li>
                <i class="fas fa-check-circle"></i>
                <span>Pemetaan & sosialisasi wilayah rawan tsunami</span>
              </li>
              <li>
                <i class="fas fa-check-circle"></i>
                <span>Peraturan & kebijakan tata ruang</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- Penanggulangan Saat Bencana -->
    <section class="content-container" data-aos="fade-up">
      <h2>Penanggulangan Saat Bencana</h2>
      <p>Tindakan yang harus dilakukan ketika tsunami terjadi untuk menyelamatkan diri:</p>

      <div class="emergency-steps">
        <div class="emergency-step" data-aos="fade-right" data-aos-delay="100">
          <div class="step-icon">
            <i class="fas fa-running"></i>
          </div>
          <div class="step-content">
            <h4>Evakuasi Segera</h4>
            <p>Jika berada di pantai dan terjadi gempa lalu air laut surut tiba-tiba, segera lari ke tempat tinggi atau ikuti rute evakuasi resmi.</p>
          </div>
        </div>
        
        <div class="emergency-step" data-aos="fade-right" data-aos-delay="200">
          <div class="step-icon">
            <i class="fas fa-ship"></i>
          </div>
          <div class="step-content">
            <h4>Di Perahu/Kapal</h4>
            <p>Jika berada di perahu atau kapal saat tsunami, jangan mendekati pesisir. Tetap di laut lepas.</p>
          </div>
        </div>
        
        <div class="emergency-step" data-aos="fade-right" data-aos-delay="300">
          <div class="step-icon">
            <i class="fas fa-wave-square"></i>
          </div>
          <div class="step-content">
            <h4>Waspada Gelombang Susulan</h4>
            <p>Jika gelombang pertama surut, jangan langsung turun ke tempat rendah karena gelombang susulan bisa lebih tinggi dan berbahaya.</p>
          </div>
        </div>
        
        <div class="emergency-step" data-aos="fade-right" data-aos-delay="400">
          <div class="step-icon">
            <i class="fas fa-car"></i>
          </div>
          <div class="step-content">
            <h4>Mengemudi</h4>
            <p>Jika tsunami terjadi saat mengemudi, segera keluar kendaraan dan menuju tempat tinggi yang aman.</p>
          </div>
        </div>
        
        <div class="emergency-step" data-aos="fade-right" data-aos-delay="500">
          <div class="step-icon">
            <i class="fas fa-bullhorn"></i>
          </div>
          <div class="step-content">
            <h4>Informasi Resmi</h4>
            <p>Segera evakuasi saat ada pemberitahuan resmi dan hindari informasi dari sumber tidak jelas.</p>
          </div>
        </div>
        
        <div class="emergency-step" data-aos="fade-right" data-aos-delay="600">
          <div class="step-icon">
            <i class="fas fa-people-carry"></i>
          </div>
          <div class="step-content">
            <h4>Prioritas Keselamatan</h4>
            <p>Utamakan keselamatan, tinggalkan barang tidak penting, pastikan keluarga ikut, dan bantu tetangga atau kerabat ikut evakuasi.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Penanggulangan Pasca Bencana -->
    <section class="content-container" data-aos="fade-up">
      <h2>Penanggulangan Pasca Bencana</h2>
      <p>Tindakan yang harus dilakukan setelah tsunami terjadi untuk memastikan keselamatan dan pemulihan:</p>

      <div class="phase-cards">
        <div class="phase-card" data-aos="zoom-in" data-aos-delay="100">
          <div class="phase-icon">
            <i class="fas fa-broadcast-tower"></i>
          </div>
          <h3>Konfirmasi Keamanan</h3>
          <div class="phase-list">
            <ul>
              <li>
                <i class="fas fa-check"></i>
                <span>Pastikan ancaman tsunami telah berakhir melalui informasi resmi (BMKG, TV, radio, pengumuman)</span>
              </li>
              <li>
                <i class="fas fa-check"></i>
                <span>Hindari area tergenang, puing-puing, jaringan listrik, dan pipa gas</span>
              </li>
            </ul>
          </div>
        </div>
        
        <div class="phase-card during" data-aos="zoom-in" data-aos-delay="200">
          <div class="phase-icon">
            <i class="fas fa-house-damage"></i>
          </div>
          <h3>Pemeriksaan Lingkungan</h3>
          <div class="phase-list">
            <ul>
              <li>
                <i class="fas fa-check"></i>
                <span>Waspadai kerusakan bangunan saat memasuki gedung</span>
              </li>
              <li>
                <i class="fas fa-check"></i>
                <span>Lakukan perawatan medis bila terluka</span>
              </li>
              <li>
                <i class="fas fa-check"></i>
                <span>Periksa makanan dan air, hindari yang terkontaminasi</span>
              </li>
            </ul>
          </div>
        </div>
        
        <div class="phase-card after" data-aos="zoom-in" data-aos-delay="300">
          <div class="phase-icon">
            <i class="fas fa-hand-holding-medical"></i>
          </div>
          <h3>Bantuan & Pemulihan</h3>
          <div class="phase-list">
            <ul>
              <li>
                <i class="fas fa-check"></i>
                <span>Berikan P3K pada korban luka ringan</span>
              </li>
              <li>
                <i class="fas fa-check"></i>
                <span>Minta bantuan untuk korban luka serius</span>
              </li>
              <li>
                <i class="fas fa-check"></i>
                <span>Bersihkan rumah yang masih layak huni</span>
              </li>
              <li>
                <i class="fas fa-check"></i>
                <span>Gunakan tenda/tempat pengungsian jika rumah tidak dapat dihuni</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

  </main>

  <!-- ===== FOOTER ===== -->
  <footer data-aos="fade-up">
    <div class="footer-content">
      <h4>Waver Project © 2025</h4>
      <p>Created by Waver | Stay Safe, Stay Prepared</p>
    </div>
  </footer>

  <button id="backToTop" aria-label="Kembali ke atas">↑</button>

  <!-- SCRIPT -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    // Initialize AOS
    AOS.init({ 
      duration: 800,
      once: true,
      easing: 'ease-out'
    });

    // DOM Elements
    const navbar = document.getElementById("navbar");
    const hero = document.getElementById("hero");
    const notif = document.getElementById("notification");
    const closeNotifBtn = document.getElementById("closeNotifBtn");
    const backToTop = document.getElementById("backToTop");
    const scrollProgress = document.getElementById("scrollProgress");

    // Scroll Effects
    window.addEventListener("scroll", () => {
      const scrollY = window.scrollY;
      
      navbar.classList.toggle("scrolled", scrollY > 100);
      backToTop.style.display = scrollY > 300 ? "block" : "none";
      
      const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
      const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
      const scrolled = (winScroll / height) * 100;
      if (scrollProgress) {
        scrollProgress.style.width = scrolled + "%";
      }
    });

    // Back to Top
    backToTop.addEventListener("click", () => {
      window.scrollTo({ top: 0, behavior: "smooth" });
    });

    // Notification Functions
    function showNotification() {
      notif.style.display = "block";
      navbar.classList.add("notif-active");
      hero.classList.add("notif-active");
    }

    function closeNotification() {
      notif.style.transition = "opacity 0.5s ease";
      notif.style.opacity = "0";
      setTimeout(() => {
        notif.style.display = "none";
        notif.style.opacity = "1";
        navbar.classList.remove("notif-active");
        hero.classList.remove("notif-active");
      }, 500);
      localStorage.setItem("notifClosed", "true");
      localStorage.setItem("notifActive", "false");
    }

    closeNotifBtn.addEventListener("click", closeNotification);

    // Check Notification on Page Load
    window.addEventListener("DOMContentLoaded", () => {
      const notifActive = localStorage.getItem("notifActive");
      const notifClosed = localStorage.getItem("notifClosed");

      if ((notifActive === "true" && notifClosed === "false") || 
          (notifActive === null && notifClosed === null)) {
        showNotification();
      } else {
        notif.style.display = "none";
        navbar.classList.remove("notif-active");
        hero.classList.remove("notif-active");
      }
    });
  </script>
</body>
</html>
