<?php
// Include koneksi database
include 'koneksi.php';

// Query untuk mengambil data artikel dari database
$sql_artikel = "SELECT * FROM artikel ORDER BY tanggal_publikasi DESC";
$result_artikel = $conn->query($sql_artikel);

// Inisialisasi array untuk menyimpan data
$artikel_data = [];

// Ambil data artikel
if ($result_artikel && $result_artikel->num_rows > 0) {
    while($row = $result_artikel->fetch_assoc()) {
        $artikel_data[] = $row;
    }
}

// Jika tidak ada data, gunakan data default
if (empty($artikel_data)) {
    $artikel_data = [
        [
            'judul' => 'Detik-detik Gempa M 6.9 dan Tsunami Guncang Jepang',
            'kategori' => 'Berita Utama',
            'url_gambar' => 'img/jepang.webp',
            'konten' => 'Gempa bumi berkekuatan magnitudo 6,9 mengguncang Jepang disusul peringatan tsunami. Kejadian ini mengingatkan pentingnya sistem peringatan dini yang efektif untuk menyelamatkan ribuan nyawa.',
            'link_artikel_eksternal' => 'https://www.cnnindonesia.com/internasional/20240102123435-134-1044566/detik-detik-gempa-m-69-dan-tsunami-guncang-jepang',
            'tanggal_publikasi' => date('Y-m-d')
        ],
        [
            'judul' => 'Peringatan Tsunami Sedunia Dorong Edukasi dan Kewaspadaan Masyarakat',
            'kategori' => 'Berita Utama',
            'url_gambar' => 'img/rri.jpeg',
            'konten' => 'Peringatan tsunami sedunia mengingatkan pentingnya edukasi dan kewaspadaan masyarakat terhadap potensi bencana tsunami di wilayah pesisir.',
            'link_artikel_eksternal' => 'https://rri.co.id/ekonomi-dan-bisnis/411259/peringatan-tsunami-sedunia-dorong-edukasi-dan-kewaspadaan-masyarakat',
            'tanggal_publikasi' => date('Y-m-d', strtotime('-1 day'))
        ]
    ];
}

// Tutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Waver — Artikel & Edukasi</title>

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
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: "Inter", sans-serif;
      scroll-behavior: smooth;
      background-color: #ffffff;
      color: #333;
      line-height: 1.6;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
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
                   url('img/artikel.jpeg');
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
    }

    .hero.notif-active {
      padding-top: 140px;
    }

    .hero h1 {
      font-size: 56px;
      font-weight: 900;
      color: white;
      text-shadow: 0 4px 12px rgba(0, 0, 0, 0.8), 0 8px 24px rgba(0, 0, 0, 0.6);
      margin-bottom: 15px;
    }

    .hero p {
      font-size: 22px;
      color: white;
      font-weight: 600;
      text-shadow: 0 2px 8px rgba(0, 0, 0, 0.8), 0 4px 16px rgba(0, 0, 0, 0.5);
      max-width: 600px;
    }

    /* ===== MAIN CONTENT ===== */
    main {
      padding: 80px 10%;
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
      display: inline-block;
    }

    h2::after {
      content: '';
      position: absolute;
      bottom: -8px;
      left: 0;
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
    }

    p {
      font-size: 18px;
      line-height: 1.8;
      color: #555;
      margin-bottom: 20px;
    }

    /* ===== ARTICLE GRID ===== */
    .read-more {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary);
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-top: auto;
        padding: 8px 16px;
    }

    .read-more:hover {
        gap: 12px;
    }

    .article-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
      gap: 30px;
    }

    .card-article {
      background: white;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      overflow: hidden;
      transition: all 0.4s ease;
      border: 2px solid transparent;
      position: relative;
      display: flex;
      flex-direction: column;
      height: 100%;
    }

    .card-article::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 5px;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
      transform: scaleX(0);
      transition: transform 0.4s ease;
    }

    .card-article:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 40px rgba(0, 87, 255, 0.15);
      border-color: var(--primary);
    }

    .card-article:hover::before {
      transform: scaleX(1);
    }

    .article-image-container {
      width: 100%;
      height: 220px;
      overflow: hidden;
    }

    .article-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.4s ease;
    }

    .card-article:hover .article-image {
      transform: scale(1.05);
    }

    .card-body {
      padding: 30px;
      display: flex;
      flex-direction: column;
      flex: 1;
    }

    .article-category {
      display: inline-block;
      padding: 6px 12px;
      background: linear-gradient(135deg, var(--primary), var(--accent));
      color: white;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      text-transform: uppercase;
      margin-bottom: 15px;
      align-self: flex-start;
    }

    .card-article h5 {
      font-size: 20px;
      font-weight: 700;
      color: var(--dark);
      margin-bottom: 15px;
      line-height: 1.4;
      flex: 0 0 auto;
    }

    .article-meta {
      display: flex;
      align-items: center;
      gap: 15px;
      margin-bottom: 15px;
      font-size: 14px;
      color: #666;
      flex: 0 0 auto;
    }

    .meta-item {
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .meta-item i {
      color: var(--primary);
    }

    .card-article p {
      font-size: 16px;
      color: #666;
      line-height: 1.6;
      margin-bottom: 20px;
      flex: 1;
    }

    .read-more {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: var(--primary);
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      margin-top: auto;
    }

    .read-more:hover {
      gap: 12px;
      color: var(--secondary);
    }

    /* ===== FEATURED ARTICLE ===== */
    .featured-article {
      background: linear-gradient(135deg, #f8faff 0%, #e6f0ff 100%);
      border-radius: 30px;
      padding: 50px;
      margin-bottom: 60px;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
      align-items: center;
    }

    .featured-content h2 {
      font-size: 36px;
      margin-bottom: 20px;
    }

    .featured-image {
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .featured-image img {
      width: 100%;
      height: 300px;
      object-fit: cover;
      transition: transform 0.4s ease;
    }

    .featured-image:hover img {
      transform: scale(1.05);
    }

    /* ===== NEWS TICKER ===== */
    .news-ticker {
      background: linear-gradient(90deg, var(--primary), var(--secondary));
      color: white;
      padding: 15px 0;
      margin-bottom: 40px;
      overflow: hidden;
      border-radius: 10px;
    }

    .ticker-content {
      display: flex;
      animation: ticker 30s linear infinite;
      white-space: nowrap;
    }

    .ticker-item {
      padding: 0 30px;
      font-weight: 600;
    }

    .ticker-item::before {
      content: "•";
      margin-right: 10px;
      color: var(--accent);
    }

    @keyframes ticker {
      0% { transform: translateX(100%); }
      100% { transform: translateX(-100%); }
    }

    /* ===== FOOTER ===== */
    footer {
      background: linear-gradient(135deg, var(--dark) 0%, #002855 100%);
      color: white;
      text-align: center;
      padding: 60px 20px;
      position: relative;
      margin-top: auto;
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
      margin: 0 auto;
    }

    footer h4 {
      font-weight: 700;
      font-size: 22px;
      margin-bottom: 10px;
    }

    footer p {
      font-size: 15px;
      opacity: 0.9;
      color: white;
      margin-bottom: 0;
    }

    .footer-links {
      display: flex;
      justify-content: center;
      gap: 30px;
      margin-top: 20px;
      flex-wrap: wrap;
    }

    .footer-links a {
      color: white;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .footer-links a:hover {
      color: var(--accent);
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

      .featured-article {
        grid-template-columns: 1fr;
        padding: 30px 20px;
        gap: 30px;
      }

      .featured-content h2 {
        font-size: 28px;
      }

      .article-grid {
        grid-template-columns: 1fr;
      }

      .navbar-links {
        display: none;
      }

      .navbar-container {
        padding: 15px 5%;
      }

      main {
        padding: 60px 5%;
      }

      .footer-links {
        flex-direction: column;
        gap: 15px;
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
      <a href="artikel.php" style="color: #a9d6ff;">Artikel</a>
      <a href="volunteer.php">Volunter</a>
      <a href="about.php">Tentang</a>
    </nav>
  </header>

  <!-- ===== HERO ===== -->
  <section class="hero" id="hero">
    <div class="hero-content" data-aos="fade-up" data-aos-duration="1200">
      <h1>Artikel & Edukasi</h1>
      <p>Informasi terkini dan edukasi tentang kesiapsiagaan tsunami untuk keselamatan masyarakat</p>
    </div>
  </section>

  <!-- ===== MAIN CONTENT ===== -->
  <main>
    <!-- News Ticker -->
    <div class="news-ticker" data-aos="fade-up">
      <div class="ticker-content">
        <div class="ticker-item">Gempa M 6.9 dan Tsunami Guncang Jepang - CNBC Indonesia</div>
        <div class="ticker-item">Peringatan Tsunami Sedunia Dorong Edukasi dan Kewaspadaan - RRI</div>
        <div class="ticker-item">AVIRsinami: Teknologi VR untuk Edukasi Mitigasi Tsunami - BRIN</div>
        <div class="ticker-item">8 Tips Mitigasi Jika Terjadi Tsunami untuk Keselamatan - BeritaSatu</div>
        <div class="ticker-item">Ekspedisi Geosains Laut Mitigasi Bencana Serupa Tsunami Aceh 2004 - BRIN</div>
        <div class="ticker-item">Puluhan Pelajar SMA di Aceh Besar Ikuti Edukasi Mitigasi Bencana - Antara</div>
      </div>
    </div>

    <!-- Featured Article -->
    <section class="featured-article" data-aos="fade-up" id="featured-article-container">
      <?php if (!empty($artikel_data)): ?>
        <?php $featured_article = $artikel_data[0]; ?>
        <div class="featured-content">
          <span class="article-category"><?php echo htmlspecialchars($featured_article['kategori']); ?></span>
          <h2><?php echo htmlspecialchars($featured_article['judul']); ?></h2>
          <p><?php echo htmlspecialchars($featured_article['konten']); ?></p>
          <div class="article-meta">
            <div class="meta-item">
              <i class="far fa-calendar"></i>
              <span><?php echo date('d M Y', strtotime($featured_article['tanggal_publikasi'])); ?></span>
            </div>
            <div class="meta-item">
              <i class="far fa-user"></i>
              <span>Admin Waver</span>
            </div>
          </div>
          <?php if (!empty($featured_article['link_artikel_eksternal'])): ?>
            <a href="<?php echo htmlspecialchars($featured_article['link_artikel_eksternal']); ?>" target="_blank" class="read-more">
              Baca Selengkapnya
              <i class="fas fa-arrow-right"></i>
            </a>
          <?php endif; ?>
        </div>
        <div class="featured-image" data-aos="zoom-in" data-aos-delay="300">
          <img src="<?php echo htmlspecialchars($featured_article['url_gambar']); ?>" alt="<?php echo htmlspecialchars($featured_article['judul']); ?>" />
        </div>
      <?php else: ?>
        <div style="text-align: center; width: 100%;">
          <i class="fas fa-newspaper" style="font-size: 48px; color: #ccc; margin-bottom: 15px;"></i>
          <h4>Belum Ada Artikel</h4>
          <p>Belum ada artikel yang tersedia saat ini.</p>
        </div>
      <?php endif; ?>
    </section>

    <!-- Artikel Terbaru -->
    <section data-aos="fade-up">
      <h2>Artikel Terbaru</h2>

      <!-- Article Grid -->
      <div class="article-grid" id="article-grid-container">
        <?php if (!empty($artikel_data) && count($artikel_data) > 1): ?>
          <?php foreach(array_slice($artikel_data, 1) as $index => $article): ?>
            <div class="card-article" data-aos="zoom-in" data-aos-delay="<?php echo ($index * 100); ?>">
              <div class="article-image-container">
                <img src="<?php echo htmlspecialchars($article['url_gambar']); ?>" alt="<?php echo htmlspecialchars($article['judul']); ?>" class="article-image" />
              </div>
              <div class="card-body">
                <span class="article-category"><?php echo htmlspecialchars($article['kategori']); ?></span>
                <h5><?php echo htmlspecialchars($article['judul']); ?></h5>
                <div class="article-meta">
                  <div class="meta-item">
                    <i class="far fa-calendar"></i>
                    <span><?php echo date('d M Y', strtotime($article['tanggal_publikasi'])); ?></span>
                  </div>
                  <div class="meta-item">
                    <i class="far fa-clock"></i>
                    <span><?php echo ceil(str_word_count($article['konten']) / 200); ?> min read</span>
                  </div>
                </div>
                <p><?php echo htmlspecialchars(substr($article['konten'], 0, 120) . '...'); ?></p>
                <?php if (!empty($article['link_artikel_eksternal'])): ?>
                  <a href="<?php echo htmlspecialchars($article['link_artikel_eksternal']); ?>" target="_blank" class="read-more">
                    Baca Selengkapnya
                    <i class="fas fa-arrow-right"></i>
                  </a>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
            <i class="fas fa-newspaper" style="font-size: 48px; color: #ccc; margin-bottom: 15px;"></i>
            <h4>Belum Ada Artikel Lainnya</h4>
            <p>Belum ada artikel lainnya yang tersedia saat ini.</p>
          </div>
        <?php endif; ?>
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

    // Auto-refresh data every 30 seconds
    function startDataPolling() {
      setInterval(() => {
        console.log('🔄 Auto refresh data artikel...');
        location.reload();
      }, 30000);
    }

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
      
      // Start auto refresh
      startDataPolling();
    });
  </script>
</body>
</html>
