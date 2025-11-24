<?php
include "koneksi.php";

// Query untuk mengambil data kejadian dari database
$query = "SELECT * FROM kejadian ORDER BY tanggal DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Waver – Volunteer Tsunami</title>

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
      min-height: 400px;
      background: linear-gradient(135deg, rgba(0, 23, 45, 0.9) 0%, rgba(0, 87, 255, 0.7) 100%), 
                   url('https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
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

    /* ===== CONTENT CONTAINERS ===== */
    .content-container {
      background: white;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      padding: 40px;
      margin-bottom: 40px;
    }

    /* ===== VOLUNTEER INTRO ===== */
    .volunteer-intro {
      text-align: center;
      margin-bottom: 60px;
    }

    .benefits-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
      margin: 40px 0;
    }

    .benefit-card {
      background: white;
      padding: 40px 30px;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      text-align: center;
      transition: all 0.4s ease;
      border: 2px solid transparent;
    }

    .benefit-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 40px rgba(0, 87, 255, 0.15);
      border-color: var(--primary);
    }

    .benefit-icon {
      width: 80px;
      height: 80px;
      background: linear-gradient(135deg, var(--primary), var(--accent));
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0 auto 20px;
    }

    .benefit-icon i {
      font-size: 32px;
      color: white;
    }

    .benefit-card h3 {
      font-size: 22px;
      margin-bottom: 15px;
      color: var(--primary);
    }

    .benefit-card p {
      font-size: 16px;
      color: #666;
      margin-bottom: 0;
    }

    /* ===== LOKASI VOLUNTEER ===== */
    .lokasi-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
      gap: 30px;
      margin-top: 40px;
    }

    .lokasi-item {
      background: white;
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      transition: all 0.4s ease;
      border: 2px solid transparent;
      position: relative;
      overflow: hidden;
    }

    .lokasi-item::before {
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

    .lokasi-item:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 40px rgba(0, 87, 255, 0.15);
      border-color: var(--primary);
    }

    .lokasi-item:hover::before {
      transform: scaleX(1);
    }

    .lokasi-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 15px;
    }

    .lokasi-item h4 {
      font-size: 20px;
      font-weight: 700;
      color: var(--dark);
      margin-bottom: 10px;
    }

    .status-badge {
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 14px;
      font-weight: 600;
      text-transform: uppercase;
    }

    .status-available {
      background: rgba(40, 167, 69, 0.1);
      color: var(--success);
      border: 1px solid var(--success);
    }

    .status-closed {
      background: rgba(220, 53, 69, 0.1);
      color: var(--danger);
      border: 1px solid var(--danger);
    }

    .status-monitoring {
      background: rgba(255, 193, 7, 0.1);
      color: var(--warning);
      border: 1px solid var(--warning);
    }

    .lokasi-info {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
    }

    .info-item {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 14px;
      color: #666;
    }

    .info-item i {
      color: var(--primary);
    }

    .volunteer-btn {
      width: 100%;
      padding: 15px;
      border-radius: 50px;
      border: none;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: white;
      font-weight: 700;
      font-size: 16px;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      text-decoration: none;
    }

    .volunteer-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 25px rgba(0, 87, 255, 0.3);
      background: linear-gradient(135deg, var(--secondary), var(--primary));
      color: white;
    }

    .volunteer-btn:disabled {
      background: #ccc;
      cursor: not-allowed;
      transform: none;
      box-shadow: none;
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
    @media (max-width: 992px) {
      .navbar-links {
        gap: 25px;
      }
      
      .hero h1 {
        font-size: 48px;
      }
      
      .hero p {
        font-size: 20px;
      }
    }

    @media (max-width: 768px) {
      .navbar-links {
        display: none;
      }
      
      .navbar-container {
        padding: 15px 5%;
      }
      
      .hero {
        height: 40vh;
        min-height: 350px;
        padding-top: 70px;
      }
      
      .hero h1 {
        font-size: 38px;
      }
      
      .hero p {
        font-size: 18px;
        max-width: 90%;
      }

      h2 {
        font-size: 32px;
      }

      h3 {
        font-size: 24px;
      }

      .lokasi-grid {
        grid-template-columns: 1fr;
      }

      .lokasi-header {
        flex-direction: column;
        gap: 10px;
      }

      main {
        padding: 0 5% 60px;
      }

      .content-container {
        padding: 30px 20px;
      }
      
      .benefits-grid {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 480px) {
      .hero {
        height: 35vh;
        min-height: 300px;
      }
      
      .hero h1 {
        font-size: 32px;
      }
      
      .hero p {
        font-size: 16px;
      }
      
      .benefit-card {
        padding: 30px 20px;
      }
      
      .lokasi-item {
        padding: 20px;
      }
      
      .lokasi-info {
        flex-direction: column;
        gap: 10px;
      }
      
      #notification {
        padding: 15px 40px;
        font-size: 16px;
      }
    }
  </style>
</head>

<body>
  <!-- Scroll Progress Bar -->
  <div class="scroll-progress" id="scrollProgress"></div>

  <!-- ===== NOTIFICATION BAR ===== -->
  <div id="notification" role="alert" aria-live="assertive">
    ⚠️ PERINGATAN DARURAT! Tsunami terdeteksi – Perkiraan tiba dalam 20 menit di Palu!
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
      <a href="volunteer.php" style="color: #a9d6ff;">Volunter</a>
      <a href="about.php">Tentang</a>
    </nav>
  </header>

  <!-- ===== HERO ===== -->
  <section class="hero" id="hero">
    <div class="hero-content" data-aos="fade-up" data-aos-duration="1200">
      <h1>Jadi Volunteer Tsunami</h1>
      <p>Bergabunglah dengan komunitas relawan kami untuk membantu masyarakat menghadapi bencana tsunami</p>
    </div>
  </section>

  <!-- ===== MAIN CONTENT ===== -->
  <main>

    <!-- Volunteer Intro -->
    <section class="content-container volunteer-intro" data-aos="fade-up">
      <h2>Mengapa Menjadi Volunteer?</h2>
      <p>Sebagai volunteer Waver, Anda akan menjadi bagian dari sistem peringatan dini tsunami yang menyelamatkan nyawa dan membantu masyarakat pesisir.</p>
      
      <div class="benefits-grid">
        <div class="benefit-card" data-aos="zoom-in" data-aos-delay="100">
          <div class="benefit-icon">
            <i class="fas fa-hands-helping"></i>
          </div>
          <h3>Bantu Sesama</h3>
          <p>Berkontribusi langsung dalam upaya penyelamatan dan edukasi masyarakat tentang bahaya tsunami.</p>
        </div>
        
        <div class="benefit-card" data-aos="zoom-in" data-aos-delay="200">
          <div class="benefit-icon">
            <i class="fas fa-graduation-cap"></i>
          </div>
          <h3>Pelatihan Gratis</h3>
          <p>Dapatkan pelatihan profesional tentang mitigasi bencana, pertolongan pertama, dan sistem peringatan dini.</p>
        </div>
        
        <div class="benefit-card" data-aos="zoom-in" data-aos-delay="300">
          <div class="benefit-icon">
            <i class="fas fa-users"></i>
          </div>
          <h3>Komunitas Solid</h3>
          <p>Bergabung dengan jaringan relawan yang peduli dan berdedikasi dalam penanggulangan bencana.</p>
        </div>
      </div>
    </section>

    <!-- Lokasi Volunteer -->
    <section class="content-container" data-aos="fade-up">
      <h2>Lokasi yang Membutuhkan Volunteer</h2>
      <p>Pilih lokasi di mana Anda ingin berkontribusi sebagai volunteer tsunami.</p>

      <div class="lokasi-grid">
        <?php
        if (mysqli_num_rows($result) > 0) {
          $index = 0;
          while ($row = mysqli_fetch_assoc($result)) {
            // Hitung jumlah volunteer yang sudah mendaftar untuk kejadian ini
            $id_kejadian = $row['id_kejadian'];
            $query_volunteer = "SELECT COUNT(*) as total FROM volunteer WHERE id_kejadian = $id_kejadian";
            $result_volunteer = mysqli_query($conn, $query_volunteer);
            $volunteer_data = mysqli_fetch_assoc($result_volunteer);
            $total_volunteer = $volunteer_data['total'];
            
            // Tentukan status badge
            $status = $row['status'];
            $status_class = '';
            $status_text = '';
            $tersedia = false;
            
            if (strtolower($status) == 'aktif') {
              $status_class = 'status-available';
              $status_text = 'Aktif';
              $tersedia = true;
            } elseif (strtolower($status) == 'pemantauan' || strtolower($status) == 'dalam pemantauan') {
              $status_class = 'status-monitoring';
              $status_text = 'Dalam Pemantauan';
              $tersedia = true;
            } else {
              $status_class = 'status-closed';
              $status_text = 'Selesai';
              $tersedia = false;
            }
            
            // Format tanggal
            $tanggal = date('d M Y', strtotime($row['tanggal']));
            
            // Format magnitudo
            $magnitudo = $row['magnitudo'] . ' SR';
            
            // Lokasi
            $lokasi = $row['lokasi'];
            
            // Delay untuk animasi
            $delay = $index * 100;
        ?>
        
        <div class="lokasi-item" data-aos="zoom-in" data-aos-delay="<?php echo $delay; ?>">
          <div class="lokasi-header">
            <h4><?php echo htmlspecialchars($lokasi); ?></h4>
            <span class="status-badge <?php echo $status_class; ?>"><?php echo $status_text; ?></span>
          </div>
          <div class="lokasi-info">
            <div class="info-item">
              <i class="fas fa-users"></i>
              <span><?php echo $total_volunteer; ?> Volunteer</span>
            </div>
            <div class="info-item">
              <i class="fas fa-clock"></i>
              <span>3 Bulan</span>
            </div>
            <div class="info-item">
              <i class="fas fa-wave-square"></i>
              <span><?php echo $magnitudo; ?></span>
            </div>
          </div>
          <p>Bergabunglah sebagai volunteer untuk membantu masyarakat di <?php echo htmlspecialchars($lokasi); ?> dalam menghadapi potensi tsunami dan pemulihan pasca bencana.</p>
          <p><small><strong>Tanggal Kejadian:</strong> <?php echo $tanggal; ?></small></p>
          
          <?php if ($tersedia) { ?>
            <a href="pendaftaran_volunteer.php?id_kejadian=<?php echo $id_kejadian; ?>" class="volunteer-btn">
              <i class="fas fa-user-plus"></i>
              Daftar Sekarang
            </a>
          <?php } else { ?>
            <button class="volunteer-btn" disabled>
              <i class="fas fa-times"></i>
              Pendaftaran Ditutup
            </button>
          <?php } ?>
        </div>
        
        <?php
            $index++;
          }
        } else {
        ?>
          <div class="lokasi-item" style="grid-column: 1 / -1; text-align: center;">
            <i class="fas fa-info-circle" style="font-size: 48px; color: #ccc; margin-bottom: 15px;"></i>
            <h4>Belum Ada Lokasi Volunteer</h4>
            <p>Belum ada kejadian tsunami yang membutuhkan volunteer saat ini.</p>
          </div>
        <?php } ?>
      </div>
    </section>
  </main>

  <!-- ===== FOOTER ===== -->
  <footer data-aos="fade-up">
    <h4>Waver Project © 2025</h4>
    <p>Created by Waver | Stay Safe, Stay Prepared</p>
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
