<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Waver — Dampak & Kerugian Tsunami</title>

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

    /* ===== IMPACT GRID ===== */
    .impact-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 30px;
      margin: 40px 0;
      width: 100%;
      max-width: 1000px;
    }

    .impact-card {
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

    .impact-card.direct {
      border-left: 5px solid var(--danger);
    }

    .impact-card.indirect {
      border-left: 5px solid var(--warning);
    }

    .impact-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .impact-icon {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0 auto 20px;
    }

    .impact-icon.direct {
      background: linear-gradient(135deg, var(--danger), #ff6b6b);
    }

    .impact-icon.indirect {
      background: linear-gradient(135deg, var(--warning), #ffd54f);
    }

    .impact-icon i {
      font-size: 32px;
      color: white;
    }

    .impact-card h3 {
      font-size: 24px;
      font-weight: 700;
      color: var(--dark);
      margin-bottom: 15px;
      text-align: center;
    }

    .impact-list {
      text-align: left;
      width: 100%;
    }

    .impact-list ul {
      list-style: none;
      padding: 0;
    }

    .impact-list li {
      padding: 12px 0;
      border-bottom: 1px solid #f0f0f0;
      display: flex;
      align-items: flex-start;
      gap: 12px;
    }

    .impact-list li:last-child {
      border-bottom: none;
    }

    .impact-list i {
      margin-top: 3px;
      flex-shrink: 0;
    }

    .impact-list.direct i {
      color: var(--danger);
    }

    .impact-list.indirect i {
      color: var(--warning);
    }

    /* ===== DAMAGE STATISTICS ===== */
    .damage-stats {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 25px;
      margin: 40px 0;
      width: 100%;
    }

    .stat-card {
      background: linear-gradient(135deg, #f8faff 0%, #e6f0ff 100%);
      padding: 30px;
      border-radius: 15px;
      text-align: center;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
      display: flex;
      flex-direction: column;
      align-items: center;
      border-top: 4px solid var(--primary);
    }

    .stat-card.infrastructure {
      border-top-color: var(--danger);
    }

    .stat-card.human {
      border-top-color: #e74c3c;
    }

    .stat-card.environment {
      border-top-color: var(--success);
    }

    .stat-card.economic {
      border-top-color: var(--warning);
    }

    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
      font-size: 40px;
      margin-bottom: 20px;
    }

    .stat-card.infrastructure .stat-icon {
      color: var(--danger);
    }

    .stat-card.human .stat-icon {
      color: #e74c3c;
    }

    .stat-card.environment .stat-icon {
      color: var(--success);
    }

    .stat-card.economic .stat-icon {
      color: var(--warning);
    }

    .stat-value {
      font-size: 32px;
      font-weight: 800;
      color: var(--dark);
      margin-bottom: 10px;
    }

    .stat-label {
      font-size: 16px;
      color: #666;
      font-weight: 600;
    }

    /* ===== CRISIS CARDS ===== */
    .crisis-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 25px;
      margin: 40px 0;
      width: 100%;
    }

    .crisis-card {
      background: white;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
      border-top: 5px solid var(--warning);
      text-align: center;
    }

    .crisis-card.health {
      border-top-color: #e74c3c;
    }

    .crisis-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
    }

    .crisis-icon {
      font-size: 40px;
      margin-bottom: 20px;
      color: var(--warning);
    }

    .crisis-card.health .crisis-icon {
      color: #e74c3c;
    }

    .crisis-card h3 {
      font-size: 22px;
      font-weight: 700;
      color: var(--dark);
      margin-bottom: 20px;
    }

    .crisis-list {
      text-align: left;
    }

    .crisis-list ul {
      list-style: none;
      padding: 0;
    }

    .crisis-list li {
      padding: 10px 0;
      border-bottom: 1px solid #f0f0f0;
      display: flex;
      align-items: flex-start;
      gap: 10px;
    }

    .crisis-list li:last-child {
      border-bottom: none;
    }

    .crisis-list i {
      color: var(--warning);
      margin-top: 3px;
      flex-shrink: 0;
    }

    .crisis-card.health .crisis-list i {
      color: #e74c3c;
    }

    /* ===== PROCESS STEPS ===== */
    .process-steps {
      display: flex;
      flex-direction: column;
      gap: 30px;
      margin: 40px 0;
      width: 100%;
    }

    .process-step {
      background: white;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
      display: flex;
      align-items: flex-start;
      gap: 25px;
      transition: all 0.3s ease;
      width: 100%;
    }

    .process-step:hover {
      transform: translateX(10px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
    }

    .step-number {
      width: 60px;
      height: 60px;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 24px;
      font-weight: 800;
      color: white;
      flex-shrink: 0;
    }

    .step-content h4 {
      font-size: 22px;
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

      .navbar-links {
        gap: 15px;
      }

      .navbar-links a {
        font-size: 14px;
      }

      main {
        padding: 0 5% 60px;
      }

      .content-container {
        padding: 30px 20px;
      }

      .impact-grid {
        grid-template-columns: 1fr;
        gap: 20px;
      }

      .damage-stats {
        grid-template-columns: repeat(2, 1fr);
      }

      .crisis-cards {
        grid-template-columns: 1fr;
      }

      .process-step {
        flex-direction: column;
        text-align: center;
      }

      .step-content h4, .step-content p {
        text-align: center;
      }
    }

    @media (max-width: 480px) {
      .damage-stats {
        grid-template-columns: 1fr;
      }
      
      .hero h1 {
        font-size: 32px;
      }
      
      .hero p {
        font-size: 16px;
      }
      
      footer {
        padding: 40px 15px;
      }

      .navbar-links {
        gap: 10px;
      }

      .navbar-links a {
        font-size: 13px;
        padding: 6px 0;
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
    <nav class="navbar-links">
      <a href="index_tsunami_user.php">Beranda</a>
      <a href="riwayat.php">Riwayat</a>
      <a href="maps2.php" style="color: #a9d6ff;">Pantau</a>
      <a href="artikel.php">Artikel</a>
      <a href="volunteer.php">Volunteer</a>
      <a href="about.php">Tentang</a>
    </nav>
  </header>

  <!-- ===== HERO ===== -->
  <section class="hero" id="hero">
    <div class="hero-content" data-aos="fade-up" data-aos-duration="1200">
      <h1>Dampak & Kerugian Tsunami</h1>
      <p>Memahami konsekuensi jangka pendek dan jangka panjang dari bencana tsunami</p>
    </div>
  </section>

  <!-- ===== MAIN CONTENT ===== -->
  <main>
    <!-- Dampak Utama Tsunami -->
    <section class="content-container" data-aos="fade-up">
      <h2>Dampak Utama Tsunami</h2>
      <p>Tsunami menimbulkan berbagai dampak destruktif yang dapat dikategorikan menjadi dampak langsung dan tidak langsung:</p>
      
      <div class="impact-grid">
        <!-- Dampak Langsung -->
        <div class="impact-card direct" data-aos="zoom-in" data-aos-delay="100">
          <div class="impact-icon direct">
            <i class="fas fa-bolt"></i>
          </div>
          <h3>Dampak Langsung</h3>
          <div class="impact-list direct">
            <ul>
              <li>
                <span><strong>Kerusakan Infrastruktur:</strong> Bangunan, jalan, jembatan, dan fasilitas publik hancur total</span>
              </li>
              <li>
                <span><strong>Korban Luka & Jiwa:</strong> Menyebabkan korban luka-luka dan korban jiwa dalam jumlah besar</span>
              </li>
              <li>
                <span><strong>Kerusakan Lingkungan:</strong> Ekosistem pesisir, terumbu karang, dan hutan mangrove rusak parah</span>
              </li>
            </ul>
          </div>
        </div>
        
        <!-- Dampak Tidak Langsung -->
        <div class="impact-card indirect" data-aos="zoom-in" data-aos-delay="200">
          <div class="impact-icon indirect">
            <i class="fas fa-wave-square"></i>
          </div>
          <h3>Dampak Tidak Langsung</h3>
          <div class="impact-list indirect">
            <ul>
              <li>
                <span><strong>Krisis Ekonomi & Sosial:</strong> Ekonomi lumpuh, sektor pariwisata dan perikanan kolaps</span>
              </li>
              <li>
                <span><strong>Trauma Psikologis:</strong> Gangguan stres pasca-trauma pada korban selamat</span>
              </li>
              <li>
                <span><strong>Krisis Kemanusiaan:</strong> Menyebarnya wabah penyakit, krisis air bersih dan pangan</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- Statistik Kerusakan -->
    <section class="content-container" data-aos="fade-up">
      <h2>Statistik Kerusakan Tsunami</h2>
      <p>Data kerusakan yang umum terjadi akibat bencana tsunami berdasarkan studi kasus sebelumnya:</p>

      <div class="damage-stats">
        <div class="stat-card infrastructure" data-aos="flip-up" data-aos-delay="100">
          <div class="stat-icon">
            <i class="fas fa-building"></i>
          </div>
          <div class="stat-value">85%</div>
          <div class="stat-label">Infrastruktur Rusak</div>
        </div>
        
        <div class="stat-card human" data-aos="flip-up" data-aos-delay="200">
          <div class="stat-icon">
            <i class="fas fa-users"></i>
          </div>
          <div class="stat-value">230K+</div>
          <div class="stat-label">Korban Jiwa Global</div>
        </div>
        
        <div class="stat-card environment" data-aos="flip-up" data-aos-delay="300">
          <div class="stat-icon">
            <i class="fas fa-leaf"></i>
          </div>
          <div class="stat-value">70%</div>
          <div class="stat-label">Ekosistem Rusak</div>
        </div>
        
        <div class="stat-card economic" data-aos="flip-up" data-aos-delay="400">
          <div class="stat-icon">
            <i class="fas fa-dollar-sign"></i>
          </div>
          <div class="stat-value">$280B</div>
          <div class="stat-label">Kerugian Ekonomi</div>
        </div>
      </div>
    </section>

    <!-- Krisis Kemanusiaan -->
    <section class="content-container" data-aos="fade-up">
      <h2>Krisis Kemanusiaan Pasca Tsunami</h2>
      <p>Dampak lanjutan yang muncul setelah bencana tsunami dan memerlukan penanganan khusus:</p>

      <div class="crisis-cards">
        <div class="crisis-card" data-aos="zoom-in" data-aos-delay="100">
          <div class="crisis-icon">
            <i class="fas fa-virus"></i>
          </div>
          <h3>Wabah Penyakit</h3>
          <div class="crisis-list">
            <ul>
              <li>
                <i class="fas fa-exclamation-circle"></i>
                <span>Penyebaran penyakit menular akibat air yang terkontaminasi</span>
              </li>
              <li>
                <i class="fas fa-exclamation-circle"></i>
                <span>Wabah diare, tifus, dan leptospirosis</span>
              </li>
              <li>
                <i class="fas fa-exclamation-circle"></i>
                <span>Kurangnya akses ke fasilitas kesehatan</span>
              </li>
            </ul>
          </div>
        </div>
        
        <div class="crisis-card health" data-aos="zoom-in" data-aos-delay="200">
          <div class="crisis-icon">
            <i class="fas fa-tint"></i>
          </div>
          <h3>Krisis Air & Pangan</h3>
          <div class="crisis-list">
            <ul>
              <li>
                <i class="fas fa-exclamation-circle"></i>
                <span>Krisis air bersih untuk minum dan sanitasi</span>
              </li>
              <li>
                <i class="fas fa-exclamation-circle"></i>
                <span>Kelangkaan bahan pangan pokok</span>
              </li>
              <li>
                <i class="fas fa-exclamation-circle"></i>
                <span>Rantai pasok makanan terputus</span>
              </li>
            </ul>
          </div>
        </div>
        
        <div class="crisis-card" data-aos="zoom-in" data-aos-delay="300">
          <div class="crisis-icon">
            <i class="fas fa-home"></i>
          </div>
          <h3>Pengungsian & Pemukiman</h3>
          <div class="crisis-list">
            <ul>
              <li>
                <i class="fas fa-exclamation-circle"></i>
                <span>Ribuan orang kehilangan tempat tinggal</span>
              </li>
              <li>
                <i class="fas fa-exclamation-circle"></i>
                <span>Pengungsian jangka panjang diperlukan</span>
              </li>
              <li>
                <i class="fas fa-exclamation-circle"></i>
                <span>Kepadatan di tempat pengungsian memicu masalah baru</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- Timeline Pemulihan -->
    <section class="content-container" data-aos="fade-up">
      <h2>Timeline Pemulihan Pasca Tsunami</h2>
      <p>Proses pemulihan dari bencana tsunami membutuhkan waktu yang panjang dan tahapan yang sistematis:</p>

      <div class="process-steps">
        <div class="process-step" data-aos="fade-right" data-aos-delay="100">
          <div class="step-number">1</div>
          <div class="step-content">
            <h4>Tahap Darurat (0-3 Bulan)</h4>
            <p>Penyelamatan korban, evakuasi, penyediaan kebutuhan dasar (air, makanan, tempat tinggal darurat), dan penanganan medis.</p>
          </div>
        </div>
        
        <div class="process-step" data-aos="fade-right" data-aos-delay="200">
          <div class="step-number">2</div>
          <div class="step-content">
            <h4>Tahap Transisi (3-12 Bulan)</h4>
            <p>Pembersihan puing, perbaikan infrastruktur dasar, pemulihan layanan publik, dan persiapan rekonstruksi.</p>
          </div>
        </div>
        
        <div class="process-step" data-aos="fade-right" data-aos-delay="300">
          <div class="step-number">3</div>
          <div class="step-content">
            <h4>Tahap Rekonstruksi (1-3 Tahun)</h4>
            <p>Pembangunan kembali rumah, infrastruktur permanen, fasilitas publik, dan pemulihan ekonomi lokal.</p>
          </div>
        </div>
        
        <div class="process-step" data-aos="fade-right" data-aos-delay="400">
          <div class="step-number">4</div>
          <div class="step-content">
            <h4>Tahap Pembangunan Kembali (3-5+ Tahun)</h4>
            <p>Penguatan ketahanan komunitas, pengembangan sistem peringatan dini, dan pembangunan berkelanjutan.</p>
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
